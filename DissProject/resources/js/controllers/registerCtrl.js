(function () {
    'use strict';

    function registerCtrl($scope, registerService, $location) {
        var ctrl = this;
        ctrl.noErrors = true;
        ctrl.serviceError = true;
        ctrl.returnMessage = "";

        ctrl.register = function(login, password, password2, email) {
            registerService.async(login, password, password2, email).then(function(data) {
                if( data == "OK")
                    $location.path("/rejestracja-sukcess");
                else {
                    ctrl.serviceError = false;
                    var message = data.replace("ERROR:", "");
                    ctrl.returnMessage = message;
                }
            });
        }

        ctrl.isLongEnough = function(pass) {
            return pass.length > 7;
        };
        ctrl.hasNumber = function(pass) {
            return /[0-9]/.test(pass);
        };

        ctrl.hasLetters = function(str) {
            return str.match(/[a-z]/) && str.match(/[A-Z]/);
        ;
    }
        $scope.$watch('password', function(newVal, odlVal) {
            if (!newVal)
                return;
            ctrl.reqs = [];
            if (!ctrl.isLongEnough(newVal))
                ctrl.reqs.push('Hasło jest za krótkie. (min. 8 znaków)');

            if (!ctrl.hasNumber(newVal))
                ctrl.reqs.push('Hasło musi posiadać chociaż jeden numer.');

            if (!ctrl.hasLetters(newVal))
                ctrl.reqs.push('Hasło musi posiadać chociaż jedną małą i duża literę.');

            ctrl.showReqs = ctrl.reqs.length;

            if(ctrl.reqs.length > 0) {
                ctrl.noErrors = false;
            }
            else
                ctrl.noErrors = true;
        });
    }

    var module = angular.module('dissApp');
    module.controller('registerCtrl', ['$scope', 'registerService', '$location', registerCtrl]);
})();
