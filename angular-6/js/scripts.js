let ContactsApp = angular.module('ContactsApp', ["ngRoute"]);

ContactsApp.controller('MainController', function($scope, $http) {
    $http.get("http://frer.zzz.com.ua/getContacts.php").then(function (response) {
        $scope.contacts = response.data;
    });

    $scope.alphabet =["А","Б", "В", "Г", "Д", "Е", "Ж", "З", "И", "Й", "К", "Л", "М", "Н", "О", "П", "Р", "С", "Т", "У", "Ф", "Х", "Ц", "Ч", "Ш", "Щ", "Ъ", "Ы", "Ь", "Э", "Ю", "Я" ];

    $scope.letter_name = '';
    $scope.current_person = {};

    $scope.changeLetter = function(inLetter) {
        $scope.letter = inLetter;
    };

    $scope.startsWith = function (actual, expected) {
        let lowerStr = (actual + "").toLowerCase();
        return lowerStr.indexOf(expected.toLowerCase()) === 0;
    };

    $scope.editPhone = function(event) {
        event.target.style.display = 'none';
        document.body.querySelector('.editable').setAttribute('contenteditable', 'true');
        document.body.querySelector('.save').style.display = 'inline';
    };

});

ContactsApp.config(function($routeProvider) {
    $routeProvider
        .when('/:letter_name',
            {
                controller: 'ListPersonsController',
                templateUrl : 'templates/1.html',
            })
        .when('/:letter_name/:person_id',
            {
                controller: 'PersonInfoController',
                templateUrl : 'templates/2.html'
            })
});

ContactsApp.controller("ListPersonsController", function ($scope, $routeParams) {
    $scope.letter_name = $routeParams.letter_name.slice(1);
});

ContactsApp.controller("PersonInfoController", function ($scope, $routeParams, FindService, $http, $location) {
    $scope.letter_name = $routeParams.letter_name.slice(1);
    $scope.letter_path = $routeParams.letter_name;
    console.log($routeParams.letter_name);
    $scope.current_person  = FindService.findById($scope.contacts, $routeParams.person_id.slice(1));
    console.log($scope.current_person);

    $scope.removePhone = function(event) {
        let data = $.param({
            id: $scope.current_person.id,
        });

        let config = {
            headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        };

        let url = 'http://frer.zzz.com.ua/removeContact.php';

        $http.post(url, data, config).then(function (response) {
            let index = $scope.contacts.indexOf($scope.current_person);
            $scope.contacts.splice(index, 1);
            $location.path( "/"+$scope.letter_path );
        },function () {
            console.log("error");
        });
    };

    $scope.savePhone = function(event) {

        let data = $.param({
            id: $scope.current_person.id,
            tel: document.body.querySelector('.editable').textContent,
        });

        let config = {
            headers : {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        };

        let url = 'http://frer.zzz.com.ua/saveContact.php';

        $http.post(url, data, config).then(function () {

            let index = $scope.contacts.indexOf($scope.current_person);
            $scope.contacts[index].tel = document.body.querySelector('.editable').textContent;
            event.target.style.display = 'none';
            document.body.querySelector('.editable').setAttribute('contenteditable', 'false');
            document.body.querySelector('.edit').style.display = 'inline';

        },function () {
            console.log("error");
        });

    };
});

ContactsApp.service('FindService', function() {
    this.findById = function(source, id) {
        for (let i = 0; i < source.length; i++) {
            if (source[i].id === id) {
                return source[i];
            }
        }
    }
});
