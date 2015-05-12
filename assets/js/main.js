(function() {
    'use strict';

    var app = angular.module('seoApp', ['ngRoute', 'ngSanitize']);

    app.config(['$routeProvider', '$locationProvider', function($routeProvider, $locationProvider) {

        $locationProvider.html5Mode(true);

        $routeProvider
            .when('/', {
                template: " ",
                controller: "HomeCtrl"
            })
            .when('/books', {
                templateUrl: "/assets/partials/list.html",
                controller: "BooksCtrl"
            })
            .when('/books/:id', {
                templateUrl: "/assets/partials/item.html",
                controller: "OneBookCtrl"
            })
            .when('/movies', {
                templateUrl: "/assets/partials/list.html",
                controller: "MoviesCtrl"
            })
            .when('/movies/:id', {
                templateUrl: "/assets/partials/item.html",
                controller: "OneMoviesCtrl"
            })
            .when('/comics', {
                templateUrl: "/assets/partials/list.html",
                controller: "ComicsCtrl"
            })
            .when('/comics/:id', {
                templateUrl: "/assets/partials/item.html",
                controller: "OneComicsCtrl"
            })
    }]);

    app.run(['$rootScope', function($rootScope) {
        $rootScope.pages = gPages;
    }]);

    app.controller('HomeCtrl', ['$scope', 'httpService', function($scope, httpService) {
        var httpPage = 'home';
        httpService.get(httpPage).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.controller('BooksCtrl', ['$scope', 'httpService', function($scope, httpService) {
        var httpPage = 'books';
        httpService.get(httpPage).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.controller('OneBookCtrl', ['$scope', '$routeParams', 'httpService', function($scope, $routeParams, httpService) {
        var httpPage = 'books';
        httpService.get(httpPage, $routeParams.id).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.controller('MoviesCtrl', ['$scope', 'httpService', function($scope, httpService) {
        var httpPage = 'movies';
        httpService.get(httpPage).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.controller('OneMoviesCtrl', ['$scope', '$routeParams', 'httpService', function($scope, $routeParams, httpService) {
        var httpPage = 'movies';
        httpService.get(httpPage, $routeParams.id).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.controller('ComicsCtrl', ['$scope', 'httpService', function($scope, httpService) {
        var httpPage = 'comics';
        httpService.get(httpPage).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.controller('OneComicsCtrl', ['$scope', '$routeParams', 'httpService', function($scope, $routeParams, httpService) {
        var httpPage = 'comics';
        httpService.get(httpPage, $routeParams.id).then(function(result) {
            $scope.data = result;
        });
    }]);

    app.service('httpService', ['$q', '$http', '$rootScope', function($q, $http, $rootScope) {
        this.get = function(page, id) {
            var defer = $q.defer(),
                request = {};
            request.page = page;
            if(id) request.id = id;

            $http.post('/', request).success(function(result) {
                $rootScope.title = result.title;
                document.title = result.title.name;
                if(document.title != 'Home') $rootScope.page = result.title.activeUrl || undefined;
                else $rootScope.page = result.title.activeUrl;

                defer.resolve(result.data);
            });

            return defer.promise;
        }
    }]);
})();