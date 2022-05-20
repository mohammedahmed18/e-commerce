<?php

use App\Http\Controllers\AdminsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;

// dashboard
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/products/insert',[PagesController::class , 'createProductPage']);
    Route::post('/product' , [ProductsController::class , 'store']);
    Route::delete('/clear',[ProductsController::class , 'clear']);
    Route::post('/category' ,[CategoriesController::class , 'addCategory']);
    Route::delete('/category/{id}' ,[CategoriesController::class , 'deleteCategory']);
    Route::patch('/changepass',[AdminsController::class , 'changePassword']);
    Route::post('/avatar',[AdminsController::class , 'uploadavatar']);
    Route::patch('/approve-order/{id}' , [OrdersController::class , 'approveOrder']);
    Route::patch('/arrive-order/{id}' , [OrdersController::class , 'arriveOrder']);
    Route::delete('/product/{id}' , [ProductsController::class , 'deleteProduct']);
    Route::patch('/category/edit/{id}' ,[CategoriesController::class , 'update']);

});


Route::group(['prefix' => '/dashboard', 'middleware' => ['admin.auth']], function(){
    Route::get('/', [PagesController::class , 'dashboard']);
    Route::get('/products', [PagesController::class , 'dashboardProducts'])->middleware('setPage');
    Route::get('/categories' ,[CategoriesController::class , 'getAllCategories']);
    Route::get('/category/edit/{id}' ,[CategoriesController::class , 'editPage']);
    Route::get('/orders' ,[OrdersController::class , 'getAllOrders']);
    Route::get('/users' ,[UsersController::class , 'getAllUsers']);
    Route::patch('/users/toggle-block/{id}' ,[UsersController::class , 'toggleBlock']);
    Route::get('/profile' ,[AdminsController::class , 'showProfile']);
    Route::post('/logout', [AdminsController::class , 'logout']);
    Route::get('/order/details/{id}' , [OrdersController::class , 'orderDetails']);
});

Route::middleware(['admin.noAuth'])->group(function () {
    Route::get('/dashboard-login', [PagesController::class , 'dashboardLogin']);
    Route::post('/dashboard-login' , [AdminsController::class , 'login']);
});


// actual website

// login and sign up
Route::get('/' , [PagesController::class , 'home']);
Route::get('/signup' , [PagesController::class ,'signUpPage']);
Route::post('/signup' , [UsersController::class , 'signup']);
Route::get('/login' , [PagesController::class ,'loginPage']);
Route::post('/login' , [UsersController::class , 'login']);
Route::delete('/logout' , [UsersController::class , 'logout']);

// products for user
Route::get('/products' , [PagesController::class , 'productPage'])->middleware('setPage');
Route::post('/search', [ProductsController::class , 'search']);
Route::get('/product/{id}' , [ProductsController::class , 'productDetails']);


Route::middleware(['user.auth'])->group(function () {
// cart
Route::post('/add-to-cart' , [CartController::class , 'addToCart']);
Route::get('/cart' , [CartController::class , 'showCartPage']);
Route::delete('/remove-cart-item' , [CartController::class , 'removeCartItem']);
Route::patch('/change-quantity' ,[CartController::class , 'changeQuantiy']);
});



// orders
Route::post('/order',[OrdersController::class , 'makeOrder'])->middleware('user.auth');