var StatsInfo = angular.module('StatsInfo', ['ngRoute', 'AppControl'] );
'ngRoute', 'permission', 'permission.ng',

StatsInfo.config(['$routeProvider', 
	function($routeProvider){
		$routeProvider.
			when("/home", {
				action: "home.default"
			}).
			when("/people", {
				action: "people.plist"
			}).
			when("/people/:id", {
				action: "people.indiv"
			}).
			when("/courses", {
				action: "courses.clist"
			}).
			when("/schedule", {
				action: "schedule.ta"
			}).
			when("/hiring", {
				action: "hiring.app"
			}).
			when("/addTime", {
				action: "addTime.timeslot"
			}).
			when("/courses/:id", {
				action: "courses.ci"
			}).
			when("/addUser", {
				action: "addUser.newUser"
			}).
			when("/keys", {
				action: "keys.klist"
			}).
			when("/keys/:id", {
				action: "keys.ki"
			}).
			when("/rooms", {
				action: "rooms.rlist"
			}).
			when("/applications",{
				action: "applications.alist"
			}).
			when("/reception",{
				action: "reception.rlist"
			}).
			when("/rooms/:id", {
				action: "rooms.ri"
			}).
			when("/evaluations", {
				action: "evaluations.elist"
			}).
			// additional action
        	when("/evaluations/commentOnAdvisees", {
            	action: "evaluationsAdvisees.elist"
        	}).
			//end of additional action
			when("/faculty", {
				action: "faculty.flist"
			}).
			otherwise({
				redirectTo: "/home"
			});
	}
]);


	
