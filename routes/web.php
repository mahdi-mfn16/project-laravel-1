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

Route::prefix('blogs')->middleware(['auth' , CheckUser::class])->group(function(){
    Route::get('/' , 'User\BlogController@index')->name('index');
    Route::get('/create' , 'User\BlogController@create')->name('create-blog');
    Route::post('/create' , 'User\BlogController@store');
    Route::get('/edit/{blog}' , 'User\BlogController@edit')->name('edit-blog');
    Route::put('/edit/{blog}' , 'User\BlogController@update');
    Route::delete('/delete/{blog}' , 'User\BlogController@destroy')->name('delete-blog');
    
});

Route::prefix('blogs')->middleware(['auth' , CheckAdmin::class])->group(function(){
    Route::get('/admin' , 'Admin\BlogController@index')->name('admin-index');   
});
    
Route::post('images/delete' , 'User\ImageController@delete')->name('delete-image')
    ->middleware(['auth' , CheckUser::class]);
    




