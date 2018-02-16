let FeedackApp = angular.module('FeedackApp', []);

FeedackApp.controller('MainController', function($scope, $http, likeService) {

    $http.get("http://frer.zzz.com.ua/getMessages.php").then(function (response) {
        $scope.feedbacks = response.data;
        likeService.setAllFeedbacks($scope.feedbacks);
    });

    $scope.setLike = function(event) {
        let id = parseInt(event.target.id.slice(5));
        likeService.updateLike(id, true);
    };

    $scope.setDislike = function(event) {
        let id = parseInt(event.target.id.slice(5));
        likeService.updateLike(id, false);
    };
});

FeedackApp.service('likeService', function($http) {

    self = this;

    allLikes = [];

    this.setAllFeedbacks = function (arr) {
        self.allLikes = arr;
    };

    this.updateLike = function(id, isLike) {

        let config = {
            id:id,
            isLike: isLike
        };

        $http.get("http://frer.zzz.com.ua/setLikes.php", config).then(function () {

            self.allLikes.forEach(function (value, i) {

                if(value.id == id){

                    if(isLike){
                        self.allLikes[i].likes = parseInt(self.allLikes[i].likes) + 1;
                    }
                    else{
                        self.allLikes[i].disles = parseInt(self.allLikes[i].disles) + 1;
                    }
                }
            });

        },function () {
            console.log("error");
        });
    };

});