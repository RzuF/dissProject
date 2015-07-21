var app = angular.module('dissApp',['ngRoute', 'ngResource', 'ui.bootstrap']);
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
          .when('/rejestracja-sukcess',{
                templateUrl: 'resources/js/views/registerSuccess.html'
          })
          .when('/aktywacja/:AID',{
                templateUrl: 'resources/js/views/activationCheck.html',
                controller: 'activationCtrl as ctrl'
          })
          .when('/dodaj-dissa',{
                templateUrl: 'resources/js/views/dodaj-dissa.html',
                controller: 'addNewDissCtrl as ctrl'
          })
          .when('/notes/:noteID', {
                templateUrl: 'resources/js/views/show.html',
                controller: 'showNoteCtrl as ctrl'
          })
          .when('/user/:userID', {
                templateUrl: 'resources/js/views/user.html',
                controller: 'showUserCtrl as ctrl'
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
// Design and add all data to user profiles show
// add links to userprofiles on main and queue site and show note
// add users score

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

// <note-commands>Check out the contents, {{name}}!</note-commands>
app.directive('logInForm', function() {
    return {
        restrict: 'E',
        scope: {},
        templateUrl: 'resources/js/views/forms/logIn.html'
    };
});

app.directive('registerForm', function() {
    return {
        restrict: 'E',
        scope: {},
        templateUrl: 'resources/js/views/forms/register.html'
    };
});
