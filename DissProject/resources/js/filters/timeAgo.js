(function () {
    'use strict';

    function timeAgo() {
        return function(input) {
            moment.locale('pl');
            return moment(input, "YYYY-MM-DD hh:mm:ss").fromNow();
        };
    }

    var module = angular.module('dissApp');
    module.filter('timeAgo', [timeAgo]);
})();
