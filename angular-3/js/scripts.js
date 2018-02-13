var PhotoAlbum = angular.module('PhotoAlbum', []);

PhotoAlbum.controller('MainCtrl', function($scope) {
    $scope.pictures = [
        'photo (1).jpg',
        'photo (2).jpg',
        'photo (3).jpg',
        'photo (4).jpg',
        'photo (5).jpg',
        'photo (6).jpg',
        'photo (7).jpg',
    ];
});

PhotoAlbum.directive('photoAlbum', function() {
    return {
        restrict: 'E',
        transclude: 'true',
        scope:'@',
        template: '<h2 ng-transclude>Фотоальбом</h2>',
        link: function(scope, element, attr){
            scope.countInRow = attr.inRow;
            scope.width = attr.width+'px';
            scope.height = attr.height+'px';
            scope.countOfCorners = attr.corners;

            scope.pictures.forEach(function (val, i) {
                element.append("<img class='img-item' style='width: "+scope.width+"; height: "+scope.height+"; border-radius: "+scope.countOfCorners+"' src='img/"+val+"'></img>")
                if((i+1) % scope.countInRow === 0){
                    element.append("<br />")
                }
            });
         }
    };
});