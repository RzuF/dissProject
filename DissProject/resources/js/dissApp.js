var app = angular.module('dissApp',['ngRoute', 'ngResource', 'ui.bootstrap', 'ui.router']);
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
// Directive for commands and rate buttons
// Design and add all data to user profiles show
// add links to userprofiles on main and queue site and show note
// add users score

/* Main site */
/* Find better solution for que bollean value | Directive?*/
app.controller('mainPageCtrl', ['notesDAO', function (notesDAO) {
    var ctrl = this;
    ctrl.que = false;
    notesDAO.getAllNotesMainPage().then(function(data) {
        ctrl.view = data;
    });
}]);

/* Queqe | Directive? */
app.controller('poczekalniaPageCtrl', ['notesDAO', function (notesDAO) {
    var ctrl = this;
    ctrl.que = true;
    notesDAO.getAllNotesWaitPage().then(function(data) {
        ctrl.view = data;
    });
}]);

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
/*
[
{"id":"26","0":"26","title":"okokok","1":"okokok","difference":"0","2":"0","date":"2015-07-22 13:04:33","3":"2015-07-22 13:04:33","login":"rzuf","4":"rzuf","tags":null,"5":null,"comments":"0","6":"0"},
{"id":"25","0":"25","title":"okok","1":"okok","difference":"0","2":"0","date":"2015-07-22 13:00:49","3":"2015-07-22 13:00:49","login":"rzuf","4":"rzuf","tags":null,"5":null,"comments":"0","6":"0"},
{"id":"20","0":"20","title":"okok","1":"okok","difference":"-1","2":"-1","date":"2015-07-21 14:51:05","3":"2015-07-21 14:51:05","login":"test","4":"test","tags":null,"5":null,"comments":"0","6":"0"}
]
[
{"id":"31","0":"31","title":"okokokookok","1":"okokokookok","difference":"0","2":"0","date":"2015-07-22 13:10:37","3":"2015-07-22 13:10:37","login":"rzuf","4":"rzuf","tags":null,"5":null,"state":"0","6":"0","comments":"0","7":"0"},
{"id":"30","0":"30","title":"okoko","1":"okoko","difference":"0","2":"0","date":"2015-07-22 13:09:17","3":"2015-07-22 13:09:17","login":"rzuf","4":"rzuf","tags":null,"5":null,"state":"0","6":"0","comments":"0","7":"0"},
{"id":"29","0":"29","title":"okok","1":"okok","difference":"0","2":"0","date":"2015-07-22 13:07:58","3":"2015-07-22 13:07:58","login":"rzuf","4":"rzuf","tags":null,"5":null,"state":"0","6":"0","comments":"0","7":"0"},
{"id":"28","0":"28","title":"okok","1":"okok","difference":"0","2":"0","date":"2015-07-22 13:06:46","3":"2015-07-22 13:06:46","login":"rzuf","4":"rzuf","tags":null,"5":null,"state":"0","6":"0","comments":"0","7":"0"},
{"id":"27","0":"27","title":"kkk","1":"kkk","difference":"0","2":"0","date":"2015-07-22 13:05:34","3":"2015-07-22 13:05:34","login":"rzuf","4":"rzuf","tags":null,"5":null,"state":"0","6":"0","comments":"0","7":"0"}
]

[{"id":"26","0":"26","title":"okokok","1":"okokok","difference":"0","2":"0","date":"2015-07-22 13:04:33","3":"2015-07-22 13:04:33","login":"rzuf","4":"rzuf","tags":null,"5":null,"comments":"0","6":"0"},
{"id":"25","0":"25","title":"okok","1":"okok","difference":"0","2":"0","date":"2015-07-22 13:00:49","3":"2015-07-22 13:00:49","login":"rzuf","4":"rzuf","tags":null,"5":null,"comments":"0","6":"0"},
{"id":"20","0":"20","title":"okok","1":"okok","difference":"-1","2":"-1","date":"2015-07-21 14:51:05","3":"2015-07-21 14:51:05","login":"test","4":"test","tags":null,"5":null,"comments":"0","6":"0"}
] */
