var app = angular.module('dissApp',['ngRoute', 'ngResource', 'ui.bootstrap', 'ui.router', 'ngAnimate']);
app.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise("/");
    $stateProvider
        .state('Strona główna', {
            url: "/",
            templateUrl: 'resources/js/views/displayAllNotes.html',
            controller: 'mainPageCtrl as ctrl'
        })
        .state('Poczekalnia', {
            url: "/poczekalnia",
            templateUrl: 'resources/js/views/displayAllNotes.html',
            controller: 'poczekalniaPageCtrl as ctrl'
            })
        .state('Logowanie', {
            url: "/logowanie",
            templateUrl: 'resources/js/views/log.html'
            })
        .state('Rejestracja', {
            url: "/rejestracja-sukcess",
            templateUrl: 'resources/js/views/registerSuccess.html'
            })
        .state('Aktywacja',{
            url: '/aktywacja/:AID',
            templateUrl: 'resources/js/views/activationCheck.html',
            controller: 'activationCtrl as ctrl'
        })
        .state('Dodaj dissa',{
            url: '/dodaj-dissa',
            templateUrl: 'resources/js/views/dodaj-dissa.html',
            controller: 'addNewDissCtrl as ctrl'
        })
        .state('Diss', {
            url: '/notes/:noteID',
            templateUrl: 'resources/js/views/show.html',
            controller: 'showNoteCtrl as ctrl'
        })
        .state('Użytkownik', {
            url: '/user/:userID',
            templateUrl: 'resources/js/views/user.html',
            controller: 'showUserCtrl as ctrl'
        })
        .state('Profil',{
            url: '/profil',
            templateUrl: 'resources/js/views/profile.html'
        })
    });
// Design and add all data to user profiles show
// add links to userprofiles on main and queue site and show note
// add users score

/* Main site */
app.controller('mainPageCtrl', ['$scope', 'notesDAO', 'userDAO', function ($scope, notesDAO, userDAO) {
    var ctrl = this;
    ctrl.que = 0;
    notesDAO.getAllNotesMainPage().then(function(data) {
        ctrl.view = data;
    });
}]);

/* Queqe */
app.controller('poczekalniaPageCtrl', ['$scope', 'notesDAO', function ($scope, notesDAO) {
    var ctrl = this;
    ctrl.que = 1;
    notesDAO.getAllNotesWaitPage().then(function(data) {
        ctrl.view = data;
    });
}]);

app.directive('logInForm', function() {
    return {
        restrict: 'E',
        scope: {},
        templateUrl: 'resources/js/views/forms/logIn.html',
        controller: 'logInCtrl as login'
    };
});

app.directive('registerForm', function() {
    return {
        restrict: 'E',
        scope: {},
        templateUrl: 'resources/js/views/forms/register.html',
        controller: 'registerCtrl as register'
    };
});
