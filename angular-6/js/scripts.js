let ContactsApp = angular.module('ContactsApp', []);

ContactsApp.controller('MainController', function($scope, $http) {

    $http.get("tels.json").then(function (response) {
        $scope.contacts = response.data;
      console.log(response.data);
    });

});
