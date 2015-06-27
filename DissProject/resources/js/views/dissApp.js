var app=angular.module('dissApp',['ngRoute']);
app.config(function($routeProvider){
      $routeProvider
          .when('/',{
                templateUrl: 'all.html'
          })
          .when('/logowanie',{
                templateUrl: 'log.html'
          })
          .when('/dodaj-dissa',{
                templateUrl: 'dodaj-dissa.php'
          })
          .when('/pokaz',{
                templateUrl: 'show.html'
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

/* Main site */
app.controller('dbCtrl', ['$scope', '$http', function ($scope, $http) {
    $scope.view;
        $http.get('http://localhost:8888/dissProject/DissProject/resources/php/getAll.php?id=1')
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
app.controller('sign-up', function ($scope, $http) {
    $scope.somethingwentwrong = "NOPE";
    $scope.ok = true;

    $scope.check_credentials = function () {
        var request = $http({
        method: "post",
        url: 'http://localhost:8888/dissProject/DissProject/resources/php/php_login.php',
        data: {
            request: 'login',
            password: $scope.password,
            login: $scope.login
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    /* Check whether the HTTP Request is successful or not. */
    request.success(function (data) {
        if( data == "OK") {
            window.location.replace("/dissProject/DissProject/");
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
app.controller('log-out', function ($scope, $http) {
    $scope.somethingwentwrong = "NOPE";
    $scope.logout = function () {
        var request = $http({
        method: "post",
        url: 'http://localhost:8888/dissProject/DissProject/resources/php/php_login.php',
        data: {
            request: 'logout',
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    /* Check whether the HTTP Request is successful or not. */
    request.success(function (data) {
        if( data == "OK") {
            window.location.replace("/dissProject/DissProject/");
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
        url: 'http://localhost:8888/dissProject/DissProject/resources/php/php_add.php',
        data: {
            request: 'rate',
            id: id, // id posta
            type: type // type plus or minus
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    /* Check whether the HTTP Request is successful or not. */
    request.success(function (data) {
        if( data == "plus") {
          $scope.ratemark = 1;
        }
        else if(data == "minus")
          $scope.ratemark = -1;
        else {
          //alert(data);
        }
    });
  }
});

/* Adding new disses */
app.controller('add-diss', function ($scope, $http) {
    $scope.somethingwentwrong = "NOPE";
    $scope.ok = true;

    $scope.add = function () {
        var request = $http({
        method: "post",
        url: 'http://localhost:8888/dissProject/DissProject/resources/php/php_add.php',
        data: {
            request: 'add',
            dissName: $scope.dissName,
            dissText: $scope.dissText,
            dissTags: $scope.dissTags
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    /* Check whether the HTTP Request is successful or not. */
    request.success(function (data) {
        if( data == "ERROR: Pole tekst nie może być puste" || data == "ERROR: Pole tytuł nie może być puste") {
            $scope.ok = false;
            data = data.replace("ERROR:", "");
            $scope.somethingwentwrong = data;
        }
        else {
            alert("Wsio ok!");
        }
    });
  }
});

/* Removing posts */
app.controller('deleteCtrl', function ($scope, $http) {
    $scope.delete = function (id) {
        var request = $http({
        method: "post",
        url: 'http://localhost:8888/dissProject/DissProject/resources/php/php_add.php',
        data: {
            request: 'delete',
            id: id
        },
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    });

    /* Check whether the HTTP Request is successful or not. */
    request.success(function (data) {
        if( data == "OK") {
            alert("Diss został usunięty.");
            $route.reload();
        }
        else {
            alert(data);
        }
    });
  }
});


