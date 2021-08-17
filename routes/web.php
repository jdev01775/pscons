<?php

use Illuminate\Support\Facades\Route;
 
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

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::group(['middleware' => ['auth']], function() {
    // Route::get('/', function () {
    //     return view('main_menu/index');
    // });

    Route::get('/email', function () {
        return view('email.user_password');
    });

    Route::get('/', function () {
        return view('menu.home.index');
    });

    Route::get('/main_menu', function () {
        return view('menu.home.index');
    });

    Route::get('/home', function () {
        return view('menu.home.index');
    });

    Route::group(['prefix'=>'dashboard'],function(){
        Route::get('/',function(){
            return view('menu.dashboard.index');
        }) ;
    });

    Route::group(['prefix'=>'installment'],function(){
        Route::get('/',function(){
            return view('menu.installment.index');
        }) ;
    });

    Route::group(['prefix'=>'cut_over'],function(){
        Route::get('/',function(){
            return view('menu.cut_over.index');
        }) ;
    });

    Route::group(['prefix'=>'cut_off'],function(){
        Route::get('/',function(){
            return view('menu.cut_off.index');
        }) ;
    });

    Route::group(['prefix'=>'report'],function(){
        Route::get('/',function(){
            return view('menu.report.index');
        }) ;
    });

    Route::group(['prefix'=>'setting'],function(){
        Route::get('/', 'ProfileController@show');
     
        
        Route::resource('/setting_profile', 'ProfileController');
        Route::post('/setting_profile_update', 'ProfileController@update') ;

        Route::resource('/setting_user', 'UsersController');
        Route::get('/setting_table_user', 'UsersController@table_users') ;
        Route::post('/setting_user_update', 'UsersController@update') ;



        Route::resource('/setting_position', 'PositionController');
        Route::get('/setting_position_create', 'PositionController@index_permision') ;
        Route::get('/setting_position_data', 'PositionController@index_position') ;
        Route::post('/setting_position_store', 'PositionController@store') ;
        Route::get('/setting_position_edit', 'PositionController@index_position_edit') ;
        Route::post('/setting_position_clone', 'PositionController@position_clone') ;
      
        Route::resource('/setting_project', 'ProjectController');
        Route::get('/setting_project',function(){ return view('menu.setting.project.index'); }) ;
        Route::get('/setting_project_create', 'ProjectController@index') ;
        Route::post('/setting_project_store', 'ProjectController@store') ;
        Route::get('/setting_table_projects', 'ProjectController@table_projects') ;
        Route::get('/setting_project_edit', 'ProjectController@index_position_edit') ;
        Route::post('/setting_project_update', 'ProjectController@update') ;
        

        Route::resource('/setting_form', 'FormController');
        Route::get('/setting_form_table_list', 'FormController@table_list') ;




    });

});



Auth::routes();

// Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
