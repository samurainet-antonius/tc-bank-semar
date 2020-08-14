<?php
$version='v1';
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


$router->group(['prefix' => 'public/api/'.$version],function() use($router,$version){

    $router->group(['prefix' => 'toko'],function() use($router,$version){
        $router->get('/',$version.'\TokoController@index');
        $router->post('/create',$version.'\TokoController@create');
        $router->put('/update/{uuid_toko}',$version.'\TokoController@update');
        $router->delete('/delete/{uuid_toko}',$version.'\TokoController@delete');
    });

    $router->group(['prefix' => 'karyawan'],function() use($router, $version){
        $router->get('/',$version.'\KaryawanController@index');
        $router->post('/create',$version.'\KaryawanController@create');
        $router->put('/update/{uuid_karyawan}',$version.'\KaryawanController@update');
        $router->delete('/delete/{uuid_karyawan}',$version.'\KaryawanController@delete');
    });
});