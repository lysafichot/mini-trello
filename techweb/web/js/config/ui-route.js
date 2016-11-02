techweb.config(function($stateProvider, $urlRouterProvider, $locationProvider) {

    $urlRouterProvider.otherwise('/');
    $stateProvider
        .state('home', {
            url: '/',
            templateUrl: 'js/templates/index.html'
        })
        .state('project', {
            url: '/project/:projectId',
            templateUrl: 'js/templates/project.html'
        });


});

