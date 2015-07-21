(function () {
    'use strict';

    function registerService($http, $q) {
        var registerService = {
            async: function(login, password, password2, email) {
                var request = $http({
                    method: "POST",
                    url: 'resources/php/php_login.php',
                    data: {
                        request: 'register',
                        login: login,
                        password: password,
                        password2: password2,
                        email: email
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
                return request;
            }
        }
        return registerService;
    }

    var module = angular.module('dissApp');
    module.factory('registerService', ['$http', '$q', registerService]);
})();
