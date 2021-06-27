<?php

use Illuminate\Support\Facades\Route;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
//Auth::routes();

// admin
Route::get('/admin','AuthController@index');

Route::post('/admin/login','Admin\UserController@signIn');

Route::get('/logout', 'HomeController@logout');

Route::group(['middleware'=> ['admin']], function () {

Route::get('/admin/user', 'Admin\UserController@user');

Route::get('/admin/categories', 'Admin\CategoryController@index');
Route::get('/admin/get-latest-element-cat/{id}', 'Admin\CategoryController@getLatestElement');
Route::get('/admin/category/remove/{id}', 'Admin\CategoryController@remove');
Route::get('/admin/category/edit/{id}', 'Admin\CategoryController@edit');
Route::post('/admin/create/category', 'Admin\CategoryController@create');
Route::post('/admin/edit/category', 'Admin\CategoryController@updateCat');
Route::get('/admin/category/{id}', 'Admin\CategoryController@podCategory');
Route::get('/admin/pod-category/{id}', 'Admin\CategoryController@podPodCategory');
Route::get('/admin/category/{id}/products', 'Admin\ProductController@index');
Route::post('/admin/product/image-to-temp', 'Admin\ProductController@imageToTemp');
Route::post('/admin/product/create', 'Admin\ProductController@create');
Route::post('/admin/product/update', 'Admin\ProductController@updateProd');
Route::get('/admin/product/remove/{id}', 'Admin\ProductController@remove');
Route::get('/admin/product/edit/{id}', 'Admin\ProductController@edit');
Route::get('/admin/product-galery/delete/{id}', 'Admin\ProductController@deleteGaleryItem');
Route::get('/add-recomend-product/{id}', 'Admin\ProductController@addProductRecomend');
Route::get('/add-recomend-product-save/{rID}/{pID}', 'Admin\ProductController@addProductRecomendDB');
Route::get('/delete-recomend-prod/{rID}/{pID}', 'Admin\ProductController@removeProductRecomendDB');
Route::post('/admin/products/load-more', 'Admin\ProductController@loadMore');





//users
    Route::get('/admin/users', 'Admin\UserController@index');
    Route::get('/admin/user/change-active/{id}', 'Admin\UserController@change');
    Route::post('/admin/users/create', 'Admin\UserController@create');
    Route::get('/admin/users/delete/{id}', 'Admin\UserController@delete');
    Route::get('/admin/user/edit/{id}', 'Admin\UserController@edit');
    Route::post('/admin/users/update', 'Admin\UserController@update');


    //orders
    Route::get('/admin/orders', 'Admin\OrderController@index');
    Route::get('/admin/order/{id}', 'Admin\OrderController@detail');
    Route::post('/admin/order-change-status', 'Admin\OrderController@changeSts');

    //Home Cats
    Route::get('/admin/home-cats', 'Admin\SiteController@homeCats');
    Route::post('/admin/home-cats-update', 'Admin\SiteController@homeCatsUpdate');



    //Delivery
    Route::get('/admin/delivery', 'Admin\DeliveryController@index');
    Route::post('/admin/delivery-change', 'Admin\DeliveryController@save');



    // site settings
    Route::get('/admin/site-settings', 'Admin\SiteController@index');
    Route::post('/admin/site-property/update', 'Admin\SiteController@update');




    // slideshow
    Route::get('/admin/slideshow', 'Admin\SlideshowController@index');
    Route::get('/admin/slideshow/show/{id}', 'Admin\SlideshowController@show');
    Route::get('/admin/slideshow/create', 'Admin\SlideshowController@create');
    Route::post('/admin/slideshow/create', 'Admin\SlideshowController@store');
    Route::get('/admin/slideshow/edit/{id}', 'Admin\SlideshowController@edit');
    Route::post('/admin/slideshow/edit/{id}', 'Admin\SlideshowController@update');
    Route::get('/admin/slideshow/delete/{id}', 'Admin\SlideshowController@destroy');
    Route::get('/admin/slideshow/deleteimg/{id}/{type}', 'Admin\SlideshowController@deleteimg');
    Route::get('/admin/slide/change-active/{id}', 'Admin\SlideshowController@changeActive');

});

/*********************************************************************************************************************/
/*********************************************************************************************************************/
/*********************************************************************************************************************/
/********************************------- FRONTEND  -----------********************************************************/
/*********************************************************************************************************************/
/*********************************************************************************************************************/
/*********************************************************************************************************************/
/*********************************************************************************************************************/

Route::get('/', 'Frontend\IndexController@index');

Route::post('/login', 'Frontend\UserController@login');

//users routes
Route::group(['middleware'=> ['authCheck']], function () {

    Route::get('/user', 'Frontend\UserController@profile');
    Route::post('/update-user-info', 'Frontend\UserController@updateInfo');
    Route::post('/update-user-pass', 'Frontend\UserController@updatePass');


    //order user
    Route::get('/order-detail/{id}', 'Frontend\UserController@orderDetail');
    Route::get('/order-back', 'Frontend\UserController@orderList');

});

//user create
Route::post('/user-create', 'Frontend\UserController@create');
Route::post('/check-sms-code', 'Frontend\UserController@smsCode');



//product routes
Route::get('/change-sort/{sort}', 'Frontend\CatalogController@changeSort');
Route::post('/change-filter', 'Frontend\CatalogController@changeFilterPrice');

Route::get('/catalog', 'Frontend\CatalogController@index');
Route::get('/category/{id}', 'Frontend\CatalogController@category');
Route::get('/pod-category/{id}', 'Frontend\CatalogController@podCategory');
Route::get('/products/{id}', 'Frontend\CatalogController@products');
Route::get('/product/{id}', 'Frontend\CatalogController@product');

//cart
Route::get('/cart', 'Frontend\CartController@viewCart');
Route::post('/cart-change-qnt', 'Frontend\CartController@changeQuantityCart');
Route::get('/remove-from-cart/{id}', 'Frontend\CartController@removeFromCart');
Route::get('/get-cart-items', 'Frontend\CartController@getCartItems');
Route::post('/add-to-cart', 'Frontend\CartController@addToCart');

//wishlists
Route::get('/add-to-wishlist/{id}', 'Frontend\CartController@addToWishlist');
Route::get('/get-wishlist-count', 'Frontend\CartController@qntWishlist');
Route::get('/remove-wishlist/{id}', 'Frontend\CartController@removeFromWishlist');
Route::get('/get-wishlists', 'Frontend\CartController@wishlist');
//checkout
Route::get('/checkout', 'Frontend\CartController@checkout');
Route::post('/checkout/order', 'Frontend\CartController@checkoutOrder');




//contacts
Route::get('/contacts', 'Frontend\ContactController@index');

///about us
Route::get('/about-us', 'Frontend\AboutController@index');

Route::get('/delivery-and-payment', 'Frontend\DeliveryController@index');


