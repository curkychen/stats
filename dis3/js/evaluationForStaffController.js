/**
 * Created by general on 6/27/17.
 */
AppControl.controller('evaluationsStaff', ['$scope', '$http', function($scope, $http){

    $http.get('partials/get/get_active_users.php').success(function(data){
        $scope.users = data;
    });

    $scope.evaluateAdvisees = function () {
        $http.get('partials/get/evaluation/get_advisees').success(function(data){
            $scope.users = data;
        });
    }

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
}]);

// AppControl.directive("commentOnAdvisees",function () {
//    return {
//        restrict:'AECM',
//        // templateUrl:'./partials/evaluations/CommentOnAdvisees.html',
//        templateUrl:'/partials/evaluations/CommentOnAdvisees.html',
//        replace:true
//    }
// });