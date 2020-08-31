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

Auth::routes();

// CATEGORIES
Route::get('/', 'CategoriesController@index')->name('home');
Route::get('/category/{id}', 'CategoriesController@show');

// WEBSITE SEARCH
Route::get('/search', 'WebsiteController@search')->name('search');

// APPLICATIONS
Route::get('/apps', 'ApplicationsController@index')->name('all_apps');
Route::get('/apps/ordered', 'ApplicationsController@ordered')->name('most_ordered');
Route::get('/apps/voted', 'ApplicationsController@voted')->name('most_voted');
Route::get('/apps/{id}', 'ApplicationsController@show');

// DEVELOPER|CLIENT - LIST OF APPLICATIONS
Route::group(['prefix' => 'me', 'middleware' => 'auth'], function() {
    
    // APPLICATIONS
    Route::get('/apps', 'ApplicationsController@userIndex');

    // APPLICATION VOTES
    Route::post('/vote', 'VotesController@store')->name('user_vote');
    Route::delete('/vote', 'VotesController@destroy')->name('user_vote');

    // WISHES
    // Route::get('/wishes', 'WishesController@index');
    Route::post('/wishes', 'WishesController@store')->name('user_wishes');   // Add to wishlist
    Route::delete('/wishes', 'WishesController@destroy')->name('user_wishes');	// Delete from wishlist

    // DEVELOPER - APPLICATIONS R/C/M
    Route::group(['middleware' => 'developer'], function() {

        // APPLICATIONS R/C/M
        Route::get('/apps/add', 'ApplicationsController@create');	// Create a new application
        Route::post('/apps', 'ApplicationsController@store');	// Save a new application
        Route::get('/apps/{id}/edit', 'ApplicationsController@edit');	// Edit an application
        Route::patch('/apps/{id}', 'ApplicationsController@update')->where(['id' => '[\d]+']);	// Update an application, where 'id' is an Integer
        Route::delete('/apps/{id}', 'ApplicationsController@destroy');	// Delete an application

    });
});

