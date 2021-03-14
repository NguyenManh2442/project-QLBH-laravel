$(document).ready(function () {
    // $.ajax({
    //             url: '/getCategory',
    //             type: 'POST',
    //             data: {depart:$('#menucha').val()},
    //             dataType: 'json',
    //             success:function(response){
    
    //                 var len = response.length;
    
    //                 $("#menucon").empty();
    //                 for( var i = 0; i<len; i++){
    //                     var categoryID = response[i]['category_id'];
    //                     var categoryName = response[i]['category_name'];
    
    //                     $("#menucon").append("<option value='"+categoryID+"'>"+categoryName+"</option>");
    
    //                 }
    //             }
    //         });
    $('#menucha').trigger('change');
    $('#menucha').change(function () {
        var deptid = $(this).val();

        $.ajax({
            url: '/getCategory',
            type: 'POST',
            data: {depart:deptid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#menucon").empty();
                for( var i = 0; i<len; i++){
                    var categoryID = response[i]['category_id'];
                    var categoryName = response[i]['category_name'];

                    $("#menucon").append("<option value='"+categoryID+"'>"+categoryName+"</option>");

                }
            }
        });
    });
});
