AppControl.controller('CalendarCtrl', function($scope, $http, $compile, $timeout) {
	
	$scope.calendarView = 'month';
	$scope.viewDate = new Date();
	$scope.viewChangeEnabled = true;
	//console.log($scope.viewDate);
	$scope.events = [];
	
	$scope.allEvents = [];
	$scope.classes = [];
	$scope.classes[0] = {label: 'Show All'};
	//$scope.selectedClass = $scope.classes[0];
	
	
	$http.get('partials/get/get_courses.php').success(function(data){
		$scope.courses =[];
		$scope.courses[0] = {courseNumber: 'Show All'};
		for(var i = 0; i < data.length; i++){
			$scope.courses[i+1] = {courseNumber: data[i].courseNumber};
		}
		$scope.selectedClass = $scope.courses[0];
	});
	
	
 	$http.get('partials/ta_schedule/events.php').success(function(data){
 		for(var i = 0; i < data.length; i++){
  			$scope.events = data;
  			
 		}
 		//console.log($scope.events);
		$scope.allEvents = $scope.events;
		$scope.classSearch($scope.allEvents);
		
 	});
 	
 	//$scope.events = $scope.allEvents;
 	//$scope.eventSources = [{events: $scope.allEvents}];
	
	//currently broken - unable to link refresh of partial to selection of class
	$scope.classSearch = function() {
		var allEvents = $scope.events;
		//console.log(allEvents);
		var selectedClass = $scope.selectedClass.courseNumber;
		//console.log(selectedClass);
		var newEvents = [];
		if (selectedClass === 'Show All') {
			newEvents = allEvents;
			//console.log(newEvents);
		} 
		else{	
			for (var i = 0; i < allEvents.length; i++) {
				if (allEvents[i].id === selectedClass) {
    				newEvents.push(allEvents[i]);
    			}
    		}
		}
		
	};
	//console.log($scope.events);
	
	$scope.isCellOpen = true;

    $scope.eventClicked = function(event) {
     
    };


    $scope.toggle = function($event, field, event) {
      $event.preventDefault();
      $event.stopPropagation();
      event[field] = !event[field];
    };	

});