(function () {
    'use strict';

    function addNewDissCtrl( $location, notesDAO) {
        var ctrl = this;
        ctrl.noErrors = true;
        ctrl.isDisable = false;

        ctrl.add = function (dissName, dissText, dissTags) {
            ctrl.noErrors = false;
            ctrl.errorMessage = false;
            ctrl.messageClass = "alert-success"
            ctrl.returnMessage = " Trwa przetwarzanie dissa, prosimy o cierpliwość. Pozostań na stronie i poczekaj na jego przetworzenie. Gdy diss będzie gotowy zostaniesz automatycznie przekierowany na twojego dissa.";
            ctrl.isDisable = true;
            notesDAO.addNewNote(dissName, dissText, dissTags).then(function(data) {
                if( data.search("ERROR") != -1) {
                    ctrl.isDisable = false;
                    ctrl.noErrors = false;
                    ctrl.errorMessage = true;
                    ctrl.messageClass = "alert-danger"
                    data = data.replace("ERROR:", "");
                    ctrl.returnMessage = data;
                }
                else {
                    swal("Twój diss został dodany!", "Na twoje konto wpłynęło 10 punktów.", "success");
                    data = data.replace("OK: ", "");
                    var id = data;
                    $location.path("/notes/" + id);
                 }
            });
        }
    }

    var module = angular.module('dissApp');
    module.controller('addNewDissCtrl', ['$location', 'notesDAO', addNewDissCtrl]);
})();
