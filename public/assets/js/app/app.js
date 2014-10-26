var hotseat = angular.module('hotseat', ['ui.router', 'angularMoment']);


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
      controller : 'WeekCtrl as week',
      resolve: {
	      weekData:  function($http) {
	        // $http returns a promise for the url data
	        return $http({method: 'GET', url: '/desks'});
	      }
	    }
    });
});