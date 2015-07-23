(function () {
    'use strict';

    function showNoteCtrl($stateParams, noteDAO) {
        var ctrl = this;
        ctrl.noteID = $stateParams.noteID;
        noteDAO.getNoteDetails($stateParams.noteID).then(function(data) {
            ctrl.noteDetails = data;
        });

        ctrl.comments = [
            {id: '1', difference: '4', date: '2015-07-21 14:51:05', login: 'rzuf', text: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit omnis animi et iure laudantium vitae, praesentium optio, sapiente distinctio illo?'},
            {id: '2', difference: '4', date: '2015-07-21 14:51:05', login: 'rzuf', text: 'Lorem impresum.'},
            {id: '3', difference: '4', date: '2015-07-21 14:51:05', login: 'rzuf', text: 'Lorem impresum.'},
            {id: '4', difference: '4', date: '2015-07-21 14:51:05', login: 'rzuf', text: 'Lorem impresum.'}
        ];
    }

    var module = angular.module('dissApp');
    module.controller('showNoteCtrl', ['$stateParams', 'noteDAO', showNoteCtrl]);
})();
