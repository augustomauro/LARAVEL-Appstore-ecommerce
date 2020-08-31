<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function(Request $request) {
  return $request->user();
});

// API: FOR BUY OR PLACE A NEW ORDER (JAVASCRIPT)
Route::post('/buy', 'OrdersController@store');
Route::delete('/buy', 'OrdersController@destroy');

// API: GET ALL APPLICATIONS
Route::get('/apps', function() {

  $applications = \App\Application::all();
  return response($applications);

  // $applications = \App\Application::all();
  // return response()->json($applications);
    
});

// API: FIND AN APPLICATION
Route::get('/apps/{id}', function($id) {
  
  if (\App\Application::where('id', $id)->exists()) {
      $application = \App\Application::where('id', $id)->get();
      return response($application);
    } else {
      return response()->json([
        "error" => "Not Found: Application ID not found"
      ], 404);
    }
    
});


