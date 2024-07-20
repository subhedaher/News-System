<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\WriterController;
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

Route::prefix('/')->group(function () {
    Route::get('', [HomeController::class, 'index'])->name('index');
    Route::get('contact', [ContactController::class, 'index'])->name('contact');
    Route::get('categories/{category}', [HomeController::class, 'category'])->name('categories');
    Route::get('articles/{article}', [HomeController::class, 'article'])->name('articles');
    Route::post('articles/comment', [HomeController::class, 'comment'])->name('comment');
    Route::post('contact/message', [ContactController::class, 'message'])->name('message');
});

Route::prefix('cms')->middleware('guest:admin,writer')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('auth.showLogin');
    Route::post('login', [AuthController::class, 'login'])->name('auth.login');
    Route::get('password/forgot', [AuthController::class, 'forgotPassword'])->name('auth.forgotPassword');
    Route::post('password/forgot', [AuthController::class, 'requestResetPassword'])->name('auth.requestResetPassword');
    Route::get('password/forgot/{token}', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::put('password/forgot', [AuthController::class, 'changePassword'])->name('auth.changePassword');
});

Route::prefix('cms/admin')->middleware(['auth:admin,writer', 'verified'])->group(function () {
    Route::get('', [IndexController::class, 'index'])->name('home');
    Route::resource('admins', AdminController::class);
    Route::resource('writers', WriterController::class);
    Route::get('/categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::put('/categories/trash/{id}', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('/categories/trash/{id}', [CategoryController::class, 'forceDelete'])->name('categories.forceDelete');
    Route::resource('categories', CategoryController::class);
    Route::get('/articles/trash', [ArticleController::class, 'trash'])->name('articles.trash');
    Route::put('/articles/trash/{id}', [ArticleController::class, 'restore'])->name('articles.restore');
    Route::delete('/articles/trash/{id}', [ArticleController::class, 'forceDelete'])->name('articles.forceDelete');
    Route::resource('articles', ArticleController::class);
    Route::get('profile/edit', [AuthController::class, 'editProfile'])->name('auth.editProfile');
    Route::put('profile/edit', [AuthController::class, 'updateProfile'])->name('auth.updateProfile');
    Route::get('password/edit', [AuthController::class, 'editPassword'])->name('auth.editPassword');
    Route::put('password/edit', [AuthController::class, 'updatePassword'])->name('auth.updatePassword');
    Route::get('comments', [HomeController::class, 'getComments'])->name('getComments');
    Route::delete('comments/{comment}', [HomeController::class, 'deleteComment'])->name('comment.delete');
    Route::get('messages', [ContactController::class, 'getMessages'])->name('getMessages');
    Route::delete('messages/{message}', [ContactController::class, 'deleteMessage'])->name('message.delete');
    Route::get('notifications/seeAll', [ArticleController::class, 'seeAll'])->name('seeAll');
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
    Route::put('/article/status/approved/{article}', [ArticleController::class, 'approved'])->name('approved');
    Route::put('/article/status/rejected/{article}', [ArticleController::class, 'rejected'])->name('rejected');
    Route::put('/article/status/haed-rejected/{article}', [ArticleController::class, 'hardRejected'])->name('hardRejected');
});

Route::prefix('cms/admin')->middleware(['auth:admin', 'verified'])->group(function () {
    Route::put('roles/permission', [RoleController::class, 'updateRolePermission'])->name('updateRolePermission');
    Route::resource('roles', RoleController::class);
});

Route::prefix('cms/email')->middleware(['auth:admin,writer'])->group(function () {
    Route::get('verification', [AuthController::class, 'showEmailVerification'])->name('verification.notice');
    Route::post('verification', [AuthController::class, 'emailVerification'])->middleware('throttle:3,3')->name('auth.emailVerification');
    Route::get('verification/{id}/{hash}', [AuthController::class, 'verify'])->middleware('signed')->name('verification.verify');
});