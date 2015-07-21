(function () {
    'use strict';

    function logOutCtrl($rootScope, $http, $location) {
        var ctrl = this;
        ctrl.logout = function () {
            var request = $http({
                method: "post",
                url: 'resources/php/php_login.php',
                data: {
                    request: 'logout',
                }
                }).success(function (data) {
                if( data == "OK") {
                    $rootScope.sessionCheck();
                    $location.path("/");
                }
                else {
                    alert(data);
                }
            });
        };
    }

    var module = angular.module('dissApp');
    module.controller('logOutCtrl', ['$rootScope', '$http', '$location', logOutCtrl]);
})();
