AppControl.controller('roomControl', ['$scope', '$http', function($scope, $http){
	$http.get('partials/get/get_active_rooms.php').success(function(data){
		$scope.rooms = data;
	});
	
	$http.get('partials/get/get_buildings.php').success(function(data){
		$scope.buildings = data;
	});
	
	$scope.selectRoom = function(room){
		$scope.selectedRoom = room.roomID;
		//console.log(room.roomID);
		$scope.loadRoom();
	}
	
	$scope.loadRoom = function(){
		$http.get('partials/get/get_room_indiv.php/' + $scope.selectedRoom)
		.success(function(data){
			console.log(data);
			$scope.roomIndiv = data;
			$scope.keyHolders = data.keyHolders;
			
		});
	}

	$scope.showAddRoom = false;
	
	$scope.toggleAddRoom = function(){
		if($scope.showDeleteRoom){
			$scope.showAddRoom = false;
		}
		else{	
			$scope.showAddRoom = !$scope.showAddRoom;
		}
	}
	
	$scope.addNewRoom = function(){
		$http.post('partials/rooms/add_room.php', $scope.newRoom)
		.success(function(data){
			//console.log($scope.newRoom);
			//$scope.messages = "key added successfully!";
			$scope.newRoom = {};
			$scope.showAddRoom = false;
			
			$http.get('partials/get/get_rooms.php').success(function(data){
				$scope.rooms = data;
			});
		});
	}
	
	$scope.showDeleteRoom = false;
	
	$scope.toggleDeleteRoom = function(){	
		if($scope.showAddRoom){
			$scope.showDeleteRoom = false;
		}
		else{
			$scope.showDeleteRoom = !$scope.showDeleteRoom;
		}
	}
	
	$scope.removeRoom = function(){
		$http.post('partials/rooms/delete_room.php', $scope.deleteRoom)
		.success(function(data){
			console.log(data);
			$scope.showDeleteRoom = false;
			$http.get('partials/get/get_active_rooms.php').success(function(data){
				$scope.rooms = data;
			});
		});
	}

	$scope.viewInactiveRooms = function(){
		$http.get('partials/get/get_inactive_rooms.php').success(function(data){
			$scope.rooms = data;
		});
	};

	$scope.viewActiveRooms = function(){
		$http.get('partials/get/get_active_rooms.php').success(function(data){
			$scope.rooms = data;
		});
	};
		
}]);