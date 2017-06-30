AppControl.controller('application', function($scope, $http, $location) {
	$scope.section = '0';
	
	$scope.applicant = {};
	
	$scope.showForm = false;
	
	$scope.years = [];
	var i = 0;
	var d = new Date();
	var n = d.getFullYear();	
	for (i = 0; i < 5; i++) {
		var value = {value: n}
		$scope.years.push(value);
		n = n + 1;
	}
	// default class/year value
    $scope.applicant.grad_year = $scope.years[0].value;
	
	$scope.scores = [
	  {value:'Pass'},
      {value:'Restricted I'},
      {value:'Restricted II'}
	];
	// default score value
    $scope.applicant.ita_score = $scope.scores[0].value;

	$scope.grades = [
      {value:'A'},
      {value:'B'},
      {value:'C'},
      {value:'D'},
      {value:'F'}
    ];
    // default grade value
    $scope.grade = $scope.grades[0];
    
    $scope.positions = [
      {title:'Grader'},
      {title:'TA'},
      {title:'Lab Assistant'},
      {title:'Other'}
    ];
    // default position title
    $scope.position = $scope.positions[0];
	
	//prior stats courses 
	$scope.priorStats = [];
	//non-stats courses 
	$scope.nonStats = [];
	//third form for prior employment
	$scope.employment = [];	
	
	$scope.errors = [];
	
	$scope.addClass = function(list){
		$scope.errors = [];
		$scope.validateCourse($scope.classNum, $scope.instructor, $scope.errors);
		if ($scope.errors.length === 0) {

			newClass = {
				class: $scope.classNum, 
				grade: $scope.grade.value, 
				instructor: $scope.instructor,
				comment: $scope.comment
			};
		
			list.push(newClass);
			$scope.classNum = '';
			$scope.grade = $scope.grades[0];
			$scope.instructor = '';
			$scope.comment = '';
		}
	};

	$scope.validateSection2 = function(){
		$scope.section='2';
	};

	$scope.validateCourse = function(course, instructor, errors){
		if (!course) {
			errors.push('Please include a course number.');
		} if (!instructor) {
			errors.push('Please include a course instructor.');
		}
	};
	
	$scope.addEmployment = function(list){
		$scope.priorErrors = [];
		$scope.validateCourse($scope.priorClassNum, $scope.priorInstructor, $scope.priorErrors);
		if ($scope.errors.length === 0) {
			job = {
				class: $scope.priorClassNum, 
				position: $scope.position.title, 
				instructor: $scope.priorInstructor, 
				responsibilities: $scope.responsibilities
			};
			$scope.employment.push(job);
			$scope.priorClassNum = '';
			$scope.position = $scope.positions[0];
			$scope.priorInstructor = '';
			$scope.responsibilities = '';
		}
	};
	
	$scope.submitForm = function(){
		var appID = 0;
		$http.post('partials/hiring/add_app.php', $scope.applicant)
			.success(function(data, status, headers, config) {
				$scope.hiringApp.$setPristine();
				$scope.applicant = {};
				$scope.section = '6';
				appID = data;
				var courses = {
					appID: data,
					nonstats: $scope.nonStats,
					priorstats: $scope.priorStats,
					priorgrading: $scope.employment	
				};
				
				$http.post('partials/hiring/add_non-stats.php', courses)
					.success(function(data, status, headers, config) {
						console.log(courses);
						console.log(data);
     	   			}).error(function(data, status, headers, config) {
            			console.log('error');
					});
     	   }).error(function(data, status, headers, config) {
            	console.log('error');
		});
	};
		
});