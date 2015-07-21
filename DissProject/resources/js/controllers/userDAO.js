(function ()
{
    'use strict';
    function NotesDAO($resource)
    {
        var api = $resource('resources/php/php_login.php', null, {
            logIn: {
				method: "POST",
                data: {
                    request: 'login'
                }
            },
			getAllQueue: {
                isArray: true,
				method: "GET"
				params: { a: 'getAll_poczekalnia.php?id=1' }
            },
        });

        return {
            logIn: function (password, login) {
               return api.logIn(password, login).$promise;
            }
			getAllQueue: function () {
               return api.getAllQueue().$promise;
            }
        }
    }
    angular.module('dissApp').factory('NotesDAO', ['$resource', NotesDAO]);
})();
