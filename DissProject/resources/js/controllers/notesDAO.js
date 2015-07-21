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

        var getNoteDetails = function(id) {
            var request = $http({
                method: "GET",
                url: 'resources/php/php_add.php',
                data: {
                    request: 'show',
                    id: id
                }}).success(function (backendResponse) {
                    console.log(backendResponse.data[0] + "DAO");
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
