(function () {
    'use strict';

    function moveToMainFastService($http, $q) {
        var moveToMainFastService = {
            async: function(id) {
                var request = $http({
                    method: "post",
                    url: 'resources/php/php_add.php',
                    data: {
                        request: 'move2mainFAST',
                        id: id
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss wysłany na główna.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
                return request;
            }
        }
        return moveToMainFastService;
    }

    var module = angular.module('dissApp');
    module.factory('moveToMainFastService', ['$http', '$q', moveToMainFastService]);
})();
