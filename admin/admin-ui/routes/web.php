<?php

Route::middleware(['web', 'admin'])->group(function () {
    Route::namespace('Savannabits\AdminUI\Http\Controllers')->group(function () {
        Route::post('/admin/wysiwyg-media','WysiwygMediaUploadController@upload')->name('savannabits/admin-ui::wysiwyg-upload');
    });
});
