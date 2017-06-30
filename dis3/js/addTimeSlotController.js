AppControl.controller('addTimeSlot', ['$scope', '$http', function($scope, $http){
	$scope.slotInsert = {};

	$http.get('partials/get/get_users.php').success(function(data){
		$scope.users = data;
		$scope.slotInsert.name = $scope.users[0].id;
	});
	
	$http.get('partials/get/get_courses.php').success(function(data){
		$scope.courses = data;
		$scope.slotInsert.course = $scope.courses[0].id;
	});
	
	$http.get('partials/get/get_ta_rooms.php').success(function(data){
		$scope.rooms = data;
		$scope.slotInsert.room = $scope.rooms[0].roomID;
	});
	
	$scope.submitForm = function(){
		$http.post('partials/add_timeslot/new_timeslot.php', $scope.slotInsert).success(function(data, status, headers, config) {
        	if(data.msg != ''){
        		$scope.success = 'Timeslot added successfully';
				$scope.addTime.$setPristine();
				$scope.slotInsert = {};
			}
			else {
        		$scope.error = 'timeslot not added, room not available';
            }
        }).error(function(data, status) {
        	$scope.error = 'error';
            console.log(data);
            console.log(status);
        });
	}
}]);