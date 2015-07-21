(function ()
{
    'use strict';
    /* Fetch all data about note: title, author, date, comments count, id, ranking */
    function notesDAO($resource, $http, $q)
    {
        var notesList = $resource('resources/php/:a?:b', null, {
            getAllMain: {
                isArray: true,
				method: "GET",
				params: { a: 'getAll.php', b: 'id=1' }
            },
			getAllQueue: {
                isArray: true,
				method: "GET",
				params: { a: 'getAll_poczekalnia.php', b: 'id=1' }
            }
        });

        /* var noteDetails = $resource('resources/php/php_add.php', null, {
            getNoteDetails: {
                isArray: false,
				method: "GET",
                data: {
                    request: 'show',
                    id: 20
                }
		    }
        }); */

        /* var noteDetails = {
            getNoteDetails: function(id) {
                var request = $http({
                    method: "GET",
                    url: 'resources/php/php_add.php',
                    data: {
                        request: 'show',
                        id: id
                    }
                }).then(function (backendResponse) {
                    console.log(backendResponse);
                    var defer = $q.defer();
                    defer.resolve(angular.fromJson(backendResponse));
                    return defer.promise;
                });
                return request;
            }
        }; */
        var getNoteDetails = function(id) {
            var request = $http({
                method: "GET",
                url: 'resources/php/php_add.php',
                data: {
                    request: 'show',
                    id: id
                }}).success(function (backendResponse) {
                    //console.log(backendResponse);
                    var defer = $q.defer();
                    defer.resolve(backendResponse);
                    return defer.promise;
                }).error(function (data) {
                    alert("Błąd w przekazywaniu danych.");
                });
        };

        return {
            getAllMain: function () {
                return notesList.getAllMain().$promise;
            },
			getAllQueue: function () {
                return notesList.getAllQueue().$promise;
            },
            getNoteDetails: function(id) {
                return getNoteDetails(id);
            }
        }
    }
    angular.module('dissApp').factory('notesDAO', ['$resource', '$http', '$q', notesDAO]);
})();

/*
app.controller('showNoteCtrl', function($scope, $routeParams, $http) {
    $scope.noteID = $routeParams.noteID;
    $scope.view;

    var request = $http({
        method: "post",
        url: 'resources/php/php_add.php',
        data: {
            request: 'show',
            id: $scope.noteID
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    request.success(function (data) {
        $scope.data = data;
        $scope.view = angular.fromJson($scope.data);
    });

    request.error(function (data) {
        $scope.data = "error in fetching data";
                alert("Błąd w przekazywaniu danych.");
    });

}); */
