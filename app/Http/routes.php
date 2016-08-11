<?php


Route::group(['prefix'=>'api', 'middleware' => ['api'], 'namespace' => '\API'], function() {
    Route::get('convert/{integer}', 'ApiController@convert');
    Route::get('recent', 'ApiController@recent');
    Route::get('top10', 'ApiController@top10');
});