<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Home routes
Route::get('/', [
		'uses'	=>	'HomeController@home',
		'as'	=>	'home']);

Route::get('/home', [
		'uses'	=>	'HomeController@home',
		'as'	=>	'home']);

//Registrar cuenta
Route::get('auth/register', [
		'uses'	=>	'Auth\AuthController@getRegister',
		'as'	=>	'users.register']);

Route::post('auth/register', [
		'uses'	=>	'Auth\AuthController@postRegister',
		'as'	=>	'users.register']);

//Confirmar cuenta
Route::get('auth/confirm/email/{email}/confirm_token/{confirm_token}', [
		'uses'	=>	'Auth\AuthController@confirmRegister',
		'as'	=>	'users.confirm']);

//Iniciar sesion
Route::get('/auth/login', [
		'uses'	=>	'Auth\AuthController@getLogin',
		'as'	=>	'users.login']);

Route::post('/auth/login', [
		'uses'	=>	'Auth\AuthController@postLogin',
		'as'	=>	'users.login']);

//Cerrar sesion
Route::get('/auth/logout', [
		'uses'	=>	'Auth\AuthController@getLogout',
		'as'	=>	'users.logout']);

//Enviar correo de reset password
Route::get('/password/email', [
		'uses'	=>	'Auth\PasswordController@getEmail',
		'as'	=>	'users.password.email']);

Route::post('/password/email', [
		'uses'	=>	'Auth\PasswordController@postEmail',
		'as'	=>	'users.password.email']);

//Cambiar contraseña
Route::get('/password/reset/{token}', [
		'uses'	=>	'Auth\PasswordController@getReset',
		'as'	=>	'users.password.reset']);

Route::post('/password/reset', [
		'uses'	=>	'Auth\PasswordController@postReset',
		'as'	=>	'users.password.reset']);

//Panel de usuario
Route::get('user', [
		'uses'	=>	'UserController@user',
		'as'	=>	'users.panel']);

Route::get('user/profile', [
		'uses'	=>	'UserController@profile',
		'as'	=>	'users.edit.profile']);

Route::post('user/update', [
		'uses'	=>	'UserController@updateProfile',
		'as'	=>	'users.update.profile']);

Route::get('user/password', [
		'uses'	=>	'UserController@password',
		'as'	=>	'users.edit.password']);

Route::post('user/updatepassword', [
		'uses'	=>	'UserController@updatePassword',
		'as'	=>	'users.update.password']);

//Summoner Routes
Route::get('/{region}/{summonerName}', [
		'uses'	=>	'SummonersController@show',
		'as'	=>	'summoners.show']);

//Comment Routes
Route::post('comment/add', [
		'uses'	=>	'CommentController@store',
		'as'	=>	'comments.store']);

Route::post('comment/delete/{id}',[
		'uses'	=>	'CommentController@destroy',
		'as'	=>	'comments.destroy']);