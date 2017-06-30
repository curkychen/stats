var App = angular.module('App', []);

App.controller('application', function($scope, $http){

	var formData = {
		firstName: "default",
		lastName: "default",
		andrewId: "default",
		address: "default",
		phone: "default",
		grad: "default",
		ssn: "default",
		lang: "default",
		ita: "default",
		score: "default",
		major1: "default",
		major2: "default",
		minor: "default",
		advisor: "default",
/*		
		statCourse: "default",
		statGrade: "default",
		statInstructor: "default",
		statComments: "default",
		nonStatCourse: "default",
		nonStatGrade: "default",
		nonStatInstructor: "default",
		nonStatComments: "default",
		jobCourse: "default",
		jobRole: "default",
		jobInstructor: "default",
		jobDuties: "default",
	*/	
		preferred: "default",
		experience: "default",
		reference: "default"	
	};
	
	$scope.apply = function(){
		$http({
		url: "apply.php", 
		data: $scope.ta ,
		method: 'POST',
		headers: {'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'}
		}).
		success(function(data, location){ 
			console.log("OK", data),	
			$window.location.href = "https://www.stat.cmu.edu/~zgreen/SIS/partials/hiring/thankyou.html"
		}).
		error(function(err){"ERR", console.log(err)})
	};
});

App.controller('statsCourses', function($scope){
	$scope.statsCourses = [];
	$scope.addStatsCourse = function(){
		$scope.statsCourses.push({ data: ''});
	};
	$scope.removeStatsCourse = function(index){
		$scope.statsCourses.splice(index, 1);
	};
});

App.controller('nonStatsCourses', function($scope){
	$scope.nonStatsCourses = [];
	$scope.addNonStatsCourse = function(){
		$scope.nonStatsCourses.push({ data: ''});
	};
	$scope.removeNonStatsCourse = function(index){
		$scope.nonStatsCourses.splice(index, 1);
	};	
});

App.controller('employment', function($scope){
	$scope.employment = [];
	$scope.addJob = function(){
		$scope.employment.push({ data: ''});
	};
	$scope.removeJob = function(index){	
		$scope.employment.splice(index, 1);
	};
});
	