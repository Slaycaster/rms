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

    $scope.temptotal = 0;
    $scope.amount_tendered = 0;
    $scope.change = 0;
    
    $http.get('api/services').success(function(data) {
        $scope.servicesdata = data;
    });   

    $http.get('api/servicetypes').success(function(data) {
        $scope.servicetypes = data;
    });

    $scope.saletemp = [ ];

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
        $scope.saletemp = $scope.saletemp.filter(function(item)
        {
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
}]);