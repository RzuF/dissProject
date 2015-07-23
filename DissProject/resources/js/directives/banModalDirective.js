(function () {
    'use strict';

    function banModal() {
        return {
          restrict: 'E',
          scope: {
            userLogin: '=login',
            session: '=sessionData'
          },
          templateUrl: 'resources/js/views/directives/banModal.html',
          controller: 'notesCommandsCtrl as command'
        };
    }

    var module = angular.module('dissApp');
    module.directive('banModal', [banModal]);

})();
