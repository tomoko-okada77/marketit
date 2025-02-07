<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/category/{id}', [HomeController::class, 'category'])->name('category');
Route::get('/all', [HomeController::class, 'all'])->name('all');

Route::group(['middleware' => 'auth'], function(){

    // PRODUCTS
    Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/product/{id}/show', [ProductController::class, 'show'])->name('product.show');
    Route::get('/product/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::patch('/product/{id}/update', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{id}/destroy', [ProductController::class, 'destroy'])->name('product.destroy');
    
    // LIKES
    Route::post('/like/{product_id}/store', [LikeController::class, 'store'])->name('like.store');
    Route::delete('/like/{product_id}/destroy', [LikeController::class, 'destroy'])->name('like.destroy');

    // COMMENTS
    Route::post('/comment/{product_id}/store', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{id}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');

    // PROFILE
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}/followers', [ProfileController::class, 'followers'])->name('profile.followers');
    Route::get('/profile/{id}/following', [ProfileController::class, 'following'])->name('profile.following');
    Route::get('/profile/{id}/favorite', [ProfileController::class, 'favorite'])->name('profile.favorite');
    Route::get('/profile/{id}/purchases', [ProfileController::class, 'purchases'])->name('profile.purchases');
    Route::get('/profile/{id}/sales', [ProfileController::class, 'sales'])->name('profile.sales');
    Route::get('/profile/{id}/reviews', [ProfileController::class, 'reviews'])->name('profile.reviews');

    // FOLLOW
    Route::post('/follow/{user_id}/store', [FollowController::class, 'store'])->name('follow.store');
    Route::delete('/follow/{user_id}/destroy', [FollowController::class, 'destroy'])->name('follow.destroy');

    // TRANSACTION
    Route::post('/transaction/{product_id}/store', [TransactionController::class, 'store'])->name('transaction.store');

    // NOTIFICATION
    Route::get('/notification', [NotificationController::class, 'index'])->name('notification');
    Route::patch('/notification/readAll', [NotificationController::class, 'readAll'])->name('notification.readAll');
    Route::patch('/notification/{id}/read', [NotificationController::class, 'read'])->name('notification.read');

    // REVIEW
    Route::post('/review/{product_id}/store', [ReviewController::class, 'store'])->name('review.store');

    // CART
    Route::get('/cart', [CartItemController::class, 'index'])->name('cart');
    Route::post('/cart/{product_id}/store', [CartItemController::class, 'store'])->name('cart.store');
    Route::post('/cart/buy', [CartItemController::class, 'buy'])->name('cart.buy');
    Route::delete('/cart/{id}/destroy', [CartItemController::class, 'destroy'])->name('cart.destroy');
});