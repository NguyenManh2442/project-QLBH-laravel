function addCart(id) {
  num = $("#sl").val();
  sizes = document.getElementsByName('size');
  var size = "";
  for (var i = 0; i < sizes.length; i++) {
    if (sizes[i].checked) {
      size = sizes[i].value;
      break;
    }
  }
  $.post('http://127.0.0.1:8000/addCart', { 'id': id, 'num': num, 'size': size }, function (data) {
    $("#numberCart").text(data);
    $('#showCart').modal();
    toastr.success('Đặt hàng thành công', 'Success', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });
  });

}
function updateCart(id) {
  num = $("#quantity_" + id).val();
  size = $("#size_id_" + id).text();
  $.post('http://127.0.0.1:8000/updateCart', { 'id': id, 'num': num, 'size': size }, function (data) {
    $("#listCart" + id).load("http://127.0.0.1:8000/cart #cartx" + id);
    $("#detail-amt").load("http://127.0.0.1:8000/cart #total");
    $("#count").load("http://127.0.0.1:8000/cart #count-unit-price");
    $("#list-product").load("http://127.0.0.1:8000/cart #list");
  });
}

function deleteCart(id) {
  num = $("#quantity_" + id).val();
  $.post('http://127.0.0.1:8000/updateCart', { 'id': id, 'num': 0, 'size': 0 }, function (data) {

    $("#listCart").load("http://127.0.0.1:8000/cart #cartx");
  });
}

function updateAddress(id) {
  $.ajax({
    url: "/editAddress",
    method: "POST",
    data: {
      id: id,
    },
    dataType: "text",
    success: function (data) {
      var obj = JSON.parse(data);

      const body = $("#info_address_" + id)
      var template = `<div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <label for="checkout-name">Họ và
                                          tên:</label>
                                      <input type="text" id="checkout-name"
                                          class="form-control required"
                                          name="name" value="`+ obj.name + `">
                                  </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <label for="checkout-number">Số điện
                                          thoại:</label>
                                      <input type="number" id="checkout-number"
                                          class="form-control required" name="phone" value="`+ obj.phone_number + `">
                                  </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <label for="checkout">Xã, Phường:</label>
                                      <input type="text" id="checkout"
                                          class="form-control required" name="wards" value="`+ obj.wards + `">
                                  </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <label for="checkout-city">Quận, Huyện:</label>
                                      <input type="text" id="checkout-city"
                                          class="form-control required"
                                          name="district" value="`+ obj.district + `">
                                  </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <label for="checkout-state">Tỉnh, Thành
                                          phố:</label>
                                      <input type="text" id="checkout-state"
                                          class="form-control required"
                                          name="province" value="`+ obj.province + `">
                                  </div>
                              </div>
                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group">
                                      <label for="add-type">Địa chỉ chi tiết:</label>
                                      <textarea
                                          class="form-control required"
                                          name="detailed_address" id="basicTextarea"
                                          rows="1">`+ obj.detailed_address + `</textarea>
                                  </div>
                              </div>
                          </div>
                          `;
      body.html(template)
    }
  });
}




$(document).ready(function () {

  $('input:radio[name="address"]').change(
    function () {
      if (this.checked) {
        $.ajax({
          url: "/storeAddressSession",
          method: "POST",
          data: {
            id: this.value,
          },
          dataType: "text",
          success: function (data) {
            console.log(data);
          }
        });
        var name = $('#data-'+this.value).find('[target="name"]').text()
        var phone = $('#data-'+this.value).find('[target="phone"]').text();
        var address = $('#data-'+this.value).find('[target="detailed-address"]').text();

        $('#confirm-name').find('[target="name"]').text("Tên: "+name);
        $('#confirm-address').find('[target="phone"]').text("Số điện thoại: "+phone);
        $('#confirm-address').find('[target="address"]').text("Địa chỉ: "+address);

        $('.detail').find('[target="name"]').text(name);
        $('.detail').find('[target="phone"]').text(phone);
        $('.detail').find('[target="address"]').text(address);
      }
    });

  // submit form
  $('form').submit(function (event) {
    $.ajax({
      method: $(this).attr('method'),
      url: $(this).attr('action'),
      data: $(this).serialize(),
    }).done(function (response) {

      $('#data-'+response.id).find('[target="name"]').text(response.name);
      $('#data-'+response.id).find('[target="phone"]').text(response.phone_number);
      $('#data-'+response.id).find('[target="detailed-address"]').text(response.detailed_address + " - " + response.wards + " - " + response.district + " - " + response.province);
      
      toastr.success('Update thành công', 'Success', { positionClass: 'toast-top-center', containerId: 'toast-top-center' });

      $('#editForm' + response.id).modal('toggle');
    });
    event.preventDefault(); // <- avoid reloading
  });

  $("#order").click(function() {
    $.ajax({
      url: "/postOrderProduct",
      method: "POST",
      dataType: "text",
      success: function (data) {
        var obj = JSON.parse(data);
        if (obj.status == "true")
        {
          toastr.success("Order thành công");
        } else {
          toastr.console.error("Order khong công");
        }
        window.location.href = '/'
      }
    });
  });

  $("#voucher").keyup(function(){
    voucher = $("#voucher").val();
    $.ajax({
      url: "/checkVoucher",
      method: "POST",
      data: {
        voucher: voucher,
      },
      dataType: "text",
      success: function (data) {
        var obj = JSON.parse(data);
        if (obj.status == "true")
        {
          $("#voucher").removeClass("is-invalid");
          $("#voucher").addClass("is-valid");
          $('#ts').find('[target="total"]').text(obj.count_discount + ' Đ');
        } else {
          $("#voucher").removeClass("is-valid");
          $("#voucher").addClass("is-invalid");
          $('#ts').find('[target="total"]').text(obj.count_discount + ' Đ');
        }
      }
    });
  });

  $("#confirm").click(function(){
    voucher = $("#voucher").val();
    $.ajax({
      url: "/confirmVoucher",
      method: "POST",
      data: {
        voucher: voucher,
      },
      dataType: "text",
      success: function (data) {
        $("#count").load("http://127.0.0.1:8000/cart #count-unit-price");
        $("#list-product").load("http://127.0.0.1:8000/cart #list");
      }
    });
  });
});
