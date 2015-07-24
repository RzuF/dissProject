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
                if( data == "OK")
                    $rootScope.sessionCheck();
                else
                    swal("Błąd", data, "error")
            });
        };
    }

    var module = angular.module('dissApp');
    module.controller('logOutCtrl', ['$rootScope', '$http', '$location', logOutCtrl]);
})();
