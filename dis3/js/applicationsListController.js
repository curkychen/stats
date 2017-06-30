AppControl.controller('apps', ['$scope', '$http', function($scope, $http){
	$http.post('partials/get/get_applications.php').success(function(data){
		$scope.apps = data;
	})
	$scope.showStatusChange = false;
	
	$scope.toggleStatusChange = function(){	
		$scope.showStatusChange = !$scope.showStatusChange;
	}
	
	$scope.selectApp = function(app){
		$scope.selectedApp = app.id;
		//console.log(app.id);
		$scope.loadApp();
	}
	
	$scope.loadApp = function(){
		$http.get('partials/get/get_app_indiv.php/' + $scope.selectedApp)
		.success(function(data){
			//console.log(data);
			$scope.appIndiv = data;
			console.log($scope.appIndiv);
		});
		
		$scope.updateStatus = function(){
			$http.post('partials/applications/application_status_change.php/' + $scope.selectedApp, $scope.statusChange)
			.success(function(data){
				console.log($scope.statusChange);
				console.log($scope.selectedApp);
				//$scope.messages = "key added successfully!";
				$scope.statusChange = {};
				$scope.showStatusChange = false;
			
				$http.get('partials/get/get_app_indiv.php/' + $scope.selectedApp).success(function(data){
					$scope.appIndiv = data;
				});
			});
		}
	}
}]);