(function () {
    'use strict';

    function activationCheckService($http, $q) {
        var activationCheckService = {
            async: function(aid) {
                var request = $http({
                    method: "POST",
                    url: 'resources/php/php_login.php',
                    data: {
                        request: 'active',
                        active: aid
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
                return request;
            }
        }
        return activationCheckService;
    }

    var module = angular.module('dissApp');
    module.factory('activationCheckService', ['$http', '$q', activationCheckService]);
})();
