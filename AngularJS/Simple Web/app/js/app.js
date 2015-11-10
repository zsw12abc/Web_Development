var myApp = angular.module('myApp', ['ui.router']);
myApp.config(function($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.otherwise('/index');
    $stateProvider
        .state('index', {
            url: '/index',
            views: {
                '': {
                    templateUrl: 'pages/index.html'
                },
                'topbar@index': {
                    templateUrl: 'pages/topbar.html'
                },
                'main@index': {
                    templateUrl: 'pages/home.html'
                }
            }
        })
        .state('index.os', {
            url: '/os',
            views: {
                'main@index': {
                    templateUrl: 'pages/os.html',
                    controller: 'rootCtrl'
                }
            }
        })
        .state('index.about', {
            url: '/about',
            views: {
                'main@index': {
                    url: '/about',
            templateUrl: 'pages/about.html'
                }
            }
        })
        .state('index.contact', {
            url: '/contact',
            views: {
                'main@index': {
                    url: '/contact',
            templateUrl: 'pages/contact.html'
                }
            }
        })
        .state('index.settings', {
            url: '/settings',
            views: {
                'main@index': {
                    template: '这里是系统设置'
                }
            }
        })
});