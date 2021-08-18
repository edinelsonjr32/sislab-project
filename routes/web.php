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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', 'HomeController@index')->name('home');




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

    Route::resource('tipo_equipamento', 'TipoEquipamentoController', ['except' => ['show']]);

    Route::resource('item_equipamento', 'ItemEquipamentoController', ['except' => ['show']]);


    Route::resource('equipamento', 'EquipamentoController', ['except' => ['show']]);

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


    Route::get('reserva/laboratorio/{id}/detalhe/', 'ReservaController@show')->name('reserva.laboratorio.detalhe');
    Route::get('reserva/laboratorio/{id}/alterar_status/', 'ReservaController@alterarStatus')->name('reserva.laboratorio.alterar.status');

    Route::post('reserva/laboratorio/relatorio/', 'ReservaController@relatorio')->name('reserva.laboratorio.relatorio');

    Route::get('reserva/laboratorio/{id}/adicionar_equipamento/', 'ReservaController@adicionarEquipamento')->name('reserva.laboratorio.adicionar.equipamento');

    Route::post('reserva/laboratorio/adicionar_equipamento/', 'ReservaController@salvarEquipamentoReserva')->name('reserva.laboratorio.salva.reserva.equipamento');
    Route::delete('reserva/laboratorio/remover_equipamento/{id}', 'ReservaController@destroyReservaEquipamento')->name('reserva.laboratorio.destroy.reserva.equipamento');



    /**Rotas Dashboard */

    Route::post('home/reserva/busca/data', 'HomeController@buscaData')->name('dashboard.reserva.busca.data');

    Route::get('home/reserva/busca/mes', 'HomeController@buscaMes')->name('dashboard.reserva.busca.mes');

    Route::get('home/reserva/busca/semana', 'HomeController@buscaSemana')->name('dashboard.reserva.busca.semana');

    Route::get('home/reserva/busca/todos', 'HomeController@buscaTodos')->name('dashboard.reserva.busca.todos');

    Route::get('home/reserva/criar/', 'HomeController@create')->name('dashboard.reserva.create');

    Route::post('home/reserva/salvar', 'HomeController@store')->name('dashboard.reserva.salvar');

    Route::get('home/reserva/{id}/alterar_status/', 'HomeController@alterarStatus')->name('dashboard.reserva.alterar.status');

});


