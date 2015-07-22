(function () {
    'use strict';

    function notesDAO($http, $q) {
        var api = function(method, url, data) {
            return $http({
                method: method,
                url: url,
                data: data
            })
        }

        var notesDAO = {
            addNewNote: function(dissName, dissText, dissTags) {
                return api('POST', 'resources/php/php_add.php', {
                    request: 'add',
                    dissName: dissName,
                    dissText: dissText,
                    dissTags: dissTags})
                    .then(function (backendResponse) {
                        var defer = $q.defer();
                        defer.resolve(backendResponse.data);
                        return defer.promise;
                });
            },
            getAllNotesMainPage: function() {
                return api('GET', 'resources/php/php_getNotes.php', {
                    request: 'mainPage'})
                    .then(function (backendResponse) {
                        backendResponse = angular.fromJson(backendResponse);
                        console.log(backendResponse);

                });
            },
            getAllNotesWaitPage: function() {
                return api('GET', 'resources/php/php_getNotes.php', {
                    request: 'waitPage'})
                    .then(function (backendResponse) {
                        console.log(backendResponse);
                        var defer = $q.defer();
                        defer.resolve(backendResponse.data);
                        return defer.promise;
                });
            }
        }

        return notesDAO;
    }

    var module = angular.module('dissApp');
    module.factory('notesDAO', ['$http', '$q', notesDAO]);
})();
