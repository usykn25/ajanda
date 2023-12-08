<?php
/*************************************************
 * Titan-2 Mini Framework
 * Routes
 *
 * Author 	: Turan Karatuğ
 * Web 		: http://www.titanphp.com
 * Docs 	: http://kilavuz.titanphp.com
 * Github	: http://github.com/tkaratug/titan2
 * License	: MIT
 *
 *************************************************/
use System\Libs\Router\Router as Route;

Route::set404(function(){
	header('HTTP/1.1 404 Not Found');
	View::render('errors.404');
});

Route::namespace('frontend')->group(function(){
    Route::get('/', 'Home@index')->name('homePage');
});


// Admin Panel Router Start //
Route::prefix('admin-panel')->namespace('backend')->group(function(){
    // No Middleware
    // Login operations
    Route::get('/giris-yap', 'Auth@login')->name('adminLogin');
    Route::post('/giris-yap', 'Auth@loginPost')->name('adminLoginPost');
});
Route::prefix('admin-panel')->namespace('backend')->middleware(['Auth'])->group(function(){
    // Dashboard
    Route::get('/', 'Dashboard@index')->name('adminHome');
    //Logout
    Route::get('/cikis-yap', 'Auth@logout')->name('adminLogout');
});
// Admin Panel Router Finish //
