(function () {
    'use strict';

    function activationCtrl($stateParams, userDAO) {
        var ctrl = this;
        ctrl.activate = function(aid) {
            userDAO.emailVeryfication(aid).then(function(data) {
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
        ctrl.activate($stateParams.AID);
    };

    var module = angular.module('dissApp');
    module.controller('activationCtrl', ['$stateParams', 'userDAO', activationCtrl]);
})();
