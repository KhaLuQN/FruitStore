<?php



use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Frontend\ErrorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

Auth::routes();




// Routes cho Đăng Nhập và Đăng Ký
Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');





Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');

Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/email/verify/{token}', [VerifyEmailController::class, 'verify'])
    ->name('verification.verify');


Route::get('/email/verify', function () {
    return view('auth.pages.verify-email');
})->name('verification.notice');


// Đăng xuất
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');





// Routes Frontend
Route::namespace('App\Http\Controllers\Frontend')->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/search', 'HomeController@search')->name('home.search');

    //sản phẩm
    Route::get('/allproduct', 'ProductController@index')->name('allproduct');
    Route::get('/product/{id}', 'ProductController@detailProduct')->name('detailproduct');
    //giỏ hàng
    Route::get('/cart', 'CartController@show')->name('cart.show')->middleware('auth');
    Route::post('/cart/add', 'CartController@add')->name('cart.add')->middleware('auth');
    Route::delete('/cart/destroy/{id}', 'CartItemController@destroy')->name('cart.destroy')->middleware('auth');
    Route::post('/cart/update', 'CartItemController@update')->name('cart.update')->middleware('auth');
    Route::post('/cart/checkout', 'CartController@checkout')->name('cart.checkout')->middleware('auth');
    Route::post('/cart/apply-discount', 'DiscountController@applyDiscount')->name('discount.apply')->middleware('auth');
    //checkout
    Route::get('/processcheckout', 'CheckoutController@index')->name('checkout.process')->middleware('auth');
    Route::post('/order/store', 'OrderController@store')->name('order.store')->middleware('auth');
    //đơn hàng
    Route::get('/orderShow', 'OrderController@show')->name('order.show')->middleware('auth');
    Route::get('/order_history', 'OrderController@ordersHistory')->name('order.history')->middleware('auth');
    //Bình luận+rating
    Route::post('/products/{productId}/reviews', 'ReviewController@store')->name('reviews.store');

    //Người dùng
    Route::get('/userShow', 'UserController@show')->name('user.show')->middleware('auth');
    Route::post('/profile/update', 'UserController@update')->name('profile.update')->middleware('auth');



    Route::get('/404', [ErrorController::class, 'index'])->name('404');
    Route::get('/contact', function () {
        return view('Frontend/pages/contact');
    })->name('contact');
});




// Routes Backend


Route::middleware(['auth.check'])->prefix('admin')->namespace('App\Http\Controllers\Backend')->group(function () {


    //DASHBOARD
    Route::middleware('role:admin,staff')->group(function () {
        Route::get('dashboard/index', 'DashboardController@index')->name('dashboard.index');
    });


    //USER
    Route::middleware('role:admin,staff')->prefix('user')->group(function () {
        Route::get('staff', 'UserController@staff')->name('staff.index');
        Route::get('index', 'UserController@index')->name('user.index');
        Route::get('create', 'UserController@create')->name('user.create');
        Route::post('store', 'UserController@store')->name('user.store')->middleware('admin');

        Route::put('/user/{id}', 'UserController@update')->name('user.update');
    });





    //PRODUCT
    Route::middleware('role:admin,staff')->prefix('products')->group(function () {
        Route::get('index', 'ProductController@index')->name('products.index');

        Route::get('create', 'ProductController@create')->name('products.create');

        Route::post('/', 'ProductController@store')->name('products.store');

        Route::get('{product}/edit', 'ProductController@edit')->name('products.edit');

        Route::put('{product}', 'ProductController@update')->name('products.update');
        Route::put('{product}/update-sale', 'ProductController@updateSale')->name('products.updateSale');
        Route::delete('{product}', 'ProductController@destroy')->name('products.destroy');
    });


    //CATEGORIE

    Route::middleware('role:admin,staff')->prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories.index');


        Route::get('/create', 'CategoryController@create')->name('categories.create');


        Route::post('/', 'CategoryController@store')->name('categories.store');



        Route::get('{category}/edit', 'CategoryController@edit')->name('categories.edit');


        Route::put('{category}', 'CategoryController@update')->name('categories.update');
        Route::delete('{category}', 'CategoryController@destroy')->name('categories.destroy');
    });

    //Discounts

    Route::middleware('role:admin,staff')->prefix('discounts')->group(function () {
        Route::get('/', 'DiscountsController@indexcode')->name('discounts.indexcode');
        Route::post('/add/discount', 'DiscountsController@store')->name('discount.store');
        Route::delete('{Discounts}', 'DiscountsController@destroy')->name('DiscountController.destroy');
    });

    // SALES PRODUCT
    Route::middleware('role:admin,staff')->prefix('sales')->group(function () {
        Route::get('/', 'SalesController@index')->name('product_sales.index');
        Route::put('/products/{id}/update-discount', 'SalesController@updateDiscountPercentage')->name('products.updateDiscount');
    });

    // ORDERs
    Route::middleware('role:admin,staff')->prefix('order')->group(function () {
        Route::get('/', 'OrderController@index')->name('manage_order.index');
        Route::get('/{orderId}/change-status', 'OrderController@changeStatus')->name('order.changeStatus');
        Route::get('/{orderId}/cancel-order', 'OrderController@cancelOrder')->name('order.cancelOrder');
    });


    Route::middleware('role:admin,staff')->prefix('reviews')->group(function () {
        Route::get('/', 'ReviewsController@index')->name('reviews.index');
        Route::delete('{id}', 'ReviewsController@destroy')->name('review.destroy');
    });
});
