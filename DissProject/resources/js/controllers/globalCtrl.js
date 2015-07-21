(function () {
    'use strict';

    function globalCtrl($rootScope, $http) {
        $rootScope.session = [];

        $rootScope.sessionCheck = function() {
            var request = $http({
                method: "post",
                url: 'resources/php/php_login.php',
                data: {
                    request: 'session'
                }
            }).success(function (data) {
                $rootScope.session = angular.fromJson(data);
            }).error(function (data) {
                alert("Błąd w przekazywaniu danych.");
            });
        };

        $rootScope.sessionCheck();
    }

    var module = angular.module('dissApp');
    module.controller('globalCtrl', ['$rootScope', '$http', globalCtrl]);
})();
