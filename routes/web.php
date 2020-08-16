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
        $router->get('/detail/{uuid_toko}',$version.'\TokoController@detail');
        $router->post('/create',$version.'\TokoController@create');
        $router->put('/update/{uuid_toko}',$version.'\TokoController@update');
        $router->delete('/delete/{uuid_toko}',$version.'\TokoController@delete');
    });

    $router->group(['prefix' => 'karyawan'],function() use($router, $version){
        $router->get('/',$version.'\KaryawanController@index');
        $router->get('/detail/{uuid_karyawan}',$version.'\KaryawanController@detail');
        $router->post('/create',$version.'\KaryawanController@create');
        $router->put('/update/{uuid_karyawan}',$version.'\KaryawanController@update');
        $router->delete('/delete/{uuid_karyawan}',$version.'\KaryawanController@delete');
    });

    $router->group(['prefix' => 'supplier'],function() use($router, $version){
        $router->get('/',$version.'\SupplierController@index');
        $router->get('/detail/{uuid_supplier}',$version.'\SupplierController@detail');
        $router->post('/create',$version.'\SupplierController@create');
        $router->put('/update/{uuid_supplier}',$version.'\SupplierController@update');
        $router->delete('/delete/{uuid_supplier}',$version.'\SupplierController@delete');
    });

    $router->group(['prefix' => 'kategori'],function() use($router, $version){
        $router->get('/',$version.'\KategoriController@index');
        $router->get('/detail/{uuid_kategori}',$version.'\KategoriController@detail');
        $router->post('/create',$version.'\KategoriController@create');
        $router->put('/update/{uuid_kategori}',$version.'\KategoriController@update');
        $router->delete('/delete/{uuid_kategori}',$version.'\KategoriController@delete');
    });

    $router->group(['prefix' => 'satuan'],function() use($router, $version){
        $router->get('/',$version.'\SatuanController@index');
        $router->get('/detail/{uuid_satuan}',$version.'\SatuanController@detail');
        $router->post('/create',$version.'\SatuanController@create');
        $router->put('/update/{uuid_satuan}',$version.'\SatuanController@update');
        $router->delete('/delete/{uuid_satuan}',$version.'\SatuanController@delete');
    });
});