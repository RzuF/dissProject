var app = angular.module('dissApp',['ngRoute']);
app.config(function($routeProvider){
      $routeProvider
          .when('/',{
                templateUrl: 'resources/js/views/all.html'
          })
          .when('/poczekalnia',{
                templateUrl: 'resources/js/views/poczekalnia.html'
          })
          .when('/logowanie',{
                templateUrl: 'resources/js/views/log.html'
          })
          .when('/dodaj-dissa',{
                templateUrl: 'resources/js/views/dodaj-dissa.php'
          })
          .when('/notes/:noteID', {
                templateUrl: 'resources/js/views/show.html',
                controller: 'showNoteCtrl'
          })
          .when('/profil',{
                templateUrl: 'resources/js/views/profile.html'
          })
          .otherwise({
            redirectTo: '/'
          });
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

/* Main site */
app.controller('mainPageCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.view;
        $http.get('resources/php/getAll.php?id=1')
            .success(function(data){
                $scope.data = data;
                $scope.view = angular.fromJson($scope.data);
            })
            .error(function() {
                $scope.data = "error in fetching data";
                alert("Błąd w przekazywaniu danych.");
            });
}]);

/* Session */
app.controller('sessionCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.session;
    $scope.sessionCheck = function() {
        var request = $http({
            method: "post",
            url: 'resources/php/php_login.php',
            data: {
                request: 'session',
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        })

        request.success(function (data) {
            $scope.data = data;
            $scope.session = angular.fromJson($scope.data);
        });

        request.error(function (data) {
            $scope.data = "error in fetching data";
                    alert("Błąd w przekazywaniu danych.");
        });
    };

    /* Check session on visit */
    $scope.sessionCheck();
}]);

/* Queqe */
app.controller('poczekalniaPageCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.view;
        $http.get('resources/php/getAll_poczekalnia.php?id=1')
            .success(function(data){
                $scope.data = data;
                $scope.view = angular.fromJson($scope.data);
                //alert(angular.fromJson());
            })
            .error(function() {
                $scope.data = "error in fetching data";
                alert("Błąd w przekazywaniu danych.");
            });
}]);

/* Sing up */
app.controller('sign-up', function ($scope, $http, $location) {
    $scope.somethingwentwrong = "NOPE";
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
                $scope.sessionCheck();
                $location.path("/");
            }
            else {
                $scope.ok = false;
                data = data.replace("ERROR:", "");
                $scope.somethingwentwrong = data;
            }
        });
    }
});

/* Loging out */
app.controller('log-out', function ($scope, $http, $location) {
    $scope.somethingwentwrong = "NOPE";
    $scope.logout = function () {
        var request = $http({
            method: "post",
            url: 'resources/php/php_login.php',
            data: {
                request: 'logout',
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
            });

        /* Check whether the HTTP Request is successful or not. */
        request.success(function (data) {
            if( data == "OK") {
                $scope.sessionCheck();
                $location.path("/");
                //window.location.replace("/dissProject/DissProject/"); // !!!!! view reload !!!!!!
            }
            else {
                alert(data);
            }
        });
    }
});

/* Adding new rates */
app.controller('rate', function ($scope, $http) {

    $scope.ratemark = 0;
    $scope.rateinfo = function() {
        return $scope.ratemark;
    }

    $scope.rate = function (id, type) {
        var request = $http({
            method: "post",
            url: 'resources/php/php_add.php',
            data: {
                request: 'rate',
                id: id, // id posta
                type: type // type plus or minus
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        /* Check whether the HTTP Request is successful or not. */
        request.success(function (data) {
            if( data == "plus")
                $scope.ratemark = 1;
            else if(data == "minus")
                $scope.ratemark = -1;
            else
                alert(data);
        });
    }
});

/* Adding new diss */
app.controller('add-diss', function ($scope, $http, $location) {
    $scope.somethingwentwrong = "NOPE";
    $scope.ok = true;
    $scope.errorMessage = false;
    $scope.isDisable = false;

    $scope.add = function () {
        $scope.ok = false;
        $scope.errorMessage = false;
        $scope.myClass = "alert-success"
        $scope.somethingwentwrong = " Trwa przetwarzanie obrazka.";
        $scope.isDisable = true;
        var request = $http({
            method: "post",
            url: 'resources/php/php_add.php',
            data: {
                request: 'add',
                dissName: $scope.dissName,
                dissText: $scope.dissText,
                dissTags: $scope.dissTags
            },
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        request.success(function (data) {
            if( data.search("ERROR") != -1) {
                $scope.isDisable = false;
                $scope.ok = false;
                $scope.errorMessage = true;
                $scope.myClass = "alert-danger"
                data = data.replace("ERROR:", "");
                $scope.somethingwentwrong = data;
            }
            else {
                data = data.replace("OK: ", "");
                var id = data;
                $location.path("/notes/" + id);
              }
        });
    }
});

/* Removing posts */
app.controller('deleteCtrl', function ($scope, $http) {
    $scope.delete = function (id) {
        var request = $http({
        method: "post",
        url: 'resources/php/php_add.php',
        data: {
            request: 'delete',
            id: id
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

        /* Check whether the HTTP Request is successful or not. */
        request.success(function (data) {
            if( data == "OK")
                alert("Diss został usunięty. Po odświerzeniu okna nie będzie widoczny.");
            else {
                alert(data);
            }
        });
    }
});

/* Move to main (queue)*/
app.controller('moveToMainCtrl', function ($scope, $http) {
    $scope.moveToMain = function (id) {
        var request = $http({
        method: "post",
        url: 'resources/php/php_add.php',
        data: {
            request: 'move2main',
            id: id
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        /* Check whether the HTTP Request is successful or not. */
        request.success(function (data) {
            if( data == "OK")
                alert("Diss wysłany do poczekalni na główna.");
            else {
                alert(data);
            }
        });
    }
});

/* Move to main (direct) */
app.controller('moveToMainFastCtrl', function ($scope, $http) {
    $scope.moveToMainFast = function (id) {
        var request = $http({
        method: "post",
        url: 'resources/php/php_add.php',
        data: {
            request: 'move2mainFAST',
            id: id
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        });

        /* Check whether the HTTP Request is successful or not. */
        request.success(function (data) {
            if( data == "OK")
                alert("Diss wysłany na główna.");
            else {
                alert(data);
            }
        });
    }
});

/* Showing notes */
app.controller('showNoteCtrl', function($scope, $routeParams, $http) {
    $scope.noteID = $routeParams.noteID;
    $scope.view;

    var request = $http({
        method: "post",
        url: 'resources/php/php_add.php',
        data: {
            request: 'show',
            id: $scope.noteID
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    /* Check whether the HTTP Request is successful or not. */
    request.success(function (data) {
        $scope.data = data;
        $scope.view = angular.fromJson($scope.data);
    });

    request.error(function (data) {
        $scope.data = "error in fetching data";
                alert("Błąd w przekazywaniu danych.");
    });

});
