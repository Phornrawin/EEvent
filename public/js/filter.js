let sortApp = angular.module('sortApp', [], function ($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

sortApp.controller('userController', function ($scope, $http) {
    $scope.sortType = 'name'; // set the default sort type
    $scope.sortReverse = false;  // set the default sort order
    $scope.searchName = '';     // set the default search/filter term

    $scope.users = [];

    $scope.deleteUser = function (id) {
        let conf = confirm("Do you really want to delete this task?" + id);
        if (conf === true) {
            $http({
                url: '/admin/users/' + id,
                method: "DELETE",
            }).success(function (data) {
                console.log(data);
                location.reload();
            }).error(function (status) {
                console.log(status);
                console.log('data');
                alert('unable to delete');
            });
        }
    };

    $scope.editView = function (id) {
        window.location.replace('users/' + id + '/edit');
    };

    $scope.init = function () {
        $http({
            url: '/api/users',
            method: "GET",
        }).success(function (data, status, headers, config) {
            $scope.users = data;
        });
    };

    $scope.init();
});
sortApp.controller('eventController', function ($scope, $http) {
    $scope.sortType = 'name'; // set the default sort type
    $scope.sortReverse = false;  // set the default sort order
    $scope.searchName = '';     // set the default search/filter term

    $scope.events = [];

    $scope.deleteUser = function (id) {
        let conf = confirm("Do you really want to delete this task?" + id);
        if (conf === true) {
            $http({
                url: '/admin/events/' + id,
                method: "DELETE",
            }).success(function (data) {
                console.log(data);
                location.reload();
            }).error(function (status) {
                console.log(status);
                console.log('data');
                alert('unable to delete');
            });
        }
    };

    $scope.editView = function (id) {
        window.location.replace('events/' + id + '/edit');
    };

    $scope.init = function () {
        $http({
            url: '/api/events',
            method: "GET",
        }).success(function (data, status, headers, config) {
            $scope.events = data;
        });
    };

    $scope.init();
});

