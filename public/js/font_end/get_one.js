function tang(){
    var t= document.getElementById("sl").value;
    if(parseInt(t)<20){
    document.getElementById("sl").value=parseInt(t)+1;
    }
}
function giam(){
    var g =document.getElementById("sl").value;
    if(parseInt(g)>1){
        document.getElementById("sl").value=parseInt(g)-1;
    }
}
function addCart(id){
			num=$("#sl").val();
			$.post('http://127.0.0.1:8000/addCart',{'id':id,'num':num}, function(data){
    
                 $("#numberCart").text(data);

                 $('#showCart').modal();
			});

		}
function updateCart(id){
    num =$("#quantity_"+id).val();
    $.post('http://127.0.0.1:8000/updateCart',{'id':id,'num':num}, function(data){
    $("#listCart").load("http://127.0.0.1:8000/cart #cartx");
            });
}

function deleteCart(id){
     num =$("#quantity_"+id).val();
    $.post('http://127.0.0.1:8000/updateCart',{'id':id,'num':0}, function(data){

            $("#listCart").load("http://127.0.0.1:8000/cart #cartx");
            });
}

function batDangNhap(){
    $('#showDangNhap').modal();
}
