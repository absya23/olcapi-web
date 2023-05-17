<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// ========= ADMIN ==========
// -> get all admin
Route::get('admin', 'AdminController@index');
// -> check login
Route::post('admin/login', 'AdminController@login');

// =========== CATALOGUE ============================== 
// -> get all catalogue
Route::get('catalogue', 'CatalogueController@index');
// -> thêm catalogue
Route::post('catalogue', 'CatalogueController@store');
// -> xóa catalogue
Route::delete('catalogue/{id}', 'CatalogueController@destroy');
// -> sửa catalogue
Route::put('catalogue/{id}', 'CatalogueController@update');

// =========== TYPE PRODUCT ===========================
// -> get all typeprod
Route::get('types', 'TypeProductController@index');
// -> thêm typeprod
Route::post('types', 'TypeProductController@store');
// -> xóa typeprod
Route::delete('types/{id}', 'TypeProductController@destroy');
// -> sửa typeprod
Route::put('types/{id}', 'TypeProductController@update');
// -> get types by id_cata
Route::get('types/cata/{id_cata}', 'TypeProductController@getByCata');

// ===========  PRODUCT ===========================
// -> get all PRODUCT
Route::get('product', 'ProductController@index');
// -> thêm 1 PRODUCT
Route::post('product', 'ProductController@store');
// -> xóa 1 PRODUCT
Route::delete('product/{id}', 'ProductController@destroy');
// -> sửa 1 PRODUCT
Route::put('product/{id}', 'ProductController@update');
// -> cập nhật sl tồn kho khi đặt hàng
Route::post('product/update', 'ProductController@updateQuantity');
// -> lấy sản phẩm theo id_prod
Route::get('product/{id}', 'ProductController@show');
// -> lấy sản phẩm theo danh mục
Route::get('product/cata/{id_cata}', 'ProductController@getByCata');
// -> lấy sản phẩm theo loại sản phẩm
Route::get('product/type/{id_type}', 'ProductController@getByType');

// -> lấy sản phẩm theo danh mục và sx theo tgian, theo giá tăng, theo giá giảm
Route::get('product/cata/{id_cata}/date/latest', 'ProductController@getByCataLatest');
Route::get('product/cata/{id_cata}/{type_price}', 'ProductController@getByCataPrice');
// -> lấy sản phẩm theo loại sản phẩm và sx theo tgian, theo giá tăng, theo giá giảm
Route::get('product/type/{id_type}/date/latest', 'ProductController@getByTypeLatest');
Route::get('product/type/{id_type}/{type_price}', 'ProductController@getByTypePrice');

// -> sắp xếp sản phẩm theo giá giảm dần
Route::get('product/sort/desc', 'ProductController@getPriceDesc');
// -> sắp xếp sản phẩm theo giá tăng dần
Route::get('product/sort/asc', 'ProductController@getPriceAsc');
// -> lấy sản phẩm theo mức Giá
Route::get('product/price/{price_from}/{price_to}', 'ProductController@getPrice');
// -> sắp xếp sản phẩm theo ngày tạo
Route::get('product/date/latest', 'ProductController@getLatest');
// -> max/min price of products 
Route::get('product/price/max', 'ProductController@getMaxPrice');
Route::get('product/price/min', 'ProductController@getMinPrice');
//  -> tìm theo tên sản phẩm
Route::get('product/search/{search}', 'ProductController@search');
// 
Route::get('product/sold/best', 'ProductController@getBestSeller');


// ===========  IMAGES ===========================
// -> get all IMAGES theo id của sản phẩm
Route::get('images/{idprod}', 'ImagesController@show');
// -> thêm 1 IMAGES theo sp theo id của sản phẩm
Route::post('images', 'ImagesController@store');
// -> xóa 1 IMAGES theo sp theo id của ảnh
Route::delete('images/{id}', 'ImagesController@destroy');

// =========== STATUS =================
// -> get all status 
Route::get('status', 'StatusController@index');

// ============ USER ====================
// -> get all Users
Route::get('user', 'UserController@index');
// -> get all User by uid
Route::get('user/{id}', 'UserController@show');
// -> login 
Route::post('user/login', 'UserController@login');
// -> create new user 
Route::post('user/register', 'UserController@store');
// -> forget password
Route::post('user/getpassword/{id}', 'UserController@checkPass');
// -> sửa thông tin user
Route::put('user/{id}', 'UserController@update');

// ============ ORDER ====================
// -> get all ORDERS
Route::get('orders', 'OrderController@index');
// -> sửa trạng thái đơn hàng by id_order: chỉ cần gửi id_status
Route::put('orders/{id}', 'OrderController@update');
// -> user tạo đơn hàng
Route::post('orders', 'OrderController@store');

// ============ ORDER DETAIL ====================
// get all orderdetail
Route::get('orderdetail', 'OrderDetailController@index');
// -> get chi tiết đơn hàng by id_order
Route::get('order/{id}', 'OrderDetailController@show');
// -> get orders by uid
Route::get('order/user/{id_user}', 'OrderDetailController@getOrderUser');
// -> user tạo đơn hàng
Route::post('order', 'OrderDetailController@store');

// ============= SLIDE ==============
// get all image
Route::get('slide', 'SlideController@index');
// theem 1 slide
Route::post('slide', 'SlideController@store');
// -> xóa 1 slide theo id
Route::delete('slide/{id}', 'SlideController@destroy');

// ========== CART DETAIL ================
// get all cartdetail
Route::get('cart', 'CartDetailController@index');
// get all cartdetail by id_user
Route::get('cart/{id_user}', 'CartDetailController@show');
// add product to cartdetail
Route::post('cart', 'CartDetailController@store');
// xoá sp khỏi giỏ hàng
Route::delete('cart/{id}', 'CartDetailController@destroy');
//  Thay đổi số lượng sp trong giỏ hàng
Route::put('cart/{id}', 'CartDetailController@update');
// sau khi đặt hàng thành công, xóa list sp khỏi giỏ hàng
Route::post('cart/delete', 'CartDetailController@deleteCarts');

// ========== FAVO DETAIL =================
// get all favodetail
Route::get('favo', 'FavoDetailController@index');
// get all favodetail by id_user
Route::get('favo/{id_user}', 'FavoDetailController@show');
// add favodetail 
Route::post('favo', 'FavoDetailController@store');
// remove favodetail
Route::delete('favo/{id}', 'FavoDetailController@destroy');