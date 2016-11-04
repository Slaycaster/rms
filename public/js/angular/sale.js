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
        var lookup = _.find($scope.services, {'id': serviceid});
        $scope.saletemp.push(lookup);
        $scope.temptotal += parseFloat(lookup.price);
    }

    $scope.removeServiceItem = function(serviceid)
    {
        var lookup = _.find($scope.services, {'id': serviceid});
        $scope.temptotal -= parseFloat(lookup.price);
        $scope.saletemp.pop(lookup);
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

/*
(function(){
    var app = angular.module('rms', [ ]);

    app.controller("SearchItemCtrl", [ '$scope', '$http', function($scope, $http) {
        $scope.items = [ ];
        $http.get('api/item').success(function(data) {
            $scope.items = data;
        });
        $scope.saletemp = [ ];
        $scope.newsaletemp = { };
        $http.get('api/saletemp').success(function(data, status, headers, config) {
            $scope.saletemp = data;
        });
        $scope.addSaleTemp = function(item, newsaletemp) {
            $http.post('api/saletemp', { item_id: item.id, cost_price: item.cost_price, selling_price: item.selling_price }).
            success(function(data, status, headers, config) {
                $scope.saletemp.push(data);
                    $http.get('api/saletemp').success(function(data) {
                    $scope.saletemp = data;
                    });
            });
        }
        $scope.updateSaleTemp = function(newsaletemp) {
            
            $http.put('api/saletemp/' + newsaletemp.id, { quantity: newsaletemp.quantity, total_cost: newsaletemp.item.cost_price * newsaletemp.quantity,
                total_selling: newsaletemp.item.selling_price * newsaletemp.quantity }).
            success(function(data, status, headers, config) {
                
                });
        }
        $scope.removeSaleTemp = function(id) {
            $http.delete('api/saletemp/' + id).
            success(function(data, status, headers, config) {
                $http.get('api/saletemp').success(function(data) {
                        $scope.saletemp = data;
                        });
                });
        }
        $scope.sum = function(list) {
            var total=0;
            angular.forEach(list , function(newsaletemp){
                total+= parseFloat(newsaletemp.item.selling_price * newsaletemp.quantity);
            });
            return total;
        }

    }]);
})();
*/
