<?php

use Illuminate\Support\Facades\Route;
use Modules\CMS\app\Http\Controllers\CMSController;
use Modules\CMS\app\Http\Controllers\CMSPostController;
use Modules\CMS\app\Http\Controllers\CMSCommentController;

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

Route::get('/cms', [CMSController::class, 'index'])->name('cms.index');

Route::controller(CMSPostController::class)->group(function()
{
    Route::get('cms/create', 'viewCreatePage')->name('cms.view');
    Route::post('cms/create/post', 'createCmsPost')->name('cms.post.create');
    Route::get('cms/update/{id}', 'edit')->name('cms.post.edit');
    Route::post('cms/update', 'update')->name('cms.post.update');
    Route::post('cms/delete{id}', 'delete')->name('cms.post.delete');
    Route::get('cms/view/{id}', 'view')->name('cms.post.view');
});

// Comment Controller 
Route::controller(CMSCommentController::class)->group(function () 
{
    Route::post('/cms/comment/{id}', 'storeComment')->name('cms.comment.post');
    Route::get('/cms/comment/delete/{id}', 'deleteComment')->name('cms.comment.delete');
    // Route::get('/blog/comment/edit/{id}', 'editComment')->name('comment.edit');
});
