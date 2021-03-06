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
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CompaniesController;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'FrontController@index')->name('front');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/companies/store', 'CompaniesController@store')->name('store');


Route::middleware(['auth'])->group(function (){
    Route::resource('companies','CompaniesController');
    Route::resource('projects','ProjectsController');
    Route::resource('roles','RolesController');
    Route::resource('tasks','TasksController');
    Route::resource('users','UsersController');
    Route::resource('comments','CommentsController');

    Route::get('/companiesAll', 'CompaniesController@indexAll')->name('companies.indexAll');
    Route::get('/projectsAll', 'ProjectsController@indexAll')->name('projects.indexAll');


    Route::post('/projects/addUser/{projectID?}', 'ProjectsController@addUser')->name('projects.addUser');

});

