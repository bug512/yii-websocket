// Include app dependency on ngMaterial
var myApp = angular.module('FrontPanel', ['ngMaterial', 'ngMessages']);
const ws = new WebSocket('ws://localhost:82');

myApp.controller("FrontPanelController", function ($scope) {
    $scope.mainMenus = mainMenus;
});

myApp.controller("WriteCommentController", function ($scope) {
    ws.OPEN;
    $scope.author_name = modelComment.author_name
    $scope.content = modelComment.content
    $scope.beforeSubmit = function() {
        ws.send('New commnent from author: ' + $scope.author_name + '. He wrote a comment: ' + $scope.content);
        ws.onmessage = function(event) {
            console.log(`[message] Data received from server: ${event.data}`);
        };
    }
});

myApp.controller("CommentsController", function ($scope, $http, $mdToast, $log) {
    $scope.comments = comments;

    $scope.updateComments = function() {
        $http.get('/comments/list/', {}, {withCredentials: true}).then(
            function (response) {
                $scope.comments = response.data;
            },
            function (error) {
                console.log(error);
            },
        );
    }
});