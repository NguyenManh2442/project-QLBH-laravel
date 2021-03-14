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

Route::group(['namespace'=>'Customer'], function(){
    Route::get('/','ProductController@index'); //TRang chủ

    Route::get('getproductbycatid/{idProduct}', 'ProductController@getproductbycatid'); //hiển thị các sản phẩm theo menu
    Route::get('getproductOffer','ProductController@getproductOffer');

    Route::get('getPopularSellingProducts','ProductController@getPopularSellingProducts');

    Route::get('cart','ProductController@getCart'); // giỏ hàng

    Route::post('addCart','CartController@addCart'); // post thêm giỏ hàng

    Route::post('updateCart','CartController@updateCart'); //post Cập nhât giỏ hàng

    Route::get('detail&id={id}', 'ProductController@getOne'); // chi tiết của 1 sản phẩm

    Route::post('editAddress','DeliveryAddressController@editAddress');

    Route::put('updateAddress&id={id}','DeliveryAddressController@updateAddress')->name('address.update_address');

    Route::post('storeAddressSession','DeliveryAddressController@storeAddressSession');

    Route::get('signin','customerController@form_signin')->middleware('checkUser'); // đăng Nhập form

    Route::post('post-signin','customerController@signin'); // post đăng nhập

    Route::get('logout','customerController@logout'); // đăng xuất tải khoản

    Route::get('signup','customerController@form_signup')->middleware('checkUser'); // Đăng ký tài khoản form

    Route::post('post-signup','customerController@signup'); // post đăng ký

    Route::get('updateInfor-form','customerController@formUpdateInfor'); // cập nhật thông tin user form

    Route::post('update_infor', 'customerController@updateInfor'); // post cập nhật thông tin user

    Route::get('search', 'ProductController@searchProduct'); // tìm kiếm sản phẩm

    Route::post('postOrderProduct', 'OrderController@postOrderProduct'); //đặt hàng

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

    Route::get('signinAdminForm','AdminController@formSignin')->middleware('checkUserEmployee');//trang đăng nhập

    Route::post('signinAdmin','AdminController@signinAdmin');// post trang đăng nhập

    Route::get('logoutAdmin','AdminController@logoutAdmin');//Đăng xuất admin

    Route::get('product-management','ProductManagementController@viewProduct')->name('product.management')->middleware('checkSigninEmployee','CheckLevelEmployee');//Hiển thị các sản phẩm qản lý

    Route::get('addProduct','ProductManagementController@createProduct')->middleware('checkSigninEmployee','CheckLevelEmployee');//Form thêm sản phẩm

    Route::post('getCategory','ProductManagementController@getCategoryAjax')->middleware('checkSigninEmployee','CheckLevelEmployee');//Lấy menu hiển thi ra trang thêm sản phẩm

    Route::post('addProduct', 'ProductManagementController@storeProduct')->middleware('checkSigninEmployee','CheckLevelEmployee');// post Thêm sản phẩm

    Route::get('repair&id={id}', 'ProductManagementController@editProduct')->middleware('checkSigninEmployee','CheckLevelEmployee'); // sua thong tin sản phẩm

    Route::put('repairProduct&id={id}', 'ProductManagementController@updateProduct')->name('update_product')->middleware('checkSigninEmployee','CheckLevelEmployee');// post sửa sản phẩm

    Route::delete('delete&id={id}', 'ProductManagementController@deleteProduct')->name('delete_product')->middleware('checkSigninEmployee','CheckLevelEmployee');// delete sản phẩm

    Route::get('orderManagement','OrderManagementController@orderManagement')->name('order.management')->middleware('checkSigninEmployee','CheckLevelEmployee');//quan ly don hang

    Route::get('orderdetail&id={id}','OrderManagementController@getOrderdetail')->middleware('checkSigninEmployee','CheckLevelEmployee');//xem chi tiet don hang

    Route::post('orderConfirmation','ProductManagementController@orderConfirmation')->middleware('checkSigninEmployee','CheckLevelEmployee');//Xac nhan don hang

    Route::post('getOrderLoadMore', 'ProductManagementController@getOrderLoadMore')->middleware('checkSigninEmployee','CheckLevelEmployee');//get Order LoadMore

    Route::post('getOrderLoadMoreShipper', 'ShipperController@getOrderLoadMoreShipper')->middleware('checkSigninEmployee','CheckLevelShipper');//get Order LoadMore Shipper

    Route::get('reserve&orderId={orderId}', 'ShipperController@reserve')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('received-delivery', 'ShipperController@receivedDelivery')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('complete&orderId={orderId}', 'ShipperController@completeOrder')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('completeReserve','ShipperController@completeReserve')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('admin-account-management','AdminController@adminAccountManagement')->name('admin.accountManagement')->middleware('checkSigninEmployee','CheckLevelAdmin');// hien thi acc employee

    Route::get('createAccAdmin', 'AdminController@createAccountAdmin')->middleware('checkSigninEmployee','CheckLevelAdmin');//form them tai khoan employee

    Route::post('createAccAdmin','AdminController@storeAccountAdmin')->name('store_acc_admin')->middleware('checkSigninEmployee','CheckLevelAdmin');//post them tai khoan employee

    Route::get('editAccountAdmin&id={id}', 'AdminController@editAccountAdmin')->middleware('checkSigninEmployee','CheckLevelAdmin');//form them tai khoan employee

    Route::put('updateAccAdmin&id={id}', 'AdminController@updateAccountAdmin')->name('update_acc_admin')->middleware('checkSigninEmployee','CheckLevelEmployee');

    Route::delete('deleteAccountAdmin&id={id}', 'AdminController@deleteAccountAdmin')->name('delete_acc_admin')->middleware('checkSigninEmployee','CheckLevelAdmin');//Xoa acc employee

    Route::post('orderCancel', 'ProductManagementController@orderCancel')->middleware('checkSigninEmployee','CheckLevelAdmin');//Xoa acc employee

    Route::get('category-management','CategoryController@showMenuManager' )->name('category.categoryManagement')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::get('createCategory','CategoryController@createCategory')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::post('storeCategory','CategoryController@storeCategory')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::get('editCategory&id={id}','CategoryController@editCategory')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::put('updateCategory&id={id}','CategoryController@updateCategory')->name("category.update")->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::delete('deleteCategory&id={id}','CategoryController@deleteCategory')->name('category.deleteCategory')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::get('slideshow-management','SlideShowController@showSlideshowManager' )->name('slideshow.slideshowManagement')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::get('createSlideshow','SlideShowController@createSlideshow')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::post('storeSlideshow','SlideShowController@storeSlideshow')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::get('editSlideshow&id={id}','SlideShowController@editSlideshow')->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::put('updateSlideshow&id={id}','SlideShowController@updateSlideshow')->name("slideshow.update")->middleware('checkSigninEmployee','CheckLevelAdmin');

    Route::delete('deleteSlideshow&id={id}','SlideShowController@deleteSlideshow')->name('slideshow.deleteSlideshow')->middleware('checkSigninEmployee','CheckLevelAdmin');

});
