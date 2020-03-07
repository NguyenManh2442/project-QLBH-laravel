$(document).ready(function () {
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
                    var categoryID = response[i]['categoryID'];
                    var categoryName = response[i]['categoryName'];

                    $("#menucon").append("<option value='"+categoryID+"'>"+categoryName+"</option>");

                }
            }
        });
    });
});
