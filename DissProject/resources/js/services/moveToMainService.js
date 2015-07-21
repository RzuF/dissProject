(function () {
    'use strict';

    function moveToMainService($http, $q) {
        var moveToMainService = {
            async: function(id) {
                var request = $http({
                    method: "post",
                    url: 'resources/php/php_add.php',
                    data: {
                        request: 'move2main',
                        id: id
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss wysłany do poczekalni na główna.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
                return request;
            }
        }
        return moveToMainService;
    }

    var module = angular.module('dissApp');
    module.factory('moveToMainService', ['$http', '$q', moveToMainService]);
})();
