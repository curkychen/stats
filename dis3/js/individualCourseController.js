AppControl.controller('CourseIndiv', ['$scope', '$routeParams', '$http', function($scope, $routeParams, $http){
	$http.get('partials/get/get_course_indiv.php/' + $routeParams.id)
	.success(function(data){
		$scope.course = data;
		console.log(data);
		$scope.TA = data.assistants;
		console.log(data.assistants);
		
	});
}]);