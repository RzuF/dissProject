(function () {
    'use strict';

    function notesCommandsCtrl(deleteService, moveToMainService, moveToMainFastService) {
        var ctrl = this;
        ctrl.delete = function(id) {
            deleteService.async(id).then(function(data) {
                alert(data);
            });
        };

        ctrl.moveToMain = function(id) {
            moveToMainService.async(id).then(function(data) {
                alert(data);
            });
        };

        ctrl.moveToMainFast = function(id) {
            moveToMainFastService.async(id).then(function(data) {
                alert(data);
            });
        };
    }

    var module = angular.module('dissApp');
    module.controller('notesCommandsCtrl', ['deleteService', 'moveToMainService', 'moveToMainFastService', notesCommandsCtrl]);
})();
