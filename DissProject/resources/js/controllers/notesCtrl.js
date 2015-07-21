(function () {
    'use strict';

    function notesCtrl(NotesDAO) {
        var ctrl = this;
        // Resource check if fetch data from queue or main page
        this.view;

        // Check if data have "ERROR" message.
        getAllNotesMainPage();
        function getAllNotesMainPage() {
            NotesDAO.getAllMain().then( function(data) {
                console.log(data);
                ctrl.view = data;
           });
        }

        function getAllNotesQueuePage() {
            NotesDAO.getAllQueue().then( function(data) {
                console.log(data);
                ctrl.view = data;
           });
        }
    }

    var module = angular.module('dissApp');
    module.controller('notesCtrl', ['NotesDAO', notesCtrl]);
})();
