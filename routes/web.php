<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::group(['namespace'=>'Customer'], function(){
    Route::get('trangchu','ProductController@index'); //TRang chủ

    Route::get('getproductbycatid/{idProduct}', 'ProductController@getproductbycatid'); //hiển thị các sản phẩm theo menu
    Route::get('getproductOffer','ProductController@getproductOffer');

    Route::get('getPopularSellingProducts','ProductController@getPopularSellingProducts');

    Route::get('cart','ProductController@getCart'); // giỏ hàng

    Route::post('addCart','CartController@addCart'); // post thêm giỏ hàng

    Route::post('updateCart','CartController@updateCart'); //post Cập nhât giỏ hàng

    Route::get('detail&id={id}', 'ProductController@getOne'); // chi tiết của 1 sản phẩm

    Route::get('signin','customerController@form_signin')->middleware('checkUser'); // đăng Nhập form

    Route::post('post-signin','customerController@signin'); // post đăng nhập

    Route::get('logout','customerController@logout'); // đăng xuất tải khoản

    Route::get('signup','customerController@form_signup')->middleware('checkUser'); // Đăng ký tài khoản form

    Route::post('post-signup','customerController@signup'); // post đăng ký

    Route::get('updateInfor-form','customerController@formUpdateInfor'); // cập nhật thông tin user form

    Route::post('update_infor', 'customerController@updateInfor'); // post cập nhật thông tin user

    Route::get('search', 'ProductController@searchProduct'); // tìm kiếm sản phẩm

    Route::post('dathang', 'ProductController@dathang'); //đặt hàng

    Route::get('change-password','customerController@form_changePass'); // form thay đổi mật khẩu

    Route::post('post-change-password', 'customerController@changePassword');

    Route::get('forget-password','customerController@form_forget_password');// form quên m khẩu

    Route::get('form-email', function () {
        return view('customer.form');
    });
    Route::post('/message/send', 'customerController@addFeedback');

    Route::get('reset-password', 'customerController@formReset')->name('get.link.reset.password');

    Route::post('post-reset-password','customerController@saveResetPassword');

    Route::post('getProductSort','ProductController@getProductSort');

    Route::post('getProductLatest','ProductController@getProductLatest');

    Route::get('order-products','ProductController@orderProducts');

});

Route::group(['namespace'=>'Admin'],function(){
    Route::get('admin','AdminController@index')->middleware('checkSigninEmployee','CheckLevelEmployee');// Trang quản trị admin

    Route::get('employee','AdminController@index')->middleware('checkSigninEmployee','CheckLevelEmployee');

    Route::get('shipper','ShipperController@index')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('signinAdminForm','AdminController@form_signin')->middleware('checkUserEmployee');//trang đăng nhập

    Route::post('signinAdmin','AdminController@signinAdmin');// post trang đăng nhập

    Route::get('logoutAdmin','AdminController@logoutAdmin');//Đăng xuất admin

    Route::get('product-management','ProductManagementController@viewProduct')->middleware('checkSigninEmployee','CheckLevelEmployee');//Hiển thị các sản phẩm qản lý

    Route::get('addProduct','ProductManagementController@formAddProduct')->middleware('checkSigninEmployee','CheckLevelEmployee');//Form thêm sản phẩm

    Route::post('getCategory','ProductManagementController@getCategoryAjax')->middleware('checkSigninEmployee','CheckLevelEmployee');//Lấy menu hiển thi ra trang thêm sản phẩm

    Route::post('addProduct', 'ProductManagementController@AddProduct')->middleware('checkSigninEmployee','CheckLevelEmployee');// post Thêm sản phẩm

    Route::get('repair&id={id}', 'ProductManagementController@form_repair')->middleware('checkSigninEmployee','CheckLevelEmployee'); // sua thong tin sản phẩm

    Route::post('repairProduct', 'ProductManagementController@repairProduct')->middleware('checkSigninEmployee','CheckLevelEmployee');// post sửa sản phẩm

    Route::get('orderProcessing','ProductManagementController@orderProcessing')->middleware('checkSigninEmployee','CheckLevelEmployee');//quan ly don hang

    Route::get('orderdetail&orderId={orderId}','ProductManagementController@orderdetail')->middleware('checkSigninEmployee','CheckLevelEmployee');//xem chi tiet don hang

    Route::post('orderConfirmation','ProductManagementController@orderConfirmation')->middleware('checkSigninEmployee','CheckLevelEmployee');//Xac nhan don hang

    Route::post('getOrderLoadMore', 'ProductManagementController@getOrderLoadMore')->middleware('checkSigninEmployee','CheckLevelEmployee');//get Order LoadMore

    Route::post('getOrderLoadMoreShipper', 'ShipperController@getOrderLoadMoreShipper')->middleware('checkSigninEmployee','CheckLevelShipper');//get Order LoadMore Shipper

    Route::get('reserve&orderId={orderId}', 'ShipperController@reserve')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('received-delivery', 'ShipperController@receivedDelivery')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('complete&orderId={orderId}', 'ShipperController@completeOrder')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('completeReserve','ShipperController@completeReserve')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('Admin-account-management','AdminController@AdminAccountManagement')->middleware('checkSigninEmployee','CheckLevelAdmin');// hien thi acc employee

    Route::get('createAccAdmin', 'AdminController@createAccAdmin')->middleware('checkSigninEmployee','CheckLevelAdmin');//form them tai khoan employee

    Route::post('createAccAdmin','AdminController@AddAccAdmin')->middleware('checkSigninEmployee','CheckLevelAdmin');//post them tai khoan employee

    Route::post('deleteAcc', 'AdminController@deleteAcc')->middleware('checkSigninEmployee','CheckLevelAdmin');//Xoa acc employee

    Route::post('orderCancel', 'ProductManagementController@orderCancel')->middleware('checkSigninEmployee','CheckLevelAdmin');//Xoa acc employee

    Route::get('menu-manager','AdminController@showMenuManager' )->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::get('repairMenu&id={id}','AdminController@formRepairMenu')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::post('repair-Menu','AdminController@repairMenu')->middleware('checkSigninEmployee','CheckLevelAdmin');
});
