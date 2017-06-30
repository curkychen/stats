AppControl.controller('keys', ['$scope', '$http', function($scope, $http){
	
	$http.get('partials/get/get_keys.php').success(function(data){
		$scope.keys = data;
	});
	
	$http.get('partials/get/get_active_users.php').success(function(data){
			$scope.users = data;
	});
	
	$http.get('partials/get/get_buildings.php').success(function(data){
		$scope.buildings = data;
		//$scope.selectedBuilding = data[0];
	});
	
	$http.get('partials/get/get_active_rooms.php').success(function(data){
		$scope.rooms = data;
	});
	
	$scope.addRoom = function(){
		
	}
	
	$scope.selectKey = function(key){
		$scope.selectedKey = key.keyNumber;
		$scope.loadKey();
	}
	
	$scope.loadKey = function(){
		$http.get('partials/get/get_key_indiv.php/' + $scope.selectedKey)
		.success(function(data){
			//console.log(data);
			$scope.keyIndiv = data;
			$scope.keyOwners = data.keyOwners;
			$scope.roomList = data.roomList;
			
		});
	}
	
	$scope.showCheckIn = false;
	
	$scope.toggleCheckIn = function(){
		if($scope.showCheckOut){
			$scope.showCheckIn = false;
		}
		else{
			$scope.showCheckIn = !$scope.showCheckIn;
		}
	}
	
	$scope.checkIn = function(){
		$http.post('partials/keys/check_in.php/' + $scope.selectedKey, $scope.checkInUser)
		.success(function(data){
			console.log(data);
			$http.get('partials/get/get_key_indiv.php/' + $scope.selectedKey)
			.success(function(data){
				$scope.keyIndiv = data;
				$scope.keyOwners = data.keyOwners;
				$scope.showCheckIn = false;
			});
		});
	}
	
	$scope.showCheckOut = false;
	
	$scope.toggleCheckOut = function(){
		if($scope.showCheckIn){
			$scope.showCheckOut = false;
		}
		else{
			$scope.showCheckOut = !$scope.showCheckOut;
		}
	}
	
	$scope.checkOut = function(){
		$http.post('partials/keys/check_out.php/' + $scope.selectedKey, $scope.checkOutUser)
		.success(function(data){
			console.log(data);
			$http.get('partials/get/get_key_indiv.php/' + $scope.selectedKey)
			.success(function(data){
				$scope.keyIndiv = data;
				$scope.keyOwners = data.keyOwners;
				$scope.showCheckOut = false;
		
			});
		});
	}
	
	$scope.showKey = false;
	
	$scope.toggleAddKey = function(){
		if($scope.showUpdate){
			$scope.showKey = false;
		}
		else{
			$scope.showKey = !$scope.showKey;
		}	
	}
	
	$scope.addKey = function(){
		$http.post('partials/keys/add_key.php', $scope.newKey)
		.success(function(data){
			//console.log(data);
			$scope.messages = "key added successfully!";
			$scope.newKey = {};
			$scope.showKey = false;
			
			$http.get('partials/get/get_keys.php').success(function(data){
				$scope.keys = data;
			});
			//$scope.addKey.$setPristine();
		});
	}
	
	$scope.showUpdate = false;
	
	$scope.toggleUpdate = function(){
		if($scope.showKey){
			$scope.showUpdate = false;
		}
		else{
			$scope.showUpdate = !$scope.showUpdate;
		}
	}
	
	$scope.updateKey = function(){
		$http.post('partials/keys/update_key.php', $scope.keyUpdate)
		.success(function(data){
			//console.log(data);
			$scope.showUpdate = false;
			
		});
	}	
}]);