<?php
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\ArticlesController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// ენებთან სამუშად
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){  
    Route::get('/', function () {
        return view('welcome');
    });
});
Route::resource('articles', ArticlesController::class);

// ავტორიზაცია და სისტემიდან გასვლა
Route::group(['middleware' => 'admin', 'prefix' => 'admin'], function () {
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLogin')->withoutMiddleware('admin')->name('ShowLogin');
        Route::post('/signin', 'login')->withoutMiddleware('admin')->name('AdminLogin');
        Route::get('/logout', 'logout')->name('AdminLogout');
    });

    // ადმინისტრატორის პანელის მთავარი გვერდი 
    Route::get('/', function () {
        return view('admin.index');
    })->name('AdminMainPage');
});


// ადმინისტრატორები
Route::resource('admins', AdminsController::class);

 // საკონტაქტო ინფორმაციის გვერდი
Route::resource('contacts', ContactsController::class, ['only' => ['edit','update']]);
Route::get('/contacts/cache', [ContactsController::class, 'cache'])->name('contacts.cache');

