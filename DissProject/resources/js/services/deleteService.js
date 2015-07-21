(function () {
    'use strict';

    function deleteService($http, $q) {
        var deleteService = {
            async: function(id) {
                var request = $http({
                    method: "post",
                    url: 'resources/php/php_add.php',
                    data: {
                        request: 'delete',
                        id: id
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss został usunięty. Po odświerzeniu strony nie będzie widoczny.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
                return request;
            }
        }
        return deleteService;
    }

    var module = angular.module('dissApp');
    module.factory('deleteService', ['$http', '$q', deleteService]);
})();
