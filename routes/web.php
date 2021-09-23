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

Route::post('/login','AuthController@postLogin')->name('postLogin');
Route::get('/logout','AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth','checkRole:1,2'],'prefix' => 'dashboard'], function(){
    Route::get('/','HomeController@index')->name('index');

    Route::group(['prefix'=>'sto'],function(){
        Route::get('/','StoController@getSTO')->name('getSTO');
        Route::post('/','StoController@storeSTO')->name('storeSTO');
        Route::patch('/','StoController@updateSTO')->name('updateSTO');
        Route::get('/delete/{id}','StoController@deleteSTO')->name('deleteSTO');
        // Route::get('/{id}','StoController@testSto')->name('testSto');


        Route::group(['prefix'=>'olt'],function(){
            Route::get('/{sto_id}','OltController@getOlt')->name('getOlt');
            Route::post('/{sto_id}','OltController@storeOlt')->name('storeOlt');
            Route::patch('/{sto_id}','OltController@updateOlt')->name('updateOlt');
        });

        Route::group(['prefix'=>'ftm'],function(){
            Route::get('/{sto_id}','FtmOaController@getFtmOa')->name('getFtmOa');
            Route::post('/{sto_id}','FtmOaController@storeFtmOa')->name('storeFtmOa');
            Route::patch('/{sto_id}','FtmOaController@updateFtmOa')->name('updateFtmOa');


            Route::group(['prefix'=>'panel'],function(){
                Route::get('/{sto_id}/{ftm_oa_id}','PanelFtmOaController@getPanelFtmOa')->name('getPanelFtmOa');
            });

        });

    });

    Route::group(['prefix'=>'olt'],function(){
        Route::get('/','OltController@getAllOLT')->name('getAllOlt');
    });

    Route::group(['prefix'=>'feeder'],function(){
        Route::get('/','FeederController@getFeeder')->name('getFeeder');
        Route::get('/{sto_id}','FeederController@getFeederFiltered')->name('getFeederFiltered');
        Route::get('/{sto_id}/{feeder_id}','FeederController@showFeeder')->name('showFeeder');
        Route::get('/{feeder_id}/odc/{odc_id}','FeederController@showFeederFiltered')->name('showFeederFiltered');
        Route::post('/','FeederController@storeFeeder')->name('storeFeeder');
        Route::patch('/','FeederController@updateFeeder')->name('updateFeeder');
        Route::get('/delete/{id}','FeederController@deleteFeeder')->name('deleteFeeder');

    });

    Route::group(['prefix'=>'odc'],function(){
        Route::get('/','OdcController@getOdc')->name('getOdc');
        Route::post('/','OdcController@storeOdc')->name('storeOdc');
        Route::patch('/','OdcController@updateOdc')->name('updateOdc');
        Route::get('/delete/{id}','OdcController@deleteOdc')->name('deleteOdc');
        Route::get('/{id}/cores','OdcController@showOdc')->name('showOdc');

        Route::post('/assign-core','OdcController@assignCore')->name('assignCore');

        Route::post('/core/assign-to-odp','OdcController@assignOdp')->name('assignOdp');
    });

    Route::get('/slot-olt/{olt_id}','OltController@getSlotOlt');

    // Route::get('/test/{id}','OdcController@showOdc')->name('test');
});
