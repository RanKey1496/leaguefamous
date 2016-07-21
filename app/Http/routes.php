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
Route::get('/register', [
		'uses'	=>	'Auth\AuthController@getRegister',
		'as'	=>	'users.register']);

Route::post('/register', [
		'uses'	=>	'Auth\AuthController@postRegister',
		'as'	=>	'users.register']);

//Confirmar cuenta
Route::get('/confirm/email/{email}/confirm_token/{confirm_token}', [
		'uses'	=>	'Auth\AuthController@confirmRegister',
		'as'	=>	'users.confirm']);

//Iniciar sesion
Route::get('/login', [
		'uses'	=>	'Auth\AuthController@getLogin',
		'as'	=>	'users.login']);

Route::post('/login', [
		'uses'	=>	'Auth\AuthController@postLogin',
		'as'	=>	'users.login']);

//Cerrar sesion
Route::get('/logout', [
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

//Configuración de la cuenta
Route::get('settings', [
	'uses'	=>	'UserController@settings',
	'as'	=>	'users.settings']);

//Configuración de la cuenta2
Route::get('testsettings', [
	'uses'	=>	'UserController@testsettings',
	'as'	=>	'users.testsettings']);

//Perfil del usuario
Route::get('user/profile', [
		'uses'	=>	'UserController@profile',
		'as'	=>	'users.edit.profile']);

//Enviar foto de perfil
Route::post('user/update', [
		'uses'	=>	'UserController@updateProfile',
		'as'	=>	'users.update.profile']);

//Enviar foto de perfil2
Route::post('user/updateAvatar', [
		'uses'	=>	'UserController@updateAvatar',
		'as'	=>	'users.update.avatar']);

//Página para cambiar password
Route::get('user/password', [
		'uses'	=>	'UserController@password',
		'as'	=>	'users.edit.password']);

//Cambiar password
Route::post('user/updatepassword', [
		'uses'	=>	'UserController@updatePassword',
		'as'	=>	'users.update.password']);

//Summoner Routes
Route::get('/{region}/{summonerName}', [
		'uses'	=>	'SummonersController@show',
		'as'	=>	'summoners.show']);

Route::get('/search/summoner/{name}', [
		'uses'	=>	'SearchController@index',
		'as'	=>	'summoners.search']);

Route::get('/all', [
		'uses'	=>	'SearchController@all',
		'as'	=>	'summoners.all']);

Route::post('executeSearch', [
		'uses' => 'SearchController@search', 
		'as'	=> 'executeSearch']);

Route::get('search', function(){
	return View('search');
});

//Comment Routes
Route::post('comment/add', [
		'uses'	=>	'CommentController@store',
		'as'	=>	'comments.store']);

Route::post('commentReply/add', [
		'uses'	=>	'CommentController@storeReply',
		'as'	=>	'comments.storeReply']);

Route::post('delete', [
		'uses'	=>	'CommentController@destroy',
		'as'	=>	'comments.destroy']);

Route::get('/comment/search/{commentId}', [
		'uses'	=>	'CommentController@index',
		'as'	=>	'comments.index']);

//Like Routes
Route::post('/like', [
	'uses' => 'LikeController@like', 
	'as' => 'summoners.like']);