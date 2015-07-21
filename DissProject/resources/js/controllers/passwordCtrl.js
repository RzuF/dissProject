(function () {
    'use strict';

    function PasswordCtrl($scope) {
        var ctrl = this;
		ctrl.showReqs;

		function isLongEnough( pwd ) {
		  return pwd.length > 7;
		}

		function hasNumber (pwd) {
		  return /[0-9]/.test(pwd);
		}

		$scope.$watch('user.password', function(newVal, odlVal) {
		  if (!newVal) return;

		  this.reqs = [];

		  if (!isLongEnough(newVal)) {
			ctrl.reqs.push('Hasło jest za krótkie. (min. 8 znaków)');
		  }

		  if (!hasNumber(newVal)) {
			ctrl.reqs.push('Hasło musi posiadać chociaż jeden numer.');
		  }

		  ctrl.showReqs = ctrl.reqs.length;
		});
    }

    var module = angular.module('dissApp');
    module.controller('PasswordCtrl', ['$scope', PasswordCtrl]);
})();
