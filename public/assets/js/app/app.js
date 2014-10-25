var hotseat = angular.module('hotseat', ['ui.router']);


hotseat.config(function($stateProvider, $urlRouterProvider) {
  //
  // For any unmatched url, redirect to /state1
  $urlRouterProvider.otherwise("/");
  //
  // Now set up the states
  $stateProvider
    .state('week', {
      url: "/",
      templateUrl: "assets/partials/week.html",
      controller : 'WeekCtrl',
      resolve: {
	      weekData:  function($http) {
	        // $http returns a promise for the url data
	        return $http({method: 'GET', url: '/desks'});
	      }
	    }
    })
    .state('state1.list', {
      url: "/list",
      templateUrl: "partials/state1.list.html",
      controller: function($scope) {
        $scope.items = ["A", "List", "Of", "Items"];
      }
    })
    .state('state2', {
      url: "/state2",
      templateUrl: "partials/state2.html"
    })
    .state('state2.list', {
      url: "/list",
      templateUrl: "partials/state2.list.html",
      controller: function($scope) {
        $scope.things = ["A", "Set", "Of", "Things"];
      }
    });
});