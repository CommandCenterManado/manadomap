(function () {
    'use strict';

    angular
        .module('manado.map')
        .run(runBlock);

    runBlock.inject = ['$rootScope', 'baseService'];
    function runBlock($rootScope, baseService) {
        baseService.user.login();
        $rootScope.$on('$stateChangeSuccess', function(e, tS, tP, fS, fP){
            console.log(tS);
        })
    }
})();

(function () {
    'use strict';

    angular
        .module('manado.map')
        .config(routeConfig);

    routeConfig.inject = ['$stateProvider', '$urlRouterProvider', '$locationProvider'];
    function routeConfig($stateProvider, $urlRouterProvider, $locationProvider) {
        $urlRouterProvider.otherwise('/')

        $stateProvider
            .state('main', {
                url: '/',
                views: {
                    'mainBody': {
                        templateUrl: 'view/main.body.html',
                        controller: 'mainBodyController as mainvm'
                    },
                    'quickMenu': {
                        templateUrl: 'view/quick.menu.html',
                        controller: 'quickMenuController as vm'
                    }
                }
            })
    }
})();