<?php

use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostsController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\TrashedController;
use App\Http\Controllers\Dashboard\AdminController;
use App\Http\Controllers\Website\CategoryController as WebsiteCategoryController;
use App\Http\Controllers\Website\IndexController;
use App\Http\Controllers\Website\PostController;
use App\Http\Controllers\Website\SubscriberController;
use Illuminate\Support\Facades\Route;
use App\Models\Visitor;

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
 

// website 

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/categories/{category}', [WebsiteCategoryController::class, 'show'])->name('category');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post');
Route::get('/post/{post}/{slug}', [PostController::class, 'showUrl'])->name('posturl');

Route::get('/posts/{tag}', [PostController::class, 'showPostsByTag'])->name('posts.byTag');
Route::post('subscribers/store', [SubscriberController::class, 'store'])->name('subscribers.store');







// Dashboard
Route::group(['prefix' => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'checkLogin']], function () {

    Route::get('/' , [AdminController::class,'index'])->name('index');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');
    Route::post('/settings/update/{setting}', [SettingController::class, 'update'])->name('settings.update');

    Route::get('/users/all', [UserController::class, 'getUsersDatatable'])->name('users.all');
    Route::post('/users/delete', [UserController::class, 'delete'])->name('users.delete');


    Route::get('/category/all', [CategoryController::class, 'getCategoriesDatatable'])->name('category.all');
    Route::post('/category/delete', [CategoryController::class, 'delete'])->name('category.delete');


    Route::get('/posts/all', [PostsController::class, 'getPostsDatatable'])->name('posts.all');
    Route::post('/posts/delete', [PostsController::class, 'delete'])->name('posts.delete');



    Route::get('/users/all/', [UserController::class, 'getUsersDatatable'])->name('users.all');

    Route::resources([
        'users' => UserController::class,
        'category' => CategoryController::class,
        'posts' => PostsController::class,
    ]);

    //trash
    Route::get('/trash/all', [TrashedController::class, 'getTrashedsDatatable'])->name('trash.all');
    Route::get('/trash', [TrashedController::class, 'index'])->name('trash');
    Route::post('/trash/delete', [TrashedController::class, 'delete'])->name('trash.delete');
    Route::get('/trash/deleteAll', [TrashedController::class, 'deleteAll'])->name('trash.deleteAll');
    Route::get('/trash/restore/{id}', [TrashedController::class, 'restore'])->name('trash.restore');
    Route::post('/trash/restoreAll', [TrashedController::class, 'restoreAll'])->name('trash.restoreAll');
   
});

///////////for test /////////////
Route::get('/upload', [PostsController::class, 'upload'])->name('image.upload');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
 