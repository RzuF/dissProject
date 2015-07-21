(function () {
    'use strict';

    function logInService($http, $q) {
        var logInService = {
            async: function(password, login) {
                var request = $http({
                    method: "POST",
                    url: 'resources/php/php_login.php',
                    data: {
                        request: 'login',
                        password: password,
                        login: login
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
                return request;
            }
        }
        return logInService;
    }

    var module = angular.module('dissApp');
    module.factory('logInService', ['$http', '$q', logInService]);
})();
