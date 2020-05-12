<?php

Route::middleware(['auth:' . config('admin-auth.defaults.guard')])->group(static function () {
    Route::namespace('Savannabits\Media\Http\Controllers')->group(static function () {
        Route::post('upload', 'FileUploadController@upload')->name('savannabits/media::upload');
        Route::get('view', 'FileViewController@view')->name('savannabits/media::view');
    });
});
