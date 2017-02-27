app.controller('SaleCtrl', ['$scope', '$http', 'ModalService', function ($scope, $http, ModalService) {

    /*----------------------------------------------------
            Holds all items in backend data
    ----------------------------------------------------*/
    $scope.otcitemsdata = [ ];

    /*----------------------------------------------------
            Holds services added to 'cart'
    ----------------------------------------------------*/
    $scope.saletemp = [ ];

    /*----------------------------------------------------
            Disables the button or not
    ----------------------------------------------------*/
    $scope.isDisabled = false;

     //Holds message to the modal
    $scope.message = '';
    
    $scope.temptotal = 0;
    $scope.amount_tendered = 0;
    
    var additional_charge = 0;
    var old_additional_charge = 0;

    $scope.change = 0;
    $scope.transaction_id = 0;
    
    $http.get('api/otc_items/'+document.getElementById('branch_id').value).success(function(data) {
        $scope.otcitemsdata = data;
    });   
    
    $scope.init = function()
    {
        $scope.saletemp = [ ];
        $http.get('api/otc_transactions/max/'+document.getElementById('branch_id').value).success(function(data) {
            $scope.transaction_id = parseInt(data.max_transaction_id) + 1;
        });
        $scope.temptotal = 0;
        $scope.amount_tendered = 0;
        $scope.change = 0;
    }

    $scope.addServiceItem = function(serviceid)
    {
        //look for the service in the otcitemsdata 
        var lookup = _.find($scope.otcitemsdata, {'id': serviceid});

        //Add into "cart"
        $scope.saletemp.push(lookup);

        //Accumulate the price
        //$scope.temptotal += parseFloat(lookup.price);
    }

    /*
    $scope.removeServiceItem = function(serviceid)
    {
        var lookup = _.find($scope.otcitemsdata, {'id': serviceid});
        $scope.temptotal -= parseFloat(lookup.price);
        var lookup_id = lookup.id;
        _($scope.saletemp).forEach(function (lookup_id) {
            _.remove($scope.saletemp, { 'id': lookup_id })
        });
        $scope.saletemp = $scope.saletemp.filter(function(item)
        {
            //additionalCharge();
            return item.id !== lookup.id;
        });
    }


    $scope.getChange = function(amount_tendered)
    {
        $scope.change = parseFloat(amount_tendered-$scope.temptotal);
    }
    $scope.additionalCharge = function()
    {
        console.log('here');
        var additional_arr = [];
        additional_charge = 0;
        for(var i = 0; i < document.getElementsByName('additional_charge[]').length; i++)
        {
            additional_arr.push(document.getElementsByName('additional_charge[]')[i].value);
        }
        for (var j = 0; j < additional_arr.length; j++)
        {
            additional_charge += parseFloat(additional_arr[j]);
        }
        console.log(additional_arr);
        console.log(additional_charge);
        $scope.temptotal -= parseFloat(old_additional_charge);
        $scope.temptotal += parseFloat(additional_charge);
        old_additional_charge = additional_charge;

        if($scope.amount_tendered)
        {
            $scope.getChange($scope.amount_tendered);
        }
        
    }
    */
    $scope.proceedToCheckout = function(checkout)
    {
        var notProceeding = false;

        $scope.message = '';

        var additional_arr2 = [];
        var quantity = [];
        var unit_of_measurement = [];
        $scope.temptotal = 0;

        //Multiply item price * quantity
        for (var i = 0; i < $scope.saletemp.length; i++)
        {
            $scope.temptotal += parseFloat(($scope.saletemp[i].otc_item_price * document.getElementsByName('quantity[]')[i].value));
            //then the additional charge
            $scope.temptotal += parseFloat(document.getElementsByName('additional_charge[]')[i].value);
        }

        $scope.isDisabled = true;

        $scope.change = parseFloat($scope.amount_tendered-$scope.temptotal);

        if (checkout == true)
        {
            for(var k = 0; k < document.getElementsByName('additional_charge[]').length; k++)
            {
                additional_arr2.push(document.getElementsByName('additional_charge[]')[k].value);
                quantity.push(document.getElementsByName('quantity[]')[k].value);
                unit_of_measurement.push(document.getElementsByName('unit_of_measurement[]')[k].value);
            }

            if ($scope.change < 0)
            {
                notProceeding = true;
                $scope.message += 'Insufficient amount tendered!\n';
            }

            if ($scope.amount_tendered <= 0)
            {
                notProceeding = true;
                $scope.message += 'Amount tendered cannot be empty!\n';   
            }

            if(notProceeding)
            {
                //Show a modal
                ModalService.showModal({
                templateUrl: "modal.html",
                controller: "ModalController",
                inputs: {
                    title: $scope.message
                }
                }).then(function(modal) {
                    $scope.isDisabled = false;
                    //it's a bootstrap element, use 'modal' to show it
                    modal.element.modal();
                    modal.close.then(function(result) {
                      console.log(result);
                    });
                });
            }
            else
            { 
                $scope.isDisabled = true;
                //Save the transaction
               $http.post('api/otc_transactions/save', {
                    invoice_id: $scope.transaction_id,
                    sales: $scope.saletemp,
                    customer: document.getElementById('customer').value,
                    customer_contact: document.getElementById('customer_contact').value,
                    customer_address: document.getElementById('customer_address').value,
                    branch_id: document.getElementById('branch_id').value,
                    user_id: document.getElementById('user_id').value,
                    stylist_id: document.getElementById('stylist_id').value,
                    quantity: quantity,
                    unit_of_measurement: unit_of_measurement,
                    promo_id: document.getElementById('promo_id').value,
                    price: $scope.temptotal,
                    additional_charge: additional_arr2,
               }).success(function(data, status, headers, config, response) {
                    console.log(data);
                    window.location.reload(true);
               });
            }
        }
       
    }

    $scope.init();
}]);

app.controller('ModalController', ['$scope', 'title', 'close', function($scope, title, close) {

    $scope.title = title;
  $scope.close = function(result) {
      close(result, 500); // close, but give 500ms for bootstrap to animate
  };

}]);