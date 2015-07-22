(function () {
    'use strict';

    function showUserCtrl($routeParams, userDAO) {
        var ctrl = this;
        userDAO.getInfo($routeParams.userID).then(function(data) {
            ctrl.user = data;
        });
    }

    var module = angular.module('dissApp');
    module.controller('showUserCtrl', ['$routeParams', 'userDAO', showUserCtrl]);
})();
