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
Route::get('/blog-post/{id}', [PagesController::class, 'show'])->name('blogpage');
Route::get('/post-details/{id}', [PagesController::class, 'postDetails'])->name('post-details');
Route::get('/search/', [PagesController::class, 'search'])->name('search');

// User Login Pages
Route::get('/user-login', [PagesController::class, 'userLogin'])->name('userLogin');
Route::get('/customer-dashboard', [MemberController::class, 'index'])->name('customerDashboard');
Route::post('/update/{id}', [MemberController::class, 'update'])->name('dashboard.update');

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

});

require __DIR__.'/auth.php';













// <?php

// use App\Http\Controllers\ProfileController;
// use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

