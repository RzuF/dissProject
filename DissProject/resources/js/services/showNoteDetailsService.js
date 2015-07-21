(function () {
    'use strict';

    function showNoteDetailsService($http, $q) {
        var showNoteDetailsService = {
            async: function(id) {
                var request = $http({
                    method: "POST",
                    url: 'resources/php/php_add.php',
                    data: {
                        request: 'show',
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
        return showNoteDetailsService;
    }

    var module = angular.module('dissApp');
    module.factory('showNoteDetailsService', ['$http', '$q', showNoteDetailsService]);
})();
