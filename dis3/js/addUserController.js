AppControl.controller('addUser', ['$scope', '$http', '$location', '$window', function($scope, $http, $location, $window){
	$scope.section = '0';
	$scope.user = {};
	
	//$window.location.href = 'http://www.stat.cmu.edu/~zgreen/DIS/login.html';
	
	$scope.positions = [
		{value: 'recommender'},
		{value: 'visiting faculty'},
		{value: 'summer student'}
	];
	
	$scope.user.position = $scope.positions[0].value;
	
	$scope.validateSection1 = function(){
		$scope.section = '1';
		
	}
	
	$scope.andrewID = function(){
		console.log('you have an andrew id!');	
		$http.post('partials/authentication/andrew.html').success(function(data, status, headers, config)
		{
			console.log(data);
			//$window.location.href = 'www.stat.cmu.edu/~zgreen/DIS/andrew.html;
		});
	
	}
	
	$scope.disLogin = function(){
		//console.log('you appear to be trying to log in');
		$http.post('partials/authentication/database_check.php', $scope.dis)
			.success(function(data, status, headers, config)
			{
				if(data.msg != ''){
					
					//console.log(data);
					$scope.success = "congrats on logging in successfully";
					$window.location.href = 'www.stat.cmu.edu/~zgreen/DIS/#home'; 
				}
				else if(data.error == 'Wrong Password!'){
					$scope.error = 'Wrong Password!';
					//console.log(data);
				}
				else if(data.error == 'andrew login'){
					$scope.error = 'Please login with your andrew ID';
					//console.log(data);
				}
				else{
					$scope.error = 'User not recognized!';
					//console.log(data);
					
				}
		})
		.error(function(data, status)
		{
			console.log(error);
			$scope.error = 'no login for you';
		});
	}
	
	/* this is related to ng-file-upload */
	$scope.$watch('files', function () {
        $scope.upload($scope.files);
    });
    
	$scope.upload = function (files) {
        	if (files && files.length) {
			for (var i = 0; i < files.length; i++) {
				var file = files[i];
				Upload.upload({
					url: 'http://www.stat.cmu.edu/DIS/upload.php',
					fields: {
						'username': $scope.username
					},
					sendFieldsAs: 'form',
					method: 'POST',
					file: file
				}).progress(function (evt) {
					var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
					$scope.log = 'progress: ' + progressPercentage + '% ' +
						evt.config.file.name + '\n' + $scope.log;
				}).success(function (data, status, headers, config) {
					$scope.log = 'file ' + config.file.name + 'uploaded. Response: ' + JSON.stringify(data) + '\n' + $scope.log;
					$scope.$apply();
				});
			}
		}
	};
	/* end ng-file-upload */

	$scope.submitForm = function(){
		/*$scope.user.image = $scope.image.dataURL;*/
		$http.post('partials/authentication/new_user.php', $scope.user).success(function(data, status, headers, config)
        {
        	if(data.msg != ''){
        		console.log(data);
      	  		$scope.success = 'User created successfully!';
				$scope.userInsert.$setPristine();
				$scope.user = {};
			}
			else if(data.error = 'user exists'){
				$scope.error = 'This user already exists! please log in with your email and password';
				console.log(data);
			}
        })
        .error(function(data, status, headers, config)
        {
        	$scope.error = 'An error occurred!'
            console.log('error');
        });
	}
}]);