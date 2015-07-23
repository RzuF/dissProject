(function () {
    'use strict';

    function noteDAO($http, $q) {
        var api = function(method, url, data) {
            return $http({
                method: method,
                url: url,
                data: data
            })
        }

        var noteDAO = {
            getNoteDetails: function(id) {
                return api('POST', 'resources/php/php_add.php', {request: 'show', id: id}).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data[0]);
                    return defer.promise;
                });
            },
            rateNote: function(id, type) {
                return api('POST', 'resources/php/php_add.php', {request: 'rate', id: id,
                type: type}).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            moveToMain: function(id) {
                return api('POST', 'resources/php/php_add.php', {request: 'move2main', id: id}).then(function(backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss wysłany do poczekalni na główna.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            moveToMainFast: function(id) {
                return api('POST', 'resources/php/php_add.php', {request: 'move2mainFAST', id: id}).then(function(backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss wysłany na główna.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            deleteNote: function(id) {
                return api('POST', 'resources/php/php_add.php', {request: 'delete', id: id}).then(function(backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss został usunięty. Po odświerzeniu strony nie będzie widoczny.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            getComments: function(id) {
                return api('POST', 'resources/php/php_comments.php', {request: 'show', id: id}).then(function(backendResponse) {
                    console.log(backendResponse);
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data[0]);
                    return defer.promise;
                });
            },
            addComment: function(id) {
                return api('POST', 'resources/php/php_comments.php', {request: 'add', id: id}).then(function(backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data[0]);
                    return defer.promise;
                });
            },
            rateComment: function(id, type) {
                return api('POST', 'resources/php/php_comments.php', {request: 'rate', id: id,
                type: type}).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            deleteComment: function(id) {
                return api('POST', 'resources/php/php_comments.php', {request: 'delete', id: id}).then(function(backendResponse) {
                    var defer = $q.defer();
                    if( backendResponse.data == "OK")
                        defer.resolve("Diss został usunięty. Po odświerzeniu strony nie będzie widoczny.");
                    else
                        defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            }
            // deleteComment
            // bestComment
        }

        return noteDAO;
    }

    var module = angular.module('dissApp');
    module.factory('noteDAO', ['$http', '$q', noteDAO]);
})();
