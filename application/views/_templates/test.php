<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
    <script src="angulajs.js"></script>
</head>
<body>
<script>
    var App = angular.module('App', []);

    App.controller("test", function ($scope, $http) {
//                            $scope.변수이름 = "값";

        $scope.commentCount;

        $scope.init = function () {       //변수 초기화
            console.log('init함수 실행');
            //이거는 저기서 값을 가져올때
            /*"주소" ex) 주소/함수/변수 */
            $http.get("http://127.0.0.1/boardNcomment/comment_Count/34 ")
                .success(function (data) {

                    // 성공 했을때 ex) $scope.name = data.name;
                    $scope.commentCount = data;
                    console.log(data);

                }).error(function (data, status) {
                    // 실패 했을때 ex) console.log(status); <- f12로 확인가능
                    console.log(status);
                });
        };
        //연결된 컨트롤러에서 print json_encode(result);
        function like_click(){
            //쓰는 함수
        }
    });

</script>

<div ng-app="App">

    <div class="col-md-11 top-20" style="padding-top: 10px; padding-left: -5px;" ng-controller="test" ng-init="init()">

        <button class="btn" id="comment" ng-click="like_click()>
            <i class="icon-bubble icons"></i> {{commentCount}}
        </button>
    </div>

    <div>
        <a href="" ng-click="toggle = !toggle">Toggle nav</a>
        <ul ng-show="toggle">
            <li>Link 1</li>
            <li>Link 2</li>
            <li>Link 3</li>
        </ul>
    </div>
</div>
</body>
</html>