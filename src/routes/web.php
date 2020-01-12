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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/esilan', 'EsilanController@index');
Route::get('/esilan/{id}', 'EsilanController@show');

Route::get('/faq', 'FAQController@show');

Route::middleware(['auth'])->group(function(){
    Route::get('profile', 'EsilanController@index')->name('profile');
    Route::get('/esilan/{idEsilan}/buyPlace/{ticketTypeName}', 'TicketController@buyPlace')
    ->name('buyPlace');
    Route::get('/esilan/{idEsilan}/editPlace/{ticketTypeName}', 'TicketController@editPlace')
    ->name('editPlace');
    Route::get('/esilan/{idEsilan}/deletePlace/{ticketTypeName}', 'TicketController@deletePlace')
    ->name('deletePlace');
    Route::post('/commande', 'TicketController@validateCommand');
});


Route::middleware(['admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        // /admin/
        Route::get('/', 'AdminController@dashboard')->name('admin');

        Route::prefix('esilan')->group(function () {
            Route::get('/', 'AdminController@esilanDisplay');
            Route::post('/', 'AdminController@esilanAddOrUpdate');
            Route::get('/{id}', 'AdminController@esilanShow');
        });

        Route::prefix('sales')->group(function () {
            Route::get('/', 'AdminController@ticketDisplay');
        });

        Route::prefix('games')->group(function () {
            Route::get('/', 'AdminController@gamesDisplay');
            Route::post('/', 'AdminController@gameAddOrUpdate');
            Route::get('/{id}', 'AdminController@gameShow');
        });

        Route::prefix('tournaments')->group(function () {
            Route::get('/', 'AdminController@tournamentsDisplay');
            Route::post('/', 'AdminController@tournamentAddOrUpdate');
            Route::get('/{id}', 'AdminController@tournamentShow');
        });

        Route::prefix('gamers')->group(function () {
            Route::get('/', 'AdminController@gamersDisplay');
            Route::post('/', 'AdminController@gamerUpdate');
            Route::get('/{id}', 'AdminController@gamersShow');
        });

        Route::prefix('faq')->group(function () {
            Route::get('/', 'AdminController@faqShow');
            Route::post('/', 'AdminController@faqUpdate');
        });

        // AJAX
        Route::prefix('ajax')->group(function () {
            Route::middleware(['ajax'])->group(function() {
                Route::get('/ticketValidation', 'AdminController@ajaxTicketValidation');
                // /admin/CompatibilityTypeTournament/enable
                Route::prefix('compatibilityTypeTournament')->group(function () {
                    Route::get('/enable', 'AdminController@typeTourCompatEnable');
                    Route::get('/disable', 'AdminController@typeTourCompatDisable');
                });

                Route::get('/esilan/imgName', 'AdminController@ajaxEsilanImgName');
                Route::get('/games/imgName', 'AdminController@ajaxGameImgName');

            });
        });
    });


});