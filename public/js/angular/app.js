var app = angular.module('rms', ['numberFixedModule'], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

var public = 'http://' + location.host + '/';


/*-------------------------------------------------
	Module having prefix numbers for invoice
-------------------------------------------------*/
angular.module('numberFixedModule', [])
    .filter('numberFixedLen', function () {
        return function (n, len) {
            var num = parseInt(n, 10);
            len = parseInt(len, 10);
            if (isNaN(num) || isNaN(len)) {
                return n;
            }
            num = ''+num;
            while (num.length < len) {
                num = '0'+num;
            }
            return num;
        };
    });