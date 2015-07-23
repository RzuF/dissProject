(function () {
    'use strict';

    function note() {
        return {
          restrict: 'E',
          scope: {
            noteDetails: '=noteData',
            noteID: '=id',
            session: '=sessionData',
            links: '=enableLinks',
            que: '=isQueue'
          },
          templateUrl: 'resources/js/views/directives/note.html',
        };
    }

    var module = angular.module('dissApp');
    module.directive('note', [note]);

})();
