let ContactsApp = angular.module('ContactsApp', ["ngRoute"]);

ContactsApp.controller('MainController', function($scope, $http) {
    $http.get("http://frer.zzz.com.ua/getContacts.php").then(function (response) {
        $scope.contacts = response.data;
        console.log($scope.contacts);
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

    $scope.removePhone = function(event) {

        $http.get("http://frer.zzz.com.ua/removeContact.php", config).then(function () {

            //change scope.contacts

            $location.path( "/login" );

        },function () {
            console.log("error");
        });

    };

    $scope.savePhone = function(event) {

        let config = {
            id: $scope.current_person.id,
            tel: document.body.querySelector('.editable').textContent,
        };

        $http.get("http://frer.zzz.com.ua/saveContact.php", config).then(function () {

            //change scope.contacts

            event.target.style.display = 'none';
            document.body.querySelector('.editable').setAttribute('contenteditable', 'false');
            document.body.querySelector('.edit').style.display = 'inline';

        },function () {
            console.log("error");
        });


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


ContactsApp.controller("ListPersonsController", function ($scope, $routeParams, $location) {

    $scope.letter_name = $routeParams.letter_name.slice(1);
    console.log($scope.letter_name);

});

ContactsApp.controller("PersonInfoController", function ($scope, $routeParams, $location) {

    $scope.letter_name = $routeParams.letter_name.slice(1);
    $scope.current_person  = findById($scope.contacts, $routeParams.person_id.slice(1));

});


function findById(source, id) {
    for (var i = 0; i < source.length; i++) {
        if (source[i].id === id) {
            return source[i];
        }
    }
}
