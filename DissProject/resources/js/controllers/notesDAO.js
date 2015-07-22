(function ()
{
    'use strict';
    function notessDAO($resource)
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


        return {
            getAllMain: function () {
                return notesList.getAllMain().$promise;
            },
			getAllQueue: function () {
                return notesList.getAllQueue().$promise;
            }
        }
    }
    angular.module('dissApp').factory('notessDAO', ['$resource', notessDAO]);
})();
