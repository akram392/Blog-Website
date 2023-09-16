<?php

use Illuminate\Support\Facades\Route;

// Frontend
// use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\MemberController;

// Backend
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CommentController;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PagesController::class, 'index'])->name('homepage');
Route::get('/contact', [PagesController::class, 'contact'])->name('contact');
Route::post('/contact-Mail', [PagesController::class, 'contactMail'])->name('contactMail');

// Blog Pages
Route::get('/blog-post/{id}', [PagesController::class, 'show'])->name('blogpage');
Route::get('/post-details/{id}', [PagesController::class, 'postDetails'])->name('post-details');
Route::get('/search-content', [PagesController::class, 'search'])->name('search');

// User Login Pages
Route::get('/user-login', [PagesController::class, 'userLogin'])->name('userLogin');
Route::get('/customer-dashboard', [MemberController::class, 'index'])->name('customerDashboard');
Route::post('/update/{id}', [MemberController::class, 'update'])->name('dashboard.update');

// Comment Pages
Route::post('/send-message', [PagesController::class, 'storeComment'])->name('send.comment');
Route::post('/reply-message/{id}', [PagesController::class, 'replyComment'])->name('reply.comment');

/*
|--------------------------------------------------------------------------
| Backend Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::group(['prefix'=>'admin'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'isAdmin', 'verified'])->name('admin.dashboard');

    // Category Group
    Route::group(['prefix'=>'/category'], function(){
        Route::get('/manage', [CategoryController::class, 'index'])->name('category.manage');
        Route::get('/trash', [CategoryController::class, 'trash'])->name('category.trash');
        Route::get('/create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('/show', [CategoryController::class, 'show'])->name('category.show');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    });

    // Post Group
    Route::group(['prefix'=>'/post'], function(){
        Route::get('/manage', [PostController::class, 'index'])->name('post.manage');
        Route::get('/trash', [PostController::class, 'trash'])->name('post.trash');
        Route::get('/create', [PostController::class, 'create'])->name('post.create');
        Route::post('/store', [PostController::class, 'store'])->name('post.store');
        Route::get('/show', [PostController::class, 'show'])->name('post.show');
        Route::get('/edit/{id}', [PostController::class, 'edit'])->name('post.edit');
        Route::post('/update/{id}', [PostController::class, 'update'])->name('post.update');
        Route::post('/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');
    });

    // User Group
    Route::group(['prefix'=>'/user'], function(){
        Route::get('/manage', [UserController::class, 'index'])->name('user.manage');
        Route::get('/trash', [UserController::class, 'trash'])->name('user.trash');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/show', [UserController::class, 'show'])->name('user.show');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::post('/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    });

    // Comment Group
    Route::group(['prefix'=>'/comment'], function(){
        Route::get('/manage', [CommentController::class, 'index'])->name('comment.manage');
        Route::get('/trash', [CommentController::class, 'trash'])->name('comment.trash');
        Route::get('/create', [CommentController::class, 'create'])->name('comment.create');
        Route::post('/store', [CommentController::class, 'store'])->name('comment.store');
        Route::get('/show', [CommentController::class, 'show'])->name('comment.show');
        Route::get('/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
        Route::post('/update/{id}', [CommentController::class, 'update'])->name('comment.update');
        Route::post('/destroy/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    });

});

require __DIR__.'/auth.php';
