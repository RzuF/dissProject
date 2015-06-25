function PasswordCtrl ($scope) {

	function isLongEnough( pwd ) {
		return pwd.length > 7;
	}

	function hasNumber (pwd) {
		return /[0-9]/.test(pwd);
	}

	$scope.$watch('user.password', function(newVal, odlVal) {
		if (!newVal) return;

		$scope.reqs = [];

		if (!isLongEnough(newVal)) {
			$scope.reqs.push('Hasło jest za krótkie. (min. 8 znaków)');
		}

		if (!hasNumber(newVal)) {
			$scope.reqs.push('Hasło musi posiadać chociaż jeden numer.');
		}

		$scope.showReqs = $scope.reqs.length;
	});
}

angular.module('app', [])
	.controller('PasswordCtrl', PasswordCtrl);