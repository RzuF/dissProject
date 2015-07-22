(function () {
    'use strict';

    function logInCtrl($rootScope, $location, userDAO) {
        var ctrl = this;
        ctrl.noErrors = true;
        ctrl.returnMessage = "";
        ctrl.check_credentials = function(password, login) {
            userDAO.logIn(password, login).then(function(data) {
                if( data == "OK") {
                    $rootScope.sessionCheck();
                    $location.path("/");
                }
                else {
                    ctrl.noErrors = false;
                    var message = data.replace("ERROR:", "");
                    ctrl.returnMessage = message;
                }
            });
        }
    }

    var module = angular.module('dissApp');
    module.controller('logInCtrl', ['$rootScope', '$location', 'userDAO', logInCtrl]);
})();
