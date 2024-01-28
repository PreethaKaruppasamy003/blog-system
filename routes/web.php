<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [BlogController::class, 'all_blog'])->name('home_blog');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/home', [UserController::class, 'logout'])->name('user.logout');

Route::get('/blog-category', [BlogCategoryController::class, 'index'])->name('blog-category.index');
Route::get('/blog-category/{id}/edit', [BlogCategoryController::class, 'edit'])->name('blog-category.edit');
Route::patch('/blog-category/{id}/update', [BlogCategoryController::class, 'update'])->name('blog-category.update');
Route::post('/blog-category/store', [BlogCategoryController::class, 'store'])->name('blog-category.store');
Route::get('/blog-category/{id}', [BlogCategoryController::class, 'destroy'])->name('blog-category.destroy');

Route::get('/blog/category-import', [BlogCategoryController::class, 'import_export'])->name('category.import_export');
Route::get('/blog/category-pdf', [BlogCategoryController::class, 'pdf_download_category'])->name('pdf.category');
Route::post('/bulk-category-upload', [BlogCategoryController::class, 'bulk_upload'])->name('bulk_category_upload');



Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
Route::get('/blog/{id}/edit', [BlogController::class, 'edit'])->name('blog.edit');
Route::match(['get', 'patch'], '/blog/{id}/update', [BlogController::class, 'update'])->name('blog.update');
Route::get('/blog/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
Route::post('/blog/change-status', [BlogController::class, 'change_status'])->name('blog.change-status');

Route::get('/blog-details/{id}', [BlogController::class, 'blog_details'])->name('blog.details');

Route::post('/comment/store', [UserController::class, 'comment_store'])->name('comment.store');
Route::get('/comment/edit/{id}/{comment}', [UserController::class, 'comment_edit'])->name('comment.edit');
Route::get('/comment/{id}', [UserController::class, 'comment_destroy'])->name('comment.destroy');

