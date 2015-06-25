app.controller('dbCtrl', ['$scope', '$http', function ($scope, $http) {
  $scope.view;
    $http.get('http://localhost:8888/dissProject/DissProject/view.php?id=1')
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