<?php

use Illuminate\Support\Facades\Route;

//Route::get('gitamic/status', 'GitamicApiController@status')->name('gitamic.status');

Route::group(['prefix' => 'git-sync/api'], function () {
    //Route::post('init', 'GitamicApiController@init')->name('git-sync.init');
    Route::get('status', 'GitSyncController@status')->name('git-sync.status');
    // Route::post('commit', 'GitamicApiController@commit');
    // Route::post('push', 'GitamicApiController@push');
    // Route::post('pull', 'GitamicApiController@pull');
    //Route::get('actions/{type}', 'GitamicApiController@actions');
    //Route::post('actions/{type}/list', 'GitamicApiController@actions');
    //Route::post('actions/{type}', 'GitamicApiController@doAction');
});
