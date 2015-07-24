(function () {
    'use strict';

    function commentsCtrl(noteDAO) {
        var rate = this;
        rate.mark = 0;
        rate.info = function() {
            return rate.mark;
        };

        rate.addNewMark = function(id, type) {
            noteDAO.rateComment(id, type).then (function(data) {
                if( data == "plus")
                    rate.mark = 1;
                else if(data == "minus")
                    rate.mark = -1;
                else
                    swal("Hola hola", "Już oceniłeś ten diss.", "warning");
            });
        };
    };

    var module = angular.module('dissApp');
    module.controller('commentsCtrl', ['noteDAO', commentsCtrl]);
})();
