AppControl.controller('evaluations', ['$scope', '$http', function($scope, $http){
	
	$http.post('partials/get/get_applications.php').success(function(data){
		$scope.apps = data;
	})
	console.log("evaluations!");
			
}]);