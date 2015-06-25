var fetch = angular.module('fetch', []);

fetch.controller('dbCtrl', ['$scope', '$http', function ($scope, $http) {
	$scope.view;
    $http.get('http://localhost:8888/dissProject/DissProject/getAll.php')
                .success(function(data){
                    $scope.data = data;
                    $scope.view = angular.fromJson($scope.data);
                    //alert(angular.fromJson($scope.data));
                })
                .error(function() {
                    $scope.data = "error in fetching data";
                    alert("Błąd w przekazywaniu danych.");
                });
        }]);

/*
var fetch = angular.module('fetch', []);

fetch.controller('dbCtrl', function($scope, $http) {

      $scope.path = '';
      $scope.url = "http://localhost:8888/dissProject/DissProject/view.php?id=1";

      $http.get($scope.url)
      .success(function(response) {
        $scope.path = response["title"];
        alert(path);
      })
      .error(function(data, status, headers, config) {
        alert("error " + status );
      });

    });
*/

