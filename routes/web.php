<?php

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

Auth::routes();

/*************************** Dashboard ***************************/ 
Route::get('/dashboard', 'HomeController@index')->name('home');
Route::get('/users', 'HomeController@users')->name('users');
Route::get('/store', 'HomeController@store')->name('store');
Route::get('/covenant', 'HomeController@covenant')->name('covenant');
Route::get('/chart', 'ChartController@chart')->name('chart');
Route::get('/modify','HomeController@modifyuser');
Route::get('/profile','HomeController@profile');
Route::get('/edit','HomeController@editDatastore');
Route::get('/details/{id}','HomeController@details');
Route::get('/additem','HomeController@additem');
Route::post('/additem','HomeController@insertitem');


Route::get('/detailsItem','AjaxController@detailsItem');
Route::get('/stores','AjaxController@stores');
Route::get('/user','AjaxController@users');
Route::post('/deleteuser/{id}','AjaxController@deleteuser');
Route::get('/mainchart','AjaxController@mainChart');
Route::get('/itemsname','AjaxController@itemsname');
/****************************************************************************************/

Route::post('/edit','HomeController@saveDataChange');
Route::get('/pdf','PDFController@index');
Route::get('/manage','HomeController@magagenotify');
Route::post('/editaction','HomeController@editaction');
Route::get('/profile','HomeController@profile');

/*******************************Ajax controller**********************/
Route::post('/user', 'AjaxController@user');
Route::post('/store','AjaxController@datastorenotify');
Route::post('/storetype','AjaxController@storetype');
Route::get('/notification','AjaxController@notifyheader');

/******************************************************************/
