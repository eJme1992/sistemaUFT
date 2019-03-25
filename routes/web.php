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
    return view('auth.login');
});
Route::resource('home', 'CuentasController')->middleware('auth');
Route::resource('user', 'UserController')->middleware('auth');
// ruta con parametro
/*Route::get('/coño/{name}/{apellido?}', function ($name,$apellido=null) {
    return $name." ".$apellido;
});*/
//Ruta completa


Route::resource('usuarios', 'UsuariossController')->middleware('auth');

Route::resource('cuentas', 'CuentasController')->middleware('auth');
Route::post('cuentas/baja', 'CuentasController@baja')->middleware('auth');
Route::post('cuentas/cargar', 'CuentasController@cargar_datos_cuentas')->middleware('auth');
Route::resource('software', 'SoftwareController')->middleware('auth');
Route::post('software/baja', 'SoftwareController@baja')->middleware('auth');
Route::resource('contactos', 'ContactosController')->middleware('auth');
Route::get('contactos/create/{id}', 'ContactosController@create')->middleware('auth');
Route::get('contactos/edit/{slug}/{id}', 'ContactosController@edit')->middleware('auth');
Route::get('contactos/destroy/{id}/{slug}', 'ContactosController@destroy')->middleware('auth');
Route::resource('hosts', 'HostsController')->middleware('auth');
Route::get('hosts/create/{id}', 'HostsController@create')->middleware('auth');
Route::get('hosts/edit/{slug}/{id}', 'HostsController@edit')->middleware('auth');
Route::get('hosts/destroy/{id}/{slug}', 'HostsController@destroy')->middleware('auth');
Route::resource('webs', 'WebsController')->middleware('auth');
Route::get('webs/create/{id}', 'WebsController@create')->middleware('auth');
Route::get('webs/edit/{slug}/{id}', 'WebsController@edit')->middleware('auth');
Route::get('webs/destroy/{id}/{slug}', 'WebsController@destroy')->middleware('auth');
Route::resource('ftps', 'FtpsController')->middleware('auth');
Route::get('ftps/create/{id}', 'FtpsController@create')->middleware('auth');
Route::get('ftps/edit/{slug}/{id}', 'FtpsController@edit')->middleware('auth');
Route::get('ftps/destroy/{id}/{slug}', 'FtpsController@destroy')->middleware('auth');
Route::resource('mails', 'MailsController')->middleware('auth');
Route::get('mails/create/{id}', 'MailsController@create')->middleware('auth');
Route::get('mails/edit/{slug}/{id}', 'MailsController@edit')->middleware('auth');
Route::get('mails/destroy/{id}/{slug}', 'MailsController@destroy')->middleware('auth');
Route::resource('dbs', 'DbsController')->middleware('auth');
Route::get('dbs/create/{id}', 'DbsController@create')->middleware('auth');
Route::get('dbs/edit/{slug}/{id}', 'DbsController@edit')->middleware('auth');
Route::get('dbs/destroy/{id}/{slug}', 'DbsController@destroy')->middleware('auth');
Route::resource('sociales', 'SocialesController')->middleware('auth');
Route::get('sociales/create/{id}', 'SocialesController@create')->middleware('auth');
Route::get('sociales/edit/{slug}/{id}', 'SocialesController@edit')->middleware('auth');
Route::get('sociales/destroy/{id}/{slug}', 'SocialesController@destroy')->middleware('auth');
Route::resource('crms', 'CrmsController')->middleware('auth');
Route::get('crms/create/{id}', 'CrmsController@create')->middleware('auth');
Route::get('crms/mails/{id}', 'CrmsController@mails')->middleware('auth');
Route::get('crms/edit/{slug}/{id}', 'CrmsController@edit')->middleware('auth');
Route::get('crms/destroy/{id}/{slug}', 'CrmsController@destroy')->middleware('auth');
Route::get('importar', 'ImportarController@index')->middleware('auth');
Auth::routes();
