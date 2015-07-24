(function () {
    'use strict';

    function notesCommandsCtrl($log, $scope, $modal, noteDAO, notesDAO) {
        var ctrl = this;
        ctrl.delete = function(id) {
            noteDAO.deleteNote(id).then(function(data) {
                swal("Sukces", data, "success");
            });
        };

        ctrl.moveToMain = function(id) {
            noteDAO.moveToMain(id).then(function(data) {
                swal("Sukces", data, "success");
            });
        };

        ctrl.moveToMainFast = function(id) {
            noteDAO.moveToMainFast(id).then(function(data) {
                swal("Sukces", data, "success");
            });
        };

        ctrl.time = 'Dzień';
        ctrl.category = 'Upomnienie';

        ctrl.giveBan = function(time, category, description, userID) {
            var calculateTime = function(t) {
                if(t == "Dzień")
                    return 86400;
                else if(t == "Godzina")
                    return 3600;
                else if(t == 'Tydzień')
                    return 604800;
                else if(t == 'Miesiąc')
                    return 2592000;
            }
            var howLong = calculateTime(time);
            console.log( howLong + " " + category + " " + description + " " + userID);
        }
    }

    var module = angular.module('dissApp');
    module.controller('notesCommandsCtrl', ['$log', '$scope', '$modal', 'noteDAO', 'notesDAO', notesCommandsCtrl]);
})();
