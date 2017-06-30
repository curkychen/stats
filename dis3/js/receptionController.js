
AppControl.controller('reception', ['$scope', '$http', function($scope, $http){
	$http.get('partials/get/get_reception.php').success(function(data){
		$scope.receptionList = data;
		$scope.receptionList.sort(function (a,b) {
            return a.position - b.position;
        });
	});

	$http.get('partials/get/get_reception_inactive.php').success(function(data){
		$scope.receptionInactiveList = data;
		$scope.receptionInactiveList.sort(function (a,b) {
            return a.position - b.position;
        });
	});
	//removes image from the database
	$scope.remove = function(name){
		$.ajax({
        url: 'partials/reception/delete.php',
        type: "POST",
       	data: {'name':name
        	},
        success: function (response, xhr) {
        	location.reload(true);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    	});
	}

	$scope.check = function(name) {
        var checkstatus = document.getElementById(name).value;
        if (checkstatus=="true"){
            document.getElementById(name).value = "false";
            console.log("check!");
            checkstatus = false;
        }

        else {
            document.getElementById(name).value="true";
            console.log("uncheck");
            checkstatus = true;
        }
        console.log(checkstatus);
        if (checkstatus === false) {

            $.ajax({
                url: 'partials/reception/deleteFromCheckedList.php',
                type: "POST",
                data: {
                    'name': name
                },
                success: function (response, xhr) {
                    location.reload(true);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        } else {
            $.ajax({
                url: 'partials/reception/AddInCheckedList.php',
                type: "POST",
                data: {
                    'name': name
                },
                success: function (response, xhr) {
                	location.reload(true);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
            console.log(name);
		}
    }

}])
    .directive('dragCustomer', function() {
        console.log("Hello");
        var fixHelperModified = function(e, tr) {
                var $originals = tr.children();
                var $helper = tr.clone();
                $helper.children().each(function(index) {
                    $(this).width($originals.eq(index).width())
                });
                return $helper;
            },
            updateIndex = function(e, ui) {
                $('td.position', ui.item.parent()).each(function (i) {
                    var name = $(this).attr('value');
                    console.log(name);
                    console.log(i);
                    $.ajax({
                        url:'partials/reception/dragInActive.php',
                        type:"POST",
                        data:{
                          'name':name,
                            'position':i

                        },
                        success: function (response) {
                            console.log(name);
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            console.log(textStatus, errorThrown);
                        }
                    });
                    $(this).html(i);
                });
            };

        $("#sort tbody").sortable({
            helper: fixHelperModified,
            stop: updateIndex
        }).disableSelection();
});