(function () {
    'use strict';

    function showNoteCtrl($routeParams, noteDAO) {
        var ctrl = this;
        ctrl.noteID = $routeParams.noteID;
        noteDAO.getNoteDetails($routeParams.noteID).then(function(data) {
            ctrl.noteDetails = data;
        });
    }

    var module = angular.module('dissApp');
    module.controller('showNoteCtrl', ['$routeParams', 'noteDAO', showNoteCtrl]);
})();
