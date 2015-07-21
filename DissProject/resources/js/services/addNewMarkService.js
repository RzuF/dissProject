(function () {
    'use strict';

    function addNewMarkService($http, $q) {
        var addNewMarkService = {
            async: function(id, type) {
                var request = $http({
                    method: "POST",
                    url: 'resources/php/php_add.php',
                    data: {
                        request: 'rate',
                        id: id,
                        type: type
                    }
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                    /*
                    if( data == "plus")
                        $scope.ratemark = 1;
                    else if(data == "minus")
                        $scope.ratemark = -1;
                    else
                        alert(data);
                    */
                });
                return request;
            }
        }
        return addNewMarkService;
    }

    var module = angular.module('dissApp');
    module.factory('addNewMarkService', ['$http', '$q', addNewMarkService]);
})();
