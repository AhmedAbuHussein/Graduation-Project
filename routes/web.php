<?php

use App\Models\Notification;

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
Route::post('/modify','HomeController@modifyusersave');

Route::get('/profile','HomeController@profile');

Route::get('/edit','HomeController@editDatastore');
Route::Post('/edit','HomeController@editDatastoresave');

Route::get('/details/{id}','HomeController@details');

Route::get('/additem','HomeController@additem');
Route::post('/additem','HomeController@insertitem');
Route::get('/checkaddperm','AjaxController@checkaddperm');



Route::get('/pdf','PDFController@index');

Route::get('/writer','NotificationController@writeredit');
Route::get('/cancalEdit','NotificationController@cancalEdit');
Route::get('/saveEdit','NotificationController@saveEdit');
Route::get('/readed','NotificationController@notReaded');

Route::get('/covenant-owner','EmployeeController@index');
Route::get('/covenant-owner/{id}','EmployeeController@covenantowner');
Route::get('/make-covenant','CovenantController@makeCovenant');
Route::get('/check-quantity','CovenantController@checkquantity');
Route::get('/check-permision','CovenantController@checkpermision');
Route::post('/new-employee','CovenantController@insertEmp');
Route::post('/new-covenant','CovenantController@insertCov');
Route::get('/detailscov','CovenantController@detailscov');


Route::get('/chartAjax','AjaxController@chartAjax');
Route::get('/chartdoughnut','AjaxController@chartdoughnut');
Route::get('/detailsItem','AjaxController@detailsItem');

Route::get('/stores','AjaxController@stores');
Route::get('/user','AjaxController@users');
Route::post('/deleteuser/{id}','AjaxController@deleteuser');
Route::get('/mainchart','AjaxController@mainChart');
Route::get('/itemsname','AjaxController@itemsname');
Route::get('/get-emps','AjaxController@employees');
Route::get('/checkQuantity','AjaxController@checkQuantity');
Route::post('/progress','ChartController@getprogress');
Route::post('/notification/get','NotificationController@get');
Route::get('/owner-covenants','EmployeeController@covenantsData');
/****************************************************************************************/

Route::get('/test','HomeController@quentity');
Route::get('/testt','CovenantController@totalQuantity');
