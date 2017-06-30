AppControl.controller('courseList', ['$scope', '$http', function($scope, $http){
	
	$scope.newCourse = {};
	
	$http.get('partials/get/get_courses.php').success(function(data){
		$scope.courses = data;
	});
	
	$http.get('partials/get/get_semesters.php').success(function(data){
		$scope.semesters = data;
		$scope.newCourse.semester = $scope.semesters[0].semester;
	});

	$http.get('partials/get/get_instructors.php').success(function(data) {
		$scope.instructors = data;
	});
	
	$scope.selectCourse = function(courseSelect){
		$scope.selectedCourse = courseSelect.id;
		$scope.loadCourse();
	};
	
	$scope.loadCourse = function(){
		$http.get('partials/get/get_course_indiv.php/' + $scope.selectedCourse)
		.success(function(data){
			$scope.courseIndiv = data;
			$scope.TA = data.assistants;
		});
	};
	
	$scope.showCourse = false;
	
	$scope.toggleAddCourse = function(){
		$scope.showCourse = !$scope.showCourse;
	};
	
	$scope.addCourse = function(){
		$http.post('partials/courses/add_course.php', $scope.newCourse)
        .success(function(data, status, headers, config)
        {
        	$scope.success = "Course Added Successfully";
        	$http.get('partials/get/get_courses.php').success(function(data){
				$scope.courses = data;
			});
			// $scope.classInsert.$setPristine();
			$scope.newCourse = {};
			$scope.showCourse = false;
        })
        .error(function(data, status, headers, config)
        {
        	$scope.error = 'There was a ' + status + ' error!'
            console.log('error');
        });
	};
	
	$scope.showUpdate = false;
	
	$scope.toggleUpdate = function(){
		if($scope.showCourse){
			$scope.showUpdate = false;
		}
		else{
			$scope.showUpdate = !$scope.showUpdate;
		}
	};
	
	$scope.updateCourse = function(){
		$http.post('partials/courses/update_course.php', $scope.courseUpdate)
		.success(function(data){
			//console.log(data);
			$scope.showUpdate = false;
		});
	};
	
}]);