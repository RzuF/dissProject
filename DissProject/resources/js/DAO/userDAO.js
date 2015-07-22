(function () {
    'use strict';

    function userDAO($http, $q) {
        var api = function(method, url, data) {
            return $http({
                method: method,
                url: url,
                data: data
            })
        }

        var userDAO = {
            logIn: function(password, login) {
                return api('POST', 'resources/php/php_login.php', {
                    request: 'login',
                    password: password,
                    login: login
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            register: function(login, password, password2, email) {
                return api('POST', 'resources/php/php_login.php', {
                    request: 'register',
                    login: login,
                    password: password,
                    password2: password2,
                    email: email
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            emailVeryfication: function(aid) {
                return api('POST', 'resources/php/php_login.php', {
                    request: 'active',
                    active: aid
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data);
                    return defer.promise;
                });
            },
            getInfo: function(id) {
                return api('POST', 'resources/php/php_login.php', {
                    request: 'userInfo',
                    id: id
                }).then(function (backendResponse) {
                    var defer = $q.defer();
                    defer.resolve(backendResponse.data[0]);
                    return defer.promise;
                });
            }
        }

        return userDAO;
    }

    var module = angular.module('dissApp');
    module.factory('userDAO', ['$http', '$q', userDAO]);
})();
