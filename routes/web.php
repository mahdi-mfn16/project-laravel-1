<?php


use App\Http\Middleware\CheckAdmin;
use App\Http\Middleware\CheckUser;
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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin', 'HomeController@admin')->name('admin-dashboard')->middleware(['auth' , CheckAdmin::class]);;

Route::prefix('blogs')->middleware(['auth' , CheckUser::class])->group(function(){
    Route::get('/' , 'User\BlogController@index')->name('index');
    Route::get('/create' , 'User\BlogController@create')->name('create-blog');
    Route::post('/create' , 'User\BlogController@store');
    Route::get('/edit/{blog}' , 'User\BlogController@edit')->name('edit-blog');
    Route::put('/edit/{blog}' , 'User\BlogController@update');
    Route::delete('/delete/{blog}' , 'User\BlogController@destroy')->name('delete-blog');
    
});

Route::prefix('admin/blogs')->middleware(['auth' , CheckAdmin::class])->group(function(){
    Route::get('/' , 'Admin\BlogController@index')->name('admin-index');
    Route::get('/edit/{blog}' , 'Admin\BlogController@edit')->name('admin-edit-blog');
    Route::put('/edit/{blog}' , 'Admin\BlogController@update');
    Route::delete('/delete/{blog}' , 'Admin\BlogController@destroy')->name('admin-delete-blog');   
});
    
Route::post('images/delete' , 'User\ImageController@delete')->name('delete-image')
    ->middleware(['auth']);
    

Route::prefix('admin/users')->middleware(['auth' , CheckAdmin::class])->group(function(){
        Route::get('/' , 'Admin\UserController@index')->name('index-user');
        Route::get('/create' , 'Admin\UserController@create')->name('create-user');
        Route::post('/create' , 'Admin\UserController@store');
        Route::get('/edit/{user}' , 'Admin\UserController@edit')->name('edit-user');
        Route::put('/edit/{user}' , 'Admin\UserController@update');
        Route::delete('/delete/{user}' , 'Admin\UserController@destroy')->name('delete-user');
});

Route::prefix('admin/admins')->middleware(['auth' , CheckAdmin::class])->group(function(){
    Route::get('/' , 'Admin\AdminController@index')->name('index-admin');
    Route::get('/create' , 'Admin\AdminController@create')->name('create-admin');
    Route::post('/create' , 'Admin\AdminController@store');
    Route::get('/edit/{admin}' , 'Admin\AdminController@edit')->name('edit-admin');
    Route::put('/edit/{admin}' , 'Admin\AdminController@update');
    Route::delete('/delete/{admin}' , 'Admin\AdminController@destroy')->name('delete-admin');
});



