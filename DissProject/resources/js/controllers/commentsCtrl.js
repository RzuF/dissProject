(function () {
    'use strict';

    function commentsCtrl($routeProvider) {
        var ctrl = this;

        /* ctrl.addComment = function(noteID, commentText) {
            addCommentService.async(noteID, commentText).then(function(data) {
                alert(data);
                $route.reload(); // resfesh to show new comment
            });
        };
        // $request = 'add';
        // $id; (note ID)
        // commentText
        // echo "OK: $l_id"; if was successful & ID inserted item
        // 'ERROR:' + description
        ctrl.deleteComment = function(noteID, userState) {
            if(userState < 2)
                alert("Nie masz takich uprawnień");
            else
                deleteCommentService.async(noteID).then(function(data) {
                    alert(data);
                });
        };
        // $request = 'delete';
        // $id; comments
        // check session state 2 > ok

        var commentRate.mark = 0;
        commentRate.info = function() {
            return commentRate.mark;
        };

        ctrl.addCommentRate = function(id, type) {
            addCommentRateService.async(id, type).then (function(data) {
                if( data == "plus")
                    commentRate.mark = 1;
                else if(data == "minus")
                    commentRate.mark = -1;
                else
                    alert(data);
            });
        };
        // $request = 'rate';
        // $id;
        // $type = 'plus' || $type = 'minus'
        */

        ctrl.showComments = function(noteID) {
            showCommentsService.async(noteID).then(function(data){
                console.log(data);
            });
        }
        // $request = 'show';
        // $id -> note id for which you request comments
    }

    var module = angular.module('dissApp');
    module.controller('commentsCtrl', ['$routeProvider', commentsCtrl]);
})();
