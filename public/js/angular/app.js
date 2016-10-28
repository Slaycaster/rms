var app = angular.module('rms', [], function($interpolateProvider) {
        $interpolateProvider.startSymbol('<%');
        $interpolateProvider.endSymbol('%>');
});

var public = 'http://' + location.host + '/';
