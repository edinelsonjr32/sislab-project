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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);

    Route::resource('tipo_laboratorio', 'TipoLaboratorioController', ['except' => ['show']]);

    Route::resource('laboratorio', 'LaboratorioController', ['except' => ['show']]);

    Route::resource('tipo_solicitante', 'TipoSolicitanteController', ['except' => ['show']]);

    Route::resource('solicitante', 'SolicitanteController', ['except' => ['show']]);

    Route::resource('reserva', 'ReservaController',  ['except'=> ['show']]);

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);

    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);

    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    Route::get('reserva/laboratorio/{id}/hoje', 'ReservaController@laboratorioIndex')->name('reserva.laboratorio.index');

    Route::get('reserva/laboratorio/{id}/busca/mes', 'ReservaController@buscaMes')->name('reserva.busca.mes');

    Route::get('reserva/laboratorio/{id}/busca/semana', 'ReservaController@buscaSemana')->name('reserva.busca.semana');

    Route::get('reserva/laboratorio/{id}/busca/todos', 'ReservaController@buscaTodos')->name('reserva.busca.todos');

    Route::post('reserva/laboratorio/{id}/busca/data', 'ReservaController@buscaData')->name('reserva.busca.data');

    Route::get('reserva/laboratorio/{id}/criar/', 'ReservaController@create')->name('reserva.laboratorio.create');

});


