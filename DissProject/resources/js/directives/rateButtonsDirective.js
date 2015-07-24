(function () {
    'use strict';

    function rateCtrl(noteDAO) {
        var rate = this;
        rate.mark = 0;
        rate.info = function() {
            return rate.mark;
        };

        rate.addNewMark = function(id, type) {
            noteDAO.rateNote(id, type).then (function(data) {
                if( data == "plus")
                    rate.mark = 1;
                else if(data == "minus")
                    rate.mark = -1;
                else
                swal("Hola hola", "Już oceniłęś ten diss.", "warning");
            });
        };
    }

    function rateButtons() {
        return {
          restrict: 'E',
          scope: {
            noteID: '=id',
            noteDiffrence: '=dif'
          },
          templateUrl: 'resources/js/views/directives/rateButtons.html',
          controller: 'rateCtrl as rate'
        };
    }

    var module = angular.module('dissApp');
    module.controller('rateCtrl', ['noteDAO', rateCtrl]);
    module.directive('rateButtons', [rateButtons]);

})();
