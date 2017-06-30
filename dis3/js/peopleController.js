// AppControl.controller('UserList', ['$scope', '$filter', '$route', '$location', '$routeParams', '$http', function($scope, $filter, $route, $location, $routeParams, $http){
AppControl.controller('UserList', ['$scope', '$filter', '$route', '$location', '$routeParams', '$http','FileUploader', function($scope, $filter, $route, $location, $routeParams, $http, FileUploader){
	$http.get('partials/get/get_active_users.php').success(function(data){
		$scope.users = data;
	});
	
	$http.get('partials/get/get_courses.php').success(function(data){
		$scope.courses = data;
	});

	$http.get('partials/get/get_positions.php').success(function(data){
		$scope.positions = data;
	});
	
	$http.get('partials/get/get_relationships.php').success(function(data){
		$scope.relationships = data;
	});
	
	$scope.newPerson = {};
		
	$scope.selectUser = function(select){
		$scope.selectedUser = select.id;
		$scope.loadUser();	
	}
	
	$scope.loadUser = function(){
		
		$http.get('partials/get/get_user_indiv.php/' + $scope.selectedUser)
			.success(function(data){
				$scope.indiv = data;
				// Classes the user has a role in (e.g. TA)
				$scope.classes = data.classes;
				// Classes the user was the instructor for
				$scope.classesTaught = data.classesTaught;
				$scope.positionList = data.positionList;
				$scope.relationshipList = data.relationshipList;
				$scope.keyList = data.keyList;
				$scope.image_src = data.image_src;
				console.log(data);
				console.log($scope.indiv);


				/* Angular-timeline */
				$scope.events = [];

				// Create a combined array of positions, classes where the user has roles, and classes taught
				var positionsAndClasses = []; 
				if(data.positionList) {
					positionsAndClasses = positionsAndClasses.concat(data.positionList);
				}
				if(data.classes) {
					positionsAndClasses = positionsAndClasses.concat(data.classes);
				}
				if(data.classesTaught) {
					positionsAndClasses = positionsAndClasses.concat(data.classesTaught);
				}

				// Sort the combined array of positions and classes by descending start date
				positionsAndClasses.sort(function(a, b){return b.startDate > a.startDate});

				for(x in positionsAndClasses) {
					// The current item is a position so add a position to the timeline
					if(positionsAndClasses[x].position){
						$scope.events.push({
							badgeClass: 'info',
							badgeIconClass: 'glyphicon-education',
							title: positionsAndClasses[x].position,
							content: $filter('date')(positionsAndClasses[x].startDate, "MMMM d, yyyy") + " - " + $filter('date')(positionsAndClasses[x].endDate, "MMMM d, yyyy")
						});
					// The current item is a class so add a class to the timeline
					} else {
						// Class they had a role in
						if(positionsAndClasses[x].role) {
							$scope.events.push({
								badgeClass: 'warning',
								badgeIconClass: 'glyphicon-pencil',
								title: positionsAndClasses[x].courseNumber + " " + positionsAndClasses[x].courseName + " (" + positionsAndClasses[x].role + ")",
								content: $filter('date')(positionsAndClasses[x].startDate, "MMMM d, yyyy") + " - " + $filter('date')(positionsAndClasses[x].endDate, "MMMM d, yyyy")
							});
						// Class they taught
						} else {
							$scope.events.push({
								badgeClass: 'warning',
								badgeIconClass: 'glyphicon-pencil',
								title: positionsAndClasses[x].courseNumber + " " + positionsAndClasses[x].courseName + " (Instructor)",
								content: $filter('date')(positionsAndClasses[x].startDate, "MMMM d, yyyy") + " - " + $filter('date')(positionsAndClasses[x].endDate, "MMMM d, yyyy")
							});
						}
					}
				}
				/* end Angular-timeline */
		});	
	}
	
	$scope.addPos = false;
	
	$scope.showAdd = function(){
		if($scope.deletePos){
			$scope.addPos = false;
		}
		else{
			$scope.addPos = !$scope.addPos;
		}
	}

	$scope.addPosition = function(){
		$http.post('partials/people/add_position.php/' + $scope.selectedUser, $scope.np)
		.success(function(data){
			$scope.np = {};
			console.log(data);
			$http.get('partials/get/get_user_indiv.php/' + $scope.selectedUser)
			.success(function(data){
				$scope.indiv = data;
				$scope.classes = data.classes;
				$scope.positionList = data.positionList;
			});
		});
	}
				
	$scope.deletePos = false;
	
	$scope.showDelete = function(){
		if($scope.addPos){
			$scope.deletePos= false;
		}
		else{
			$scope.deletePos = !$scope.deletePos;
		}
	};
	
	$scope.deletePosition = function(){
		$http.post('partials/people/delete_position.php/' + $scope.selectedUser, $scope.deletedPosition)
		.success(function(data){
			//console.log(data);
			$http.get('partials/get/get_user_indiv.php/' + $scope.selectedUser)	
			.success(function(data){
				$scope.indiv = data;
				$scope.classes = data.classes;
				$scope.positionList = data.positionList;
			});
		});
	};
	
	$scope.addRel = false;
	
	$scope.showAddRel = function(){
		if($scope.deleteRel){
			$scope.addRel = false;
		}
		else{
			$scope.addRel = !$scope.addRel;
		}
	}

	$scope.addRelation = function(){
		$http.post('partials/people/add_relationship.php/' + $scope.selectedUser, $scope.nr)
		.success(function(data){
			$scope.nr = {};
			console.log(data);
			$http.get('partials/get/get_user_indiv.php/' + $scope.selectedUser)
			.success(function(data){
				$scope.indiv = data;
				$scope.classes = data.classes;
				$scope.relationshipList = data.relationshipList;
			});
		});
	}
				
	$scope.deleteRel = false;
	
	$scope.showDeleteRel = function(){
		if($scope.addRel){
			$scope.deleteRel= false;
		}
		else{
			$scope.deleteRel = !$scope.deleteRel;
		}
	};
	
	$scope.deleteRelation = function(){
		$http.post('partials/people/delete_relationship.php/' + $scope.selectedUser, $scope.dr)
		.success(function(data){
			//console.log(data);
			$http.get('partials/get/get_user_indiv.php/' + $scope.selectedUser)	
			.success(function(data){
				$scope.indiv = data;
				$scope.classes = data.classes;
				$scope.positionList = data.positionList;
				$scope.relationshipList = data.relationshipList;
			});
		});
	};

	$scope.viewInactiveUsers = function(){
		$http.get('partials/get/get_inactive_users.php').success(function(data){
			$scope.users = data;
		});
	};

	$scope.viewActiveUsers = function(){
		$http.get('partials/get/get_active_users.php').success(function(data){
			$scope.users = data;
		});
	};

	$scope.viewProfessors = function(){
		$http.get('partials/get/get_professors.php').success(function(data){
			$scope.users = data;
		});
	};

	$scope.viewStudents = function(){
		$http.get('partials/get/get_students.php').success(function(data){
			$scope.users = data;
		});
	};
	
	$scope.deactivate = function(){
		$http.post('partials/people/deactivate.php/' . $scope.selectedUser)
		.success(function(data){
			$http.get('partials/get/get_active_users.php')
			.success(function(data){
				$scope.users = data;
			});
		});
	};

	$scope.showPerson = false;

	$scope.toggleAddPerson = function(){
		$scope.showPerson = !$scope.showPerson;
	};


	//begin additional code

    var uploader2 = $scope.uploader2 = new FileUploader({
        //url: 'uploadPeopleImage.php',
		url:'partials/people/add_user_with_image.php',
        // queueLimit: 1,
        // formData: [{$scope.newPerson.andrewID}],
        removeAfterUpload: true
    });

    // uploader2.formData.push();

    uploader2.filters.push({
        name: 'imageFilter',
        fn: function(item /*{File|FileLikeObject}*/, options) {
            var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
            return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
        }
        });

    uploader2.onAfterAddingFile = function(fileItem) {
        uploader2.queue.length !== 1 && uploader2.queue.shift();
    };


	//end of additional code

	$scope.addPerson = function(){
		var uploadFile = document.getElementById("picture");
		// $scope.newPerson.pic = uploadFile.value;
        $scope.newPerson.pic = uploadFile.files[0].name;
		console.log($scope.newPerson);
		$http.post('partials/people/add_user.php', $scope.newPerson)
		//$http.post('partials/people/add_user_with_image.php', $scope.newPerson)
        .success(function(data, status, headers, config)
        {
        	$scope.success = "Person Added Successfully";
        	$http.get('partials/get/get_active_users.php').success(function(data){
				$scope.users = data;
			});
			console.log(data)
			$scope.newPerson = {};
			$scope.showPerson = false;
        })
        .error(function(data, status, headers, config)
        {
        	$scope.error = 'There was a ' + status + ' error!'
            console.log('error');
        });
	};
}]);
