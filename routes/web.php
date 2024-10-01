<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// SITE ROUTES
Route::controller(SiteController::class)->name('site.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/index', 'index')->name('index');

    Route::get('/category/{id}', 'category')->name('category');
    Route::get('/contact', 'contact')->name('contact');
    // Route::get('/single-blog', 'singleBlog')->name('singleBlog');

});

// SUBSCRIBER STORE ROUTE
Route::post('/subscriber/store', [SubscriberController::class,'store'])->name('subscriber.store');

// Contact STORE ROUTE
Route::post('/contact/store', [ContactController::class,'store'])->name('contact.store');

//BLOG ROUTES
Route::resource('blogs', BlogController::class);

// COMMENT STORE ROUTE
Route::post('/comment/store', [CommentController::class,'store'])->name('comments.store');


require __DIR__.'/auth.php';
