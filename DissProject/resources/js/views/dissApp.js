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
          });
});

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

app.controller('sign-up', function ($scope, $http) {
  /*
  * This method will be called on click event of button.
  * Here we will read the email and password value and call our PHP file.
  */
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
        $scope.somethingwentwrong = data;
    }
    });
  }
});



