(function () {
    'use strict';

    function comments() {
        return {
            restrict: 'E',
            scope: {
                comments: '=commentsList',
                session: '=sessionData'
            },
            templateUrl: 'resources/js/views/directives/comments.html',
            controller: 'commentsCtrl as ctrl'
        };
    }

    var module = angular.module('dissApp');
    module.directive('comments', [comments]);

})();

// Jak wygląda teoretycznie dyrektywa?
