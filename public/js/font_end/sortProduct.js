$(document).ready(function () {

    $('#sapxep').trigger('change');
    $('#sapxep').change(function () {
        var deptid = $(this).val();
        if($(this).data('memu')){
            var menuid = $(this).data('memu');
        }
        else{
            var search = $(this).data('search');
        }

        $.ajax({
            url: '/getProductSort',
            type: 'POST',
            data: {depart:deptid, menuid:menuid, search:search},
            dataType: 'json',
            success:function(sort) {
                $(".item1").remove();
                var len = sort.length;

                $("#broad").empty();
                for( var i = 0; i<len; i++) {
                    var productName = sort[i]['productName'];
                    var id = sort[i]['id'];
                    var image = sort[i]['image'];
                    var unitPrice = sort[i]['unitPrice'];
                    const formatter = new Intl.NumberFormat('en', {
                        notation: 'standard', // This is the implied default.
                    });

                    $("#broad").append("<div class=\"item1\">\n" +
                        "\t\t\t\t        <div class=\"col-xs-12 col-sm-6 col-md-2 hang\">\n" +
                        "\t\t\t\t        <a href=\"/detail&id=" + id + " \" class=\"chitiet\">\n" +
                        "\t\t\t\t        \t<img src=\"http://127.0.0.1:8000/img/"+ image +"\" class=\"img-responsive center-block\">\n" +
                        "\n" +
                        "\t\t\t\t\t        <h4 class=\"text-center\">" + productName + "</h4>\n" +
                        "\n" +
                        "\t\t\t\t\t        <h5 class=\"text-center\" style=\"color:red;\">\n" +
                        "                                " + formatter.format(unitPrice)+" .Đ" + "\n" +
                        "                                </h5>\n" +
                        "\t\t\t\t\t        <h6 class=\"text-center\"></h6>\n" +
                        "\t\t\t\t    \t</a>\n" +
                        "\t\t\t\t        </div>\n" +
                        "\t\t\t\t    </div>");
                }
            }
        });
    });

    $('#fruit1').val(this.checked);
    $('#fruit1').change(function () {
        if($(this).data('memu')){
            var menuid = $(this).data('memu');
        }
        else{
            var search = $(this).data('search');
        }
        var check='';
        if(this.checked) {
            check=true;
        }
        else{
            check=false;
        }
            $.ajax({
                url: '/getProductLatest',
                type: 'POST',
                data: {check:check,  menuid:menuid, search:search},
                dataType: 'json',
                success:function(sort) {
                    $(".item1").remove();
                    var len = sort.length;

                    $("#broad").empty();
                    for( var i = 0; i<len; i++) {
                        var productName = sort[i]['productName'];
                        var id = sort[i]['id'];
                        var image = sort[i]['image'];
                        var unitPrice = sort[i]['unitPrice'];
                        const formatter = new Intl.NumberFormat('en', {
                            notation: 'standard', // This is the implied default.
                        });

                        $("#broad").append("<div class=\"item1\">\n" +
                            "\t\t\t\t        <div class=\"col-xs-12 col-sm-6 col-md-2 hang\">\n" +
                            "\t\t\t\t        <a href=\"/detail&id=" + id + " \" class=\"chitiet\">\n" +
                            "\t\t\t\t        \t<img src=\"http://127.0.0.1:8000/img/"+ image +"\" class=\"img-responsive center-block\">\n" +
                            "\n" +
                            "\t\t\t\t\t        <h4 class=\"text-center\">" + productName + "</h4>\n" +
                            "\n" +
                            "\t\t\t\t\t        <h5 class=\"text-center\" style=\"color:red;\">\n" +
                            "                                " + formatter.format(unitPrice)+" .Đ" + "\n" +
                            "                                </h5>\n" +
                            "\t\t\t\t\t        <h6 class=\"text-center\"></h6>\n" +
                            "\t\t\t\t    \t</a>\n" +
                            "\t\t\t\t        </div>\n" +
                            "\t\t\t\t    </div>");
                    }
                }
            });
    });
});
