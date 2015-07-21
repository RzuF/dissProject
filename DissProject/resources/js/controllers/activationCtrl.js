(function () {
    'use strict';

    function activationCtrl($routeParams, activationCheckService) {
        var ctrl = this;
        ctrl.activate = function(aid) {
            activationCheckService.async(aid).then(function(data) {
                if( data == "OK")
                    ctrl.isSuccessful = true;
                else {
                    console.log(data);
                    ctrl.isSuccessful = false;
                    data = data.replace("ERROR:", "");
                    ctrl.message = data;
                }
            })
        }
        ctrl.activate($routeParams.AID);
    };

    var module = angular.module('dissApp');
    module.controller('activationCtrl', ['$routeParams', 'activationCheckService', activationCtrl]);
})();
