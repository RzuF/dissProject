(function () {
    'use strict';

    function showUserService($http, $q) {
        var showUserService = {
            async: function(id) {
                var request = $http({
                    method: "POST",
                    url: 'resources/php/php_login.php',
                    data: {
                        request: 'userInfo',
                        id: id
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data[0]);
                    return defer.promise;
                });
                return request;
            }
        }
        return showUserService;
    }

    var module = angular.module('dissApp');
    module.factory('showUserService', ['$http', '$q', showUserService]);
})();
