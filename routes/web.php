<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

Auth::routes();

Route::get('/', [App\Http\Controllers\PhotoController::class, 'index'])->name('home');
Route::get('/addPhotos', [App\Http\Controllers\PhotoController::class, 'addPhotos'])->name('addPhotos');
Route::post('/storePhotos', [App\Http\Controllers\PhotoController::class, 'storePhotos'])->name('storePhotos');
Route::post('/deletePhoto/{photoId}', [App\Http\Controllers\PhotoController::class, 'deletePhoto'])->name('deletePhoto');
Route::get('/photos', [App\Http\Controllers\PhotoController::class, 'showAllPhotos'])->name('photos');
Route::get('/reviewPhoto/{photoId}', [App\Http\Controllers\PhotoController::class, 'showSinglePhoto'])->name('reviewPhoto');

Route::post('/storeComment/{photoId}', [App\Http\Controllers\PhotoController::class, 'storeComment'])->name('storeComment');
Route::get('/showUsers', [App\Http\Controllers\UserController::class, 'showUsers'])->name('showUsers');

Route::get('contact', [App\Http\Controllers\ContactController::class, 'showContact'])->name('contactUs');
Route::post('storeContact', [App\Http\Controllers\ContactController::class, 'storeContact'])->name('storeContact');

Route::get('/showUserProfile', [App\Http\Controllers\UserController::class, 'showUserProfile'])->name('profile');
Route::post('editProfile', [App\Http\Controllers\UserController::class, 'updateUserData'])->name('editProfile');

Route::get('/getStatistics', [App\Http\Controllers\AdminController::class, 'getStatistics'])->name('statistics');

Route::post('/deleteComment/{commentId}', [App\Http\Controllers\PhotoController::class, 'deleteComment'])->name('deleteComment');

Route::get('/userPhotos/{userId}', [App\Http\Controllers\AdminController::class, 'getAllPhotoByUser'])->name('userPhotos');

