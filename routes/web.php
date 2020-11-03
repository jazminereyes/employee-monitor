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

Route::get('/', ['middleware' => 'guest', function () {
    return view('auth.login');
}]);

Route::get('/register/company', function(){
    return view('auth.company-register');
});

Route::get('/success', function(){
    return view('layouts.success');
});

Auth::routes();

Route::put('/createrecord', 'MonitoringRecordController@store')->name('store');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@admin')->name('admin.home')->middleware('is_admin');
Route::get('manager/home', 'HomeController@manager')->name('manager.home');
Route::resource('/company', 'CompanyController');
Route::get('/users/{id}/record/{year}/{month}/{day}', 'UserController@show_record')->name('users.record');
Route::resource('/users', 'UserController');
Route::resource('/record', 'MonitoringRecordController');
Route::put('/profile', 'HomeController@profile')->name('profile');
Route::put('/setting', 'HomeController@setting')->name('setting')->middleware('is_admin');
/*Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('public/' . $filename);
    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
});*/
/*
Route::get('storage/app/public/monitoring_uploads/{filename}', function ($filename)
{
    return Image::make(storage_path('public/' . $filename))->response();
});*/