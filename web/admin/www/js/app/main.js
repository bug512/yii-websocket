// Include app dependency on ngMaterial
var myApp = angular.module('AdminPanel', ['ngMaterial', 'ngMessages']);
const ws = new WebSocket('ws://localhost:82');
ws.onopen = function() {
    ws.send('Hi');
};


myApp.controller("AdminPanelController", function ($scope, $mdToast, $log) {
    $scope.mainMenus = mainMenus;
    ws.onmessage = function(event) {
        $mdToast.show(
            $mdToast.simple()
                .textContent(event.data)
                .position(toastPosition)
                .hideDelay(3000))
            .then(function() {
                $log.log('Toast dismissed.');
            }).catch(function() {
            $log.log('Toast failed or was forced to close early by another toast.');
        });
    };
});

myApp.controller("LoginController", function ($scope, $mdToast, $log) {
    ws.onmessage = function(event) {
        $mdToast.show(
            $mdToast.simple()
                .textContent(event.data)
                .position(toastPosition)
                .hideDelay(3000))
            .then(function() {
                $log.log('Toast dismissed.');
            }).catch(function() {
            $log.log('Toast failed or was forced to close early by another toast.');
        });
    };
});

myApp.controller("EditCommentController", function ($scope, $mdToast, $log) {
    ws.onmessage = function(event) {
        $mdToast.show(
            $mdToast.simple()
                .textContent(event.data)
                .position(toastPosition)
                .hideDelay(3000))
            .then(function() {
                $log.log('Toast dismissed.');
            }).catch(function() {
            $log.log('Toast failed or was forced to close early by another toast.');
        });
    };
});

myApp.controller("CommentsController", function ($scope, $http, $mdToast, $log) {
    $scope.comments = comments;
    const toastPosition = 'bottom right';
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

    ws.onmessage = function(event) {
        $mdToast.show(
            $mdToast.simple()
                .textContent(event.data)
                .position(toastPosition)
                .hideDelay(3000))
            .then(function() {
                $log.log('Toast dismissed.');
            }).catch(function() {
            $log.log('Toast failed or was forced to close early by another toast.');
        });
        setTimeout(() => {$scope.updateComments();}, 300);

    };

    $scope.deleteComment = function(id) {
        $http.delete('/comments/delete/' + id + '/', {}, {withCredentials: true}).then(
            function (response) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.message)
                        .position(toastPosition)
                        .hideDelay(3000))
                    .then(function() {
                        $log.log('Toast dismissed.');
                    }).catch(function() {
                    $log.log('Toast failed or was forced to close early by another toast.');
                });

                $scope.updateComments();
            },
            function (error) {
                console.log(error);
            },
        );
    }

    $scope.approveComment = function (id) {
        $http.post('/comments/approve/' + id + '/', {}, {withCredentials: true}).then(
            function (response) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.message)
                        .position(toastPosition)
                        .hideDelay(3000))
                    .then(function() {
                        $log.log('Toast dismissed.');
                    }).catch(function() {
                    $log.log('Toast failed or was forced to close early by another toast.');
                });

                $scope.updateComments();
            },
            function (error) {
                console.log(error);
            },
        );
    }

    $scope.declineComment = function (id) {
        $http.post('/comments/decline/' + id + '/', {}, {withCredentials: true}).then(
            function (response) {
                $mdToast.show(
                    $mdToast.simple()
                        .textContent(response.data.message)
                        .position(toastPosition)
                        .hideDelay(3000))
                    .then(function() {
                        $log.log('Toast dismissed.');
                    }).catch(function() {
                    $log.log('Toast failed or was forced to close early by another toast.');
                });

                $scope.updateComments();
            },
            function (error) {
                console.log(error);
            },
        );
    }

});