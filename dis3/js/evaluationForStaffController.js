/**
 * Created by general on 6/27/17.
 */
AppControl.controller('evaluationsStaff', ['$scope', '$http', function($scope, $http){

    $http.post('partials/get/get_applications.php').success(function(data){
        $scope.apps = data;
    })
    console.log("evaluations!");

}]);

// AppControl.directive("commentOnAdvisees",function () {
//    return {
//        restrict:'AECM',
//        // templateUrl:'./partials/evaluations/CommentOnAdvisees.html',
//        templateUrl:'/partials/evaluations/CommentOnAdvisees.html',
//        replace:true
//    }
// });