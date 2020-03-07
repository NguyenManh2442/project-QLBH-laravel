(function($){
    $(document).ready(function(){
        $(document).on('click','#btnLoad1', function(){
            var lastid = $(this).data('id');
            $('#btnLoad1').html('Đang tải...');
            $.ajax({
                url:"/getOrderLoadMoreShipper",
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

