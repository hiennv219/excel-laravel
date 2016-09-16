<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('import',['as'=>'import', 'uses'=> 'ExcelController@getImport']);
// Route::post('import',['as'=>'import', 'uses'=> 'ExcelController@postImport']);


Route::get('importExport', 'MaatwebsiteDemoController@importExport');
Route::get('downloadExcel/{type}', 'MaatwebsiteDemoController@downloadExcel');
// Route::post('importExcel', 'MaatwebsiteDemoController@importExcel');
Route::post('importExcel', 'MaatwebsiteDemoController@getDataExcel');