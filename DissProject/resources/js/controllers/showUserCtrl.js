(function () {
    'use strict';

    function showUserCtrl($stateParams, userDAO) {
        var ctrl = this;
        userDAO.getInfo($stateParams.userID).then(function(data) {
            ctrl.user = data;
        });
    }

    var module = angular.module('dissApp');
    module.controller('showUserCtrl', ['$stateParams', 'userDAO', showUserCtrl]);
})();
