var AppControl = angular.module('AppControl', ['ngRoute', 'permission', 'permission.ng', 'ui.bootstrap.datetimepicker', 'mwl.calendar', 'angular-timeline','angularFileUpload']);
					angular.module('myCalendar', ['angular-bootstrap-calendar', 'angular-ui-bootstrap']);

AppControl.controller('mainControl', function($scope, $route, $routeParams, $location){

	render = function(){
	
		// Session Variable to store user information

		var renderAction = $route.current.action;

		if (renderAction!=null){
			var renderPath = renderAction.split( "." );
			var isHome = (renderPath[ 0 ] == "home");
			var isPeople = (renderPath[ 0 ] == "people");
			var isSchedule = (renderPath[ 0 ] == "schedule");
			var isCourse = (renderPath[ 0 ] == "courses");
			var isHiring = (renderPath[ 0 ] == "hiring");
			var isIndiv = (renderPath[ 0 ] == "indiv");
			var isAddTime = (renderPath[ 0 ] == "addTime");
			var isCourseIndiv = (renderPath[ 0 ] == "courseIndiv");
			var isAddUser = (renderPath[ 0 ] == "addUser");
			var isKey = (renderPath[ 0 ] == "keys");
			var isRoom = (renderPath[ 0 ] == "rooms");
			var isApplication = (renderPath[0] == "applications");
			var isReception = (renderPath[0] == "reception");
			var isEvaluation = (renderPath[0] == "evaluations");
			var isFacultyDashboard = (renderPath[0] == "facultyDashboard");
			//additional
			var isEvaluationAdvisees=
			//end of addtional
			
			$scope.renderAction = renderAction;
			$scope.renderPath = renderPath;
			$scope.isHome = isHome;
			$scope.isPeople = isPeople;
			$scope.isSchedule = isSchedule;
			$scope.isCourse = isCourse;
			$scope.isHiring = isHiring;
			$scope.isIndiv = isIndiv;
			$scope.isAddTime = isAddTime;
			$scope.isCourseIndiv = isCourseIndiv;
			$scope.isAddUser = isAddUser;
			$scope.isKey = isKey;
			$scope.isRoom = isRoom;
			$scope.isApplication = isApplication;
			$scope.isReception = isReception;
			$scope.isEvaluation = isEvaluation;
			$scope.isFacultyDashboard = isFacultyDashboard;
		}
		
	};
	$scope.$on(
		"$routeChangeSuccess", 
		function( $currentRoute, $previousRoute ){
			render();
	});
});

// Role & Permission definitions for authorization
AppControl.run(function (PermPermissionStore, PermRoleStore) {

	//// PermPermissionStore causing undefined error for some reason
	var applicationPermissions = ['canViewOwnApps', 'canViewAllApps', 'canApproveApps'];
	angular.forEach(applicationPermissions, function(value, key) {
		PermPermissionStore.definePermission(value, function () { return true; });
	});

	PermRoleStore.defineManyRoles({
		'APP_MANAGER': ['canViewAllApps', 'canApproveApps'],
		'STUDENT' : ['canViewOwnApps'],
		'ADMIN' : ['canViewAllApps', 'canApproveApps']
	});
})
