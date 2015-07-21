var app = angular.module('dissApp',['ngRoute', 'ngResource']);
app.config(function($routeProvider){
      $routeProvider
          .when('/',{
                templateUrl: 'resources/js/views/all.html',
                controller: 'mainPageCtrl as ctrl'
          })
          .when('/poczekalnia',{
                templateUrl: 'resources/js/views/all.html',
                controller: 'poczekalniaPageCtrl as ctrl'
          })
          .when('/logowanie',{
                templateUrl: 'resources/js/views/log.html'
          })
          .when('/dodaj-dissa',{
                templateUrl: 'resources/js/views/dodaj-dissa.html',
                controller: 'addNewDissCtrl as ctrl'
          })
          .when('/notes/:noteID', {
                templateUrl: 'resources/js/views/show.html',
                controller: 'showNoteCtrl as ctrl'
          })
          .when('/profil',{
                templateUrl: 'resources/js/views/profile.html'
          })
          .otherwise({
            redirectTo: '/'
          });
});
// Directive for commands and rate buttons
// Change to stateProvider (login and register)
// Think about login / sing in in isolate states

/* Main site */
/* Find better solution for que bollean value | Directive?*/
app.controller('mainPageCtrl', ['notesDAO', function (notesDAO) {
    var ctrl = this;
    ctrl.que = false;
    notesDAO.getAllMain().then(function(data) {
        ctrl.view = data;
    });
}]);

/* Queqe | Directive? */
app.controller('poczekalniaPageCtrl', ['notesDAO', function (notesDAO) {
    var ctrl = this;
    ctrl.que = true;
    notesDAO.getAllQueue().then(function(data) {
        ctrl.view = data;
    });
}]);

/* Delete, moveToMain and moveToMainFast functions in dropdown | Change to directive*/
app.controller('notesCommands', ['deleteService', 'moveToMainService', 'moveToMainFastService', function(deleteService, moveToMainService, moveToMainFastService) {
    var ctrl = this;
    ctrl.delete = function(id) {
        deleteService.async(id).then(function(data) {
            alert(data);
        });
    };

    ctrl.moveToMain = function(id) {
        moveToMainService.async(id).then(function(data) {
            alert(data);
        });
    };

    ctrl.moveToMainFast = function(id) {
        moveToMainFastService.async(id).then(function(data) {
            alert(data);
        });
    };
}]);

/* Adding new marks | Change to directive */
app.controller('rateCtrl', function (addNewMarkService) {
    var rate = this;
    rate.mark = 0;
    rate.info = function() {
        return rate.mark;
    };

    rate.addNewMark = function(id, type) {
        addNewMarkService.async(id, type).then (function(data) {
            if( data == "plus")
                rate.mark = 1;
            else if(data == "minus")
                rate.mark = -1;
            else
                alert(data);
        });
    };
});

/* Sing up */
app.controller('sign-up', function ($rootScope, $scope, $http, $location) {
    $scope.returnMessage = "";
    $scope.ok = true;

    $scope.check_credentials = function () {
        var request = $http({
            method: "post",
            url: 'resources/php/php_login.php',
            data: {
                request: 'login',
                password: $scope.password,
                login: $scope.login
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        request.success(function (data) {
            if( data == "OK") {
                $rootScope.sessionCheck();
                $location.path("/");
            }
            else {
                $scope.ok = false;
                data = data.replace("ERROR:", "");
                $scope.returnMessage = data;
            }
        });
    }
});

/* Reqister, password controllelr */
app.controller('PasswordCtrl', function($scope) {

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
});

/* Reqister, mail validator
function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}
*/

// <note-commands>Check out the contents, {{name}}!</note-commands>
app.directive('noteCommands', function() {
    return {
        restrict: 'E',
        transclude: true,
        scope: {},
        templateUrl: 'my-dialog.html',
        link: function (scope, element) {
          scope.name = 'Jeff';
        }
    };
});
