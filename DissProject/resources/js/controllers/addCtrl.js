(function () {
    'use strict';

    function addCtrl($scope, $http) {
        var ctrl = this;
        this.ratemark = 0;
        ctrl.rateinfo = function() {
            return ctrl.ratemark;
        }

        ctrl.request = function(meth, param) {
            return $http({
                method: meth,
                url: 'resources/php/php_add.php',
                data: param,
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });
        }

        ctrl.addRate = function (id, type) {
            ctrl.data = {
                request: 'rate',
                id: id, // id of post
                type: type // type "plus" or "minus"
            };
            ctrl.rate = request("post", data);

            ctrl.rate.success(function (data) {
                if( data == "plus")
                    ctrl.ratemark = 1;
                else if(data == "minus")
                    ctrl.ratemark = -1;
                else
                    alert(data);
            });
        }

        ctrl.delete = function (id) {
            ctrl.data = {
                request: 'delete',
                id: id
            };
            ctrl.deleteRequest = request("post", data);
            ctrl.deleteRequest.success(function (data) {
                if( data == "OK")
                    alert("Diss został usunięty. Po odświerzeniu okna nie będzie widoczny.");
                else {
                    alert(data);
                }
            });
        }

        ctrl.moveToMain = function (id) {
            ctrl.data = data: {
                request: 'move2main',
                id: id
            }
            ctrl.move = request("post", data);
            ctrl.move.success(function (data) {
                if( data == "OK")
                    alert("Diss wysłany do poczekalni na główna.");
                else {
                    alert(data);
                }
            });
        }

        ctrl.moveToMainFast = function (id) {
            ctrl.data = data: {
                request: 'move2mainFAST',
                id: id
            }
            ctrl.move = request("post", data);
            ctrl.move.success(function (data) {
                if( data == "OK")
                    alert("Diss wysłany na główna.");
                else {
                    alert(data);
                }
            });
        }
    }

    var module = angular.module('dissApp');
    module.controller('addCtrl', ['$scope', '$http', addCtrl]);
})();
