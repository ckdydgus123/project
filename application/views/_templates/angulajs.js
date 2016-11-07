
var myApp = angular.module('myApp', []);

myApp.controller('MainCtrl', ['$scope', function ($scope) {

    $scope.commentCount;

    $http({
        method: 'GET',
        url: '//127.0.0.1/boardNcomment/comment_Count/'
    })

}]);