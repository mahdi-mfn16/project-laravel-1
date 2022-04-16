<?php

use App\Blog;
use App\Http\Middleware\CheckPrivilege;
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

Route::prefix('blogs')->middleware(['auth' , CheckPrivilege::class])->group(function(){
    Route::get('/' , 'BlogController@index')->name('index');
    Route::get('/admin' , 'BlogController@adminIndex')->name('admin-index')->withoutMiddleware(CheckPrivilege::class);
    Route::get('/create' , 'BlogController@create')->name('create-blog');
    Route::post('/create' , 'BlogController@store');
    Route::get('/edit/{blog}' , 'BlogController@edit')->name('edit-blog');
    Route::put('/edit/{blog}' , 'BlogController@update');
    Route::delete('/delete/{blog}' , 'BlogController@destroy')->name('delete-blog');
    
});
    
Route::post('images/delete' , 'ImageController@delete')->name('delete-image')
    ->middleware(['auth' , CheckPrivilege::class]);
    




