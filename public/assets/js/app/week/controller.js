
angular
    .module('hotseat')
    .controller('WeekCtrl', function($scope, weekData) {

    	var firstDay = moment().weekday(-6);
    	var lastDay = moment().weekday(0);

    	$scope.days = [];

    	for (var i = 0; i <= 6; i++) {
    		$scope.days[i] = moment().weekday(i - 6).valueOf();
    	};

    	console.log($scope.days);

    	$scope.desks = weekData.data.desks;
    })