(function($){
    $(document).ready(function(){
        $(document).on('click','#btnLoad2', function(){
            var lastid = $(this).data('id');
            $('#btnLoad2').html('Đang tải...');
            $.ajax({
                url:"/getOrderLoadMore",
                method:"POST",
                data:{
                    lastid:lastid,
                },
                dataType:"text",
                success:function(data){
                    if (data != '') {
                        $("#btnLoadMore").remove();
                        $(".thongTinOrder").append(data);
                    }
                    else{
                         $("#btnLoadMore").remove();
                         $(".thongTinOrder").append('');
                    }
                }
            });
        });
    });
})(jQuery);

