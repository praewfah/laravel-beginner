<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

use App\Task;
use Illuminate\Http\Request;

Route::group(['middleware' => ['web']], function () {

    Route::get('/', 'Auth\AuthController@getLogin')->middleware('guest');

    Route::get('/budgets', 'BudgetController@index');
    Route::post('/search_budget', 'BudgetController@filters');
    Route::post('/budget', 'BudgetController@store');
    Route::post('/budget/delete', 'BudgetController@destroy');

    Route::get('/transections', 'TransectionController@index');
    Route::post('/search_transection', 'TransectionController@filters');
    Route::post('/transection', 'TransectionController@store');
    Route::delete('/transection/{transection}', 'TransectionController@destroy');

    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');

    Route::auth();

});
    
