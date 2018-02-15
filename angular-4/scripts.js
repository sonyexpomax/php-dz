let WeatherApp = angular.module('WeatherApp', []);

WeatherApp.controller("MainController", function($scope, $http) {

    $scope.forecast = [];
                $http.get("http://api.apixu.com/v1/forecast.json?key=dc9e7f1f5fa84d4aa80193340162710&q=Dnepropetrovsk&days=7").then(function (response) {
                    console.log(response.data);
                    $.each(response.data['forecast']['forecastday'], function( index, value ) {
                        $scope.forecast.push({
                            date: value.date,
                            avrtemp: value.day.avgtemp_c,
                            text: value.day.condition.text
                        });
                    });
                    $scope.currentDay = $scope.forecast[0];
                });

            $scope.nextDay = function() {
                currentIndex = $scope.forecast.indexOf($scope.currentDay);
                if($scope.forecast[currentIndex+1]){
                    console.log('true');
                    $scope.currentDay = $scope.forecast[currentIndex+1];
                }
                console.log( $scope.forecast.indexOf($scope.currentDay));
            };

            $scope.prevDay = function() {
                currentIndex = $scope.forecast.indexOf($scope.currentDay);

                if($scope.forecast[currentIndex-1]){
                    console.log('true');
                    $scope.currentDay = $scope.forecast[currentIndex-1];
                }
                console.log( $scope.forecast.indexOf($scope.currentDay));
            };
        });

WeatherApp.directive('weatherWidget', function() {

    return {
        link: function($scope, element, attrs) {
            element.append(
                "<h3>{{curentDay.date}}</h3>" +
                "<h4>Температура: {{curentDay.avrtemp}} \u2103</h4>" +
                "<h5>{{curentDay.text}}</h5>");
            console.log(element);
            $scope.$watch("currentDay", function() {
                element.find('h3').text($scope.currentDay.date);
                element.find('h4').text('Температура: ' + $scope.currentDay.avrtemp + `\u2103`);
                element.find('h5').text($scope.currentDay.text);
            });

        }
    }
});
