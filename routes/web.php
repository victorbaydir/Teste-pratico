<?php

use App\Http\Controllers\VeiculosController;
use App\Mail\CreateVeiculoMail;

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

Route::group(['prefix'=>'admin', 'as'=>'admin.'], function () {
    //Authentication Rotes
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    //Password Reset
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::get('/home', 'HomeController@index')->name('home');
});

/** Rotas Veiculos */
Route::get('veiculos', 'VeiculosController@index')->name('veiculos.index')->middleware(   'auth');
Route::get('veiculos/create', 'VeiculosController@create')->name('veiculos.create')->middleware(   'auth','permission.admin');
Route::post('veiculos', 'VeiculosController@store')->name('veiculos.store')->middleware(   'auth','permission.admin');
Route::get('veiculos/{veiculo}', 'VeiculosController@show')->name('veiculos.show')->middleware(   'auth');
Route::get('veiculos/{veiculo}/veiculos', 'VeiculosController@edit')->name('veiculos.edit')->middleware(   'auth','permission.admin');
Route::put('veiculos/{veiculo}', 'VeiculosController@update')->name('veiculos.update')->middleware(   'auth','permission.admin');
Route::delete('veiculos/{veiculo}', 'VeiculosController@destroy')->name('veiculos.destroy')->middleware(   'auth','permission.admin');
