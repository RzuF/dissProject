(function () {
    'use strict';

    function showUserCtrl($routeParams, showUserService) {
        var ctrl = this;
        showUserService.async($routeParams.userID).then(function(data) {
            console.log(data);
            ctrl.user = data;
        });
    }

    var module = angular.module('dissApp');
    module.controller('showUserCtrl', ['$routeParams', 'showUserService', showUserCtrl]);
})();
