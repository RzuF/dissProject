(function () {
    'use strict';

    function showNoteCtrl($routeParams, showNoteDetailsService) {
        var ctrl = this;
        ctrl.noteID = $routeParams.noteID;
        showNoteDetailsService.async($routeParams.noteID).then(function(data) {
            ctrl.noteDetails = data;
        });
    }

    var module = angular.module('dissApp');
    module.controller('showNoteCtrl', ['$routeParams', 'showNoteDetailsService', showNoteCtrl]);
})();
