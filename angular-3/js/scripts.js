var playersApp = angular.module("Players", []);


playersApp.controller('MainCtrl', function($scope){
    $scope.playerList = [
        {
            id: '1',
            name: "Leonel Messi",
            position: "Forward",
            jerseyNumber: 10,
            dateOfBirth: "1986-06-24",
            nationality: "Argentina",
            team: "Barcelona",
            url: 'templates/barcelona.html',
        },
        {
            id: '2',
            name: "Luis Suarez",
            position: "Striker",
            jerseyNumber: 9,
            dateOfBirth: "1987-01-24",
            nationality: "Uruguay",
            team: "Barcelona",
            url: 'templates/barcelona.html',
        },
        {
            id: '3',
            name: "Paul Pogba",
            position: "Midfield",
            jerseyNumber: 6,
            dateOfBirth: "1993-03-15",
            nationality: "France",
            team: "ManU",
            url: 'templates/man-u.html',
        },
        {
            id: '4',
            name: "David Silva",
            position: "Attacking Midfield",
            jerseyNumber: 21,
            dateOfBirth: "1986-01-08",
            nationality: "Spain",
            team: "ManCity",
            url: 'templates/man-city.html',
        },
        {
            id: '5',
            name: "Antoine Griezmann",
            position: "Forward",
            jerseyNumber: 7,
            dateOfBirth: "1991-03-21",
            nationality: "Spain",
            team: "Atletico",
            url: 'templates/atletico.html',
        },

    ];

    $scope.templates =
        [{ name: 'template1.html', url: 'template1.html'},
            { name: 'template2.html', url: 'template2.html'}];
    $scope.template = $scope.templates[0];
});



