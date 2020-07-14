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
Route::get('/', function () {
    return view('welcome');
});

// authentication system

Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');

Route::get('preview', 'PeriodController@selectPeriod')->name('preview')->middleware('auth');

Route::post('setPeriodo', 'PeriodController@setPeriodo')->name('setPeriodo')->middleware('auth');

Route::group([
'namespace' => 'Admin',
'middleware' => 'auth'], function() {

    Route::resource('periodos', 'PeriodController');
    // períodos
    Route::get('periodos/{period}/create', 'ActivityController@create')->name('actividad.create');
    Route::post('periodos/{period}', 'ActivityController@store')->name('actividad.store');
    Route::get('periodos/{period_id}/{activity_id}/edit', 'ActivityController@edit')->name('actividad.edit');
    Route::put('periodos/{period_id}/{activity_id}', 'ActivityController@update')->name('actividad.update');
    
});

// from here goes to the admin view
Route::group([
'prefix' => 'admin',
'namespace' => 'Admin',
'middleware' => ['auth', 'period']
], function() {

    Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard');
    
    // grupos
    Route::resource('grupos', 'GroupController');
    Route::get('grupos/{grupo}/observar/{actividad}', 'GroupController@observar')->name('grupos.observar');

    Route::post('grupos/{grupo}/observar/{actividad}', 'GroupController@ya')->name('grupos.ya');

    Route::put('grupos/{grupo}/observar/{actividad}', 'GroupController@aprobar')->name('grupos.aprobar');

    Route::get('grupos/{grupo}/supervisar', 'GroupController@mostrar')->name('grupos.mostrar');

    // estudiantes

    Route::get('students/{id}', 'StudentController@getStudents')->name('students.getStudents');

    Route::post('students', 'StudentController@store')->name('students.store');

    Route::get('grupos/students/{student}', 'StudentController@getStudent')->name('students.getStudent');

    Route::put('grupos/students/{student}', 'StudentController@update')->name('students.update');

    Route::delete('grupos/students/{student}', 'StudentController@destroy')->name('students.destroy');



    // Route::resource('asesores', 'AdviserController');
    // Route::resource('estudiantes', 'StudentController');

});