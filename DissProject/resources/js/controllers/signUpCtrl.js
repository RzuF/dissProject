(function () {
    'use strict';

    function signUpCtrl($rootScope, $location, logInService) {
        var ctrl = this;
        ctrl.noErrors = true;
        ctrl.returnMessage = "";
        ctrl.check_credentials = function(password, login) {
            logInService.async(password, login).then(function(data) {
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
    module.controller('signUpCtrl', ['$rootScope', '$location', 'logInService', signUpCtrl]);
})();
