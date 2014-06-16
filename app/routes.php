<?php

/*
|--------------------------------------------------------------------------
| Rutas de Login/Logout
|--------------------------------------------------------------------------
|
| Rutas que permiten realizar el inicio y cierre de sesión
|
*/
Route::get('login', 'AuthController@showLogin');
Route::post('login', array('before' => 'csrf', 'uses' => 'AuthController@postLogin'));

/*
|--------------------------------------------------------------------------
| Rutas de Generale de Sitio
|--------------------------------------------------------------------------
|
| Rutas generales, todas con filtro de autenticacion, y otras generales 
| que piden filtros de autorizacion de contenido
|
*/
Route::group(array('before' => 'auth'), function(){
	//Administrador
	Route::get('/admin/empleados', 'AdminController@getEmpleados');
	Route::get('/admin/centros', 'AdminController@getCentros');
	Route::get('/admin',function(){
		return Redirect::to('/admin/empleados');
	});
	Route::post('/admin/empleados/add','AdminController@addEmployed');
	Route::post('/admin/empleados/refresh','AdminController@refreshEmployed');
	Route::post('/admin/empleados/enabled','AdminController@enabledEmployed');
	Route::post('/admin/empleados/disabled','AdminController@disabledEmployed');
	
	Route::post('/admin/centros/add','AdminController@addCenter');
	Route::post('/admin/centros/refresh','AdminController@refreshCenter');
	Route::post('/admin/centros/enabled','AdminController@enabledCenter');
	Route::post('/admin/centros/disabled','AdminController@disabledCenter');

	//Rutas Varias
	Route::get('/', 'SiteController@getDashboard');
	Route::get('/perfil','ProfileController@getProfile');
	Route::get('logout', 'AuthController@logOut');
});

/*
|--------------------------------------------------------------------------
| Rutas con filtros de Acceso
|--------------------------------------------------------------------------
|
| Estas rutas se verifica primero que el usuario quien se logeo tenga
| prmisos para poder ver la ruta que esta solicitando
|
*/
Route::when('/','access');
Route::when('admin','access:/admin');
Route::when('admin/*','access:/admin');
Route::when('asistencia','access:/asistencia');
Route::when('asistencia/*','access:/asistencia');
Route::when('adelantos','access:/adelantos');
Route::when('adelantos/*','access:/adelantos');