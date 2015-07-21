(function () {
    'use strict';

    function addNewDissCtrl($scope, $http, $location) {
        var ctrl = this;
        ctrl.noErrors = true;
        ctrl.isDisable = false; // anty spam

        ctrl.add = function () {
            ctrl.noErrors = false;
            ctrl.errorMessage = false;
            ctrl.messageClass = "alert-success"
            ctrl.returnMessage = " Trwa przetwarzanie dissa, prosimy o cierpliwość. Pozostań na stronie i poczekaj na jego przetworzenie. Gdy diss będzie gotowy zostaniesz automatycznie przekierowany na twojego dissa.";
            ctrl.isDisable = true;
            var request = $http({
                method: "post",
                url: 'resources/php/php_add.php',
                data: {
                    request: 'add',
                    dissName: $scope.dissName,
                    dissText: $scope.dissText,
                    dissTags: $scope.dissTags
                }
            });

            request.success(function (data) {
                if( data.search("ERROR") != -1) {
                    ctrl.isDisable = false;
                    ctrl.noErrors = false;
                    ctrl.errorMessage = true;
                    ctrl.messageClass = "alert-danger"
                    data = data.replace("ERROR:", "");
                    ctrl.returnMessage = data;
                }
                else {
                    data = data.replace("OK: ", "");
                    var id = data;
                    $location.path("/notes/" + id);
                  }
            });
        }
    }

    var module = angular.module('dissApp');
    module.controller('addNewDissCtrl', ['$scope', '$http', '$location', addNewDissCtrl]);
})();


app.controller('addNewDissCtrl', function ($scope, $http, $location) {
    var ctrl = this;
    ctrl.noErrors = true;
    ctrl.isDisable = false; // anty spam

    ctrl.add = function () {
        ctrl.noErrors = false;
        ctrl.errorMessage = false;
        ctrl.messageClass = "alert-success"
        ctrl.returnMessage = " Trwa przetwarzanie dissa, prosimy o cierpliwość. Pozostań na stronie i poczekaj na jego przetworzenie. Gdy diss będzie gotowy zostaniesz automatycznie przekierowany na twojego dissa.";
        ctrl.isDisable = true;
        var request = $http({
            method: "post",
            url: 'resources/php/php_add.php',
            data: {
                request: 'add',
                dissName: $scope.dissName,
                dissText: $scope.dissText,
                dissTags: $scope.dissTags
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        request.success(function (data) {
            if( data.search("ERROR") != -1) {
                ctrl.isDisable = false;
                ctrl.noErrors = false;
                ctrl.errorMessage = true;
                ctrl.messageClass = "alert-danger"
                data = data.replace("ERROR:", "");
                ctrl.returnMessage = data;
            }
            else {
                data = data.replace("OK: ", "");
                var id = data;
                $location.path("/notes/" + id);
              }
        });
    }
});
