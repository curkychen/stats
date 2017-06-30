console.log("hello");


var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

$("#sort tbody").sortable({
    helper: fixHelperModified,
    stop: updateIndex
}).disableSelection();


function remove(name){

	$.ajax({
        url: "http://www.stat.cmu.edu/reception/admin/delete.php",
        type: "post",
        dataType: 'html',
       data: {'name':name,
        	},
        success: function (response) {
                        console.log(name);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

	$( ".removeAlert" ).append( "<p>Deleted image!</p>" );
}

function removeAnnouncement(name){
$.ajax({
        url: "http://www.stat.cmu.edu/reception/admin/deleteAnnouncement.php",
        type: "post",
        dataType: 'html',
       data: {'name':name,
        	},
        success: function (response) {
                        console.log(name);

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }


    });

	$( ".removeAlert" ).append( "<p>Deleted announcement!</p>" );
}

// function check(name){
//
// var checkstatus = true;
//
//
// if (document.getElementById(name).value=="true"){
// document.getElementById(name).value = "false";
// console.log("check!");
// checkstatus = 0;
// }
//
// else {
// 	document.getElementById(name).value="true";
// 	console.log("uncheck");
// 	checkstatus = 1;
// }
//
//
//
//
//  $.ajax({
//         url: "http://www.stat.cmu.edu/reception/admin/checkactive.php",
//         type: "post",
//         dataType: 'html',
//         data: {'name':name,
//         		'checkstatus': checkstatus
//         	},
//         success: function (response) {
//                         console.log(name);
//                         console.log(checkstatus);
//
//         },
//         error: function(jqXHR, textStatus, errorThrown) {
//            console.log(textStatus, errorThrown);
//         }
//
//
//     });
//
// }

