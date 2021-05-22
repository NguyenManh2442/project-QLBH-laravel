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

use Illuminate\Support\Facades\Route;

Route::group(['namespace'=>'Customer'], function(){
    Route::get('/','ProductController@index'); //TRang chủ

    Route::get('getproductbycatid/{idProduct}', 'ProductController@getproductbycatid'); //hiển thị các sản phẩm theo menu

    Route::get('getPopularSellingProducts','ProductController@getPopularSellingProducts');

    Route::get('getNewProducts','ProductController@getNewProducts');

    Route::get('cart','ProductController@getCart'); // giỏ hàng

    Route::post('addCart','CartController@addCart'); // post thêm giỏ hàng

    Route::post('checkVoucher','CartController@checkVoucher');

    Route::post('confirmVoucher','CartController@confirmVoucher');

    Route::post('updateCart','CartController@updateCart'); //post Cập nhât giỏ hàng

    Route::get('detail&id={id}', 'ProductController@getOne'); // chi tiết của 1 sản phẩm

    Route::get('createAddress', 'DeliveryAddressController@createAddress')->middleware('checkSignUse');

    Route::post('storeAddress','DeliveryAddressController@storeAddress')->name("address.store")->middleware('checkSignUse');

    Route::get('editAddress&id={id}','DeliveryAddressController@editAddressByID')->middleware('checkSignUse');

    Route::put('updateAddressById&id={id}','DeliveryAddressController@updateAddressById')->name('address.update_address_by_id')->middleware('checkSignUse');

    Route::post('editAddress','DeliveryAddressController@editAddress')->middleware('checkSignUse');

    Route::put('updateAddress&id={id}','DeliveryAddressController@updateAddress')->name('address.update_address')->middleware('checkSignUse');

    Route::delete('deleteAddress&id={id}','DeliveryAddressController@deleteAddress')->name('address.detete')->middleware('checkSignUse');

    Route::put('cancel-status-order&id={id}','OrderController@updateOrderStatus')->name('order.status_cancel')->middleware('checkSignUse');

    Route::post('storeAddressSession','DeliveryAddressController@storeAddressSession')->middleware('checkSignUse');
    
    Route::post('postOrderProduct', 'OrderController@postOrderProduct')->middleware('checkSignUse');

    Route::get('signin','customerController@form_signin')->middleware('checkUser'); // đăng Nhập form

    Route::post('post-signin','customerController@signin'); // post đăng nhập

    Route::get('ordered&status={status}','OrderController@getOrdered')->name('order.ordered');

    Route::get('logout','customerController@logout'); // đăng xuất tải khoản

    Route::get('signup','customerController@form_signup')->middleware('checkUser'); // Đăng ký tài khoản form

    Route::post('post-signup','customerController@signup'); // post đăng ký

    Route::get('infor','customerController@editInfor')->name('infor')->middleware('checkSignUse'); // cập nhật thông tin user form

    Route::post('update-infor', 'customerController@updateInfor')->name('updateInfor')->middleware('checkSignUse'); // post cập nhật thông tin user

    Route::post('change-password-user', 'customerController@changePassword')->name('changePassword')->middleware('checkSignUse');

    Route::get('forgot-password','customerController@formForgetPassword');// form quên m khẩu

    Route::post('forgot-password', 'customerController@seedForgotPassword');

    Route::get('reset-password', 'customerController@formReset')->name('get.link.reset.password');

    Route::post('post-reset-password','customerController@saveResetPassword');

    Route::post('getProductSort','ProductController@getProductSort');

    Route::post('getProductLatest','ProductController@getProductLatest');

    Route::get('order-products','ProductController@orderProducts');

});

Route::group(['namespace'=>'Admin'],function(){
    Route::get('admin','AdminController@index')->name('index')->middleware('checkSigninEmployee','checkAdminAndEmployee');// Trang quản trị admin

    Route::get('shipper','ShipperController@index')->middleware('checkSigninEmployee','CheckLevelShipper');

    Route::get('signinAdminForm','AdminController@formSignin')->middleware('checkUserEmployee');//trang đăng nhập

    Route::post('signinAdmin','AdminController@signinAdmin');// post trang đăng nhập

    Route::get('logoutAdmin','AdminController@logoutAdmin');//Đăng xuất admin

    Route::get('profile','AdminController@editProfile')->name('profile')->middleware('checkSigninEmployee');

    Route::post('profile','AdminController@updateProfile')->name('updateProfile')->middleware('checkSigninEmployee');

    Route::post('change-password','AdminController@updatePassword')->name('updatePassword')->middleware('checkSigninEmployee');

    Route::get('product-management','ProductManagementController@viewProduct')->name('product.management')->middleware('checkAdminAndEmployee');//Hiển thị các sản phẩm qản lý

    Route::get('addProduct','ProductManagementController@createProduct')->middleware('checkAdminAndEmployee');//Form thêm sản phẩm

    Route::post('getCategory','ProductManagementController@getCategoryAjax')->middleware('checkAdminAndEmployee');//Lấy menu hiển thi ra trang thêm sản phẩm

    Route::post('addProduct', 'ProductManagementController@storeProduct')->middleware('checkAdminAndEmployee');// post Thêm sản phẩm

    Route::get('repair&id={id}', 'ProductManagementController@editProduct')->middleware('checkAdminAndEmployee'); // sua thong tin sản phẩm

    Route::put('repairProduct&id={id}', 'ProductManagementController@updateProduct')->name('update_product')->middleware('checkAdminAndEmployee');// post sửa sản phẩm

    Route::delete('delete&id={id}', 'ProductManagementController@deleteProduct')->name('delete_product')->middleware('checkAdminAndEmployee');// delete sản phẩm

    Route::get('orderManagement&status={status}','OrderManagementController@orderManagement')->name('order.management')->middleware('checkAdminAndEmployee');//quan ly don hang

    Route::get('orderdetail&id={id}','OrderManagementController@getOrderdetail')->middleware('checkAdminAndEmployee');//xem chi tiet don hang

    Route::put('update-status-order&id={id}','OrderManagementController@updateOrderStatus')->name('update.status_order')->middleware('checkAdminAndEmployee');//Xac nhan don hang

    // shipper
    Route::prefix('shipper')->group(function () {
        Route::get('receive-purchase-order', 'ShipperController@receivePurchaseOrder')->name('shipper.receive_purchase_order')->middleware('CheckLevelShipper');
        
        Route::put('receive-purchase-order&id={id}', 'ShipperController@updateStatusOrder')->name('shipper.update_status_order')->middleware('CheckLevelShipper');

        Route::get('order-shipping', 'ShipperController@orderShipping')->name('shipper.order_shipping')->middleware('CheckLevelShipper');

        Route::get('order-shipped', 'ShipperController@orderShipped')->name('shipper.order_shipped')->middleware('CheckLevelShipper');

        Route::get('edit-profile', 'ShipperController@editProfile')->name('shipper.edit_profile')->middleware('CheckLevelShipper');

    });
    // end shipper
    
    // vouchers
    Route::resource('/vouchers', 'VoucherController', ['only' => ['index', 'create', 'store','edit','update', 'destroy']])->name('*','vouchers')->middleware('checkAdminAndEmployee');;
    // end vouchers

    Route::get('admin-account-management','AdminController@adminAccountManagement')->name('admin.accountManagement')->middleware('CheckLevelAdmin');// hien thi acc employee

    Route::get('createAccAdmin', 'AdminController@createAccountAdmin')->middleware('CheckLevelAdmin');//form them tai khoan employee

    Route::post('createAccAdmin','AdminController@storeAccountAdmin')->name('store_acc_admin')->middleware('CheckLevelAdmin');//post them tai khoan employee

    Route::get('editAccountAdmin&id={id}', 'AdminController@editAccountAdmin')->middleware('CheckLevelAdmin');

    Route::put('updateAccAdmin&id={id}', 'AdminController@updateAccountAdmin')->name('update_acc_admin')->middleware('CheckLevelAdmin');

    Route::delete('deleteAccountAdmin&id={id}', 'AdminController@deleteAccountAdmin')->name('delete_acc_admin')->middleware('CheckLevelAdmin');//Xoa acc employee

    Route::get('customer-account-management','CustomerManagementController@index')->name('admin.customerAccountManagement')->middleware('CheckLevelAdmin');// hien thi acc employee

    Route::put('changeStatusAccUser&id={id}', 'CustomerManagementController@changeStatus')->name('change_status_acc_user')->middleware('CheckLevelAdmin');

    Route::get('category-management','CategoryController@showMenuManager' )->name('category.categoryManagement')->middleware('CheckLevelAdmin');

    Route::get('createCategory','CategoryController@createCategory')->middleware('CheckLevelAdmin');

    Route::post('storeCategory','CategoryController@storeCategory')->middleware('CheckLevelAdmin');

    Route::get('editCategory&id={id}','CategoryController@editCategory')->middleware('CheckLevelAdmin');

    Route::put('updateCategory&id={id}','CategoryController@updateCategory')->name("category.update")->middleware('CheckLevelAdmin');

    Route::delete('deleteCategory&id={id}','CategoryController@deleteCategory')->name('category.deleteCategory')->middleware('CheckLevelAdmin');

    Route::get('slideshow-management','SlideShowController@showSlideshowManager' )->name('slideshow.slideshowManagement')->middleware('CheckLevelAdmin');

    Route::get('createSlideshow','SlideShowController@createSlideshow')->middleware('CheckLevelAdmin');

    Route::post('storeSlideshow','SlideShowController@storeSlideshow')->middleware('CheckLevelAdmin');

    Route::get('editSlideshow&id={id}','SlideShowController@editSlideshow')->middleware('CheckLevelAdmin');

    Route::put('updateSlideshow&id={id}','SlideShowController@updateSlideshow')->name("slideshow.update")->middleware('CheckLevelAdmin');

    Route::delete('deleteSlideshow&id={id}','SlideShowController@deleteSlideshow')->name('slideshow.deleteSlideshow')->middleware('CheckLevelAdmin');
    
    Route::get('discountProduct','ProductManagementController@discountProducts')->name("index.setDiscountProduct")->middleware('checkAdminAndEmployee');

    Route::post('setDiscountProduct','ProductManagementController@setDiscountProducts')->name("store.setDiscountProduct")->middleware('checkAdminAndEmployee');

});
