(function () {
    'use strict';

    function showNoteCtrl($stateParams, noteDAO) {
        var ctrl = this;
        ctrl.noteID = $stateParams.noteID;
        noteDAO.getNoteDetails($stateParams.noteID).then(function(data) {
            ctrl.noteDetails = data;
        });
    }

    var module = angular.module('dissApp');
    module.controller('showNoteCtrl', ['$stateParams', 'noteDAO', showNoteCtrl]);
})();
