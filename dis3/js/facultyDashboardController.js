AppControl.controller('FacultyDashboard', ['$scope', '$http', function($scope, $http){
	$http.get('partials/get/get_all_faculty.php').success(function(data){
		$scope.faculty = data;
	});


}]);
			