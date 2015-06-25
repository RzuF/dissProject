var app=angular.module('dissApp',['ngRoute']);
app.config(function($routeProvider){
      $routeProvider
          .when('/',{
                templateUrl: 'home.html'
          })
          .when('/logowanie',{
                templateUrl: 'log.php'
          })
          .when('/dodaj-dissa',{
                templateUrl: 'dodaj-dissa.php'
          })
          .when('/all',{
                templateUrl: 'all.php'
          });
});

app.controller('cfgController',function($scope){

    /*      
    Here you can handle controller for specific route as well.
    */
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
        $http.get('http://localhost:8888/dissProject/DissProject/getAll.php?id=1')
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



