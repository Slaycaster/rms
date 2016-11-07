app.controller('SaleCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.services = [ ];
    $scope.servicesdata = [ ];
    $scope.servicetypes = [ ];
    $scope.temptotal = 0;
    
    $http.get('api/services').success(function(data) {
        $scope.servicesdata = data;
    });   

    $http.get('api/servicetypes').success(function(data) {
        $scope.servicetypes = data;
    });

    $scope.saletemp = [ ];

    $scope.addServiceItem = function(serviceid)
    {
        var lookup = _.find($scope.servicesdata, {'id': serviceid});
        $scope.saletemp.push(lookup);
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
        console.log($scope.saletemp);
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
}]);