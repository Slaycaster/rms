app.controller('SaleCtrl', ['$scope', '$http', function ($scope, $http) {

    /*----------------------------------------------------
            Holds all services in backend data
    ----------------------------------------------------*/
    $scope.servicesdata = [ ];

    /*----------------------------------------------------
            Holds services by its type to display
            in the view
    ----------------------------------------------------*/
    $scope.services = [ ];

    /*----------------------------------------------------
            Holds all service types in backend
            data
    ----------------------------------------------------*/
    $scope.servicetypes = [ ];

    /*----------------------------------------------------
            Holds services added to 'cart'
    ----------------------------------------------------*/
    $scope.saletemp = [ ];
    
    $scope.temptotal = 0;
    $scope.amount_tendered = 0;
    
    var additional_charge = 0;
    var old_additional_charge = 0;

    $scope.change = 0;
    $scope.transaction_id = 0;
    
    $http.get('api/services').success(function(data) {
        $scope.servicesdata = data;
    });   

    $http.get('api/servicetypes').success(function(data) {
        $scope.servicetypes = data;
    });
    
    $scope.init = function()
    {
        $scope.saletemp = [ ];
        $http.get('api/transactions/max/' + document.getElementById('branch_id').value).success(function(data) {
            $scope.transaction_id = parseInt(data.max_transaction_id) + 1;
        });
        $scope.temptotal = 0;
        $scope.amount_tendered = 0;
        $scope.change = 0;
    }

    $scope.addServiceItem = function(serviceid)
    {
        //look for the service in the servicesdata 
        var lookup = _.find($scope.servicesdata, {'id': serviceid});

        //Add into "cart"
        $scope.saletemp.push(lookup);

        //Remove from service list(to avoid duplication)
        

        //Accumulate the price
        $scope.temptotal += parseFloat(lookup.price);
    }

    $scope.removeServiceItem = function(serviceid)
    {
        var lookup = _.find($scope.servicesdata, {'id': serviceid});
        $scope.temptotal -= parseFloat(lookup.price);
        var lookup_id = lookup.id;
        _($scope.saletemp).forEach(function (lookup_id) {
            _.remove($scope.saletemp, { 'id': lookup_id })
        });
        $scope.saletemp = $scope.saletemp.filter(function(item)
        {
            additionalCharge();
            return item.id !== lookup.id;
        });
    }

    $scope.getServicesByType = function(servicetypeid)
    {
        if (servicetypeid === 0) 
        {
            $http.get('api/services').success(function(data) {
                $scope.services = data;
            });   
        } else {
            $http.get('api/servicebytype/'+servicetypeid).success(function(data)
            {
                $scope.services = data;
            });
        }
    }

    $scope.getChange = function(amount_tendered)
    {
        $scope.change = parseFloat(amount_tendered-$scope.temptotal);
    }

    $scope.additionalCharge = function()
    {
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
        $scope.temptotal -= parseFloat(old_additional_charge);
        $scope.temptotal += parseFloat(additional_charge);
        old_additional_charge = additional_charge;

        if($scope.amount_tendered)
        {
            $scope.getChange($scope.amount_tendered);
        }
        
    }

    $scope.proceedToCheckout = function(checkout)
    {
        var item_id = [];
        var item_unit = [];
        var item_consumed = [];
        var stylist_id = [];
        var additional_arr2 = [];
        for(var i = 0; i < document.getElementsByName('item_id[]').length; i++)
        {
            item_id.push(document.getElementsByName('item_id[]')[i].value);
            item_unit.push(document.getElementsByName('item_unit[]')[i].value);
            item_consumed.push(document.getElementsByName('item_consumed[]')[i].value);
        }

        for(var j = 0; j < document.getElementsByName('stylist_id[]').length; j++)
        {
            stylist_id.push(document.getElementsByName('stylist_id[]')[j].value);
        }

        for(var k = 0; k < document.getElementsByName('additional_charge[]').length; k++)
        {
            additional_arr2.push(document.getElementsByName('additional_charge[]')[k].value);
        }
        
       $http.post('api/transactions/save', {
            sales: $scope.saletemp,
            customer: document.getElementById('customer').value,
            branch_id: document.getElementById('branch_id').value,
            user_id: document.getElementById('user_id').value,
            stylist_id: stylist_id,
            promo_id: document.getElementById('promo_id').value,
            price: $scope.temptotal,
            additional_charge: additional_arr2,
            item_id: item_id,
            item_unit: item_unit,
            item_consumed: item_consumed
       }).success(function(data, status, headers, config, response) {
            console.log(data);
            window.location.reload(true);
       });
       
    }

    $scope.init();
}]);