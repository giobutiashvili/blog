<?php
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\ArticlesController;

use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Admin\CommentsController;




// ენებთან სამუშად
// მომხმარებლის მხარე 
Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]], function(){  
   
    // მთავარი გვერდი
    Route::get('/', [IndexController::class, 'index'])->name('index');

    //სიახლის შიდა გვერდი
    Route::get('/article/{id}', [IndexController::class, 'article'])->name('article');


    Route::middleware(['auth'])->group(function () {

        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
        Route::post('/update_data', [UserController::class, 'update_data'])->name('update_data');
        Route::post('/update_password', [UserController::class, 'update_password'])->name('update_password');
        Route::post('/comment/{id}', [UserController::class, 'comment'])->name('comment');
    }); 
 
});

// ავტორიზაცია და სისტემიდან გასვლა
Route::group(['middleware' => ['admin'], 'prefix' => 'admin'], function () {
    
    // ავტორიზაცია და სისტემიდან გასვლა
    Route::get('/login', [LoginController::class, 'showLogin'])->withoutMiddleware([Admin::class])->name('ShowLogin');
    Route::post('/signin', [LoginController::class, 'login'])->withoutMiddleware([Admin::class])->name('AdminLogin');
    Route::get('/logout', [LoginController::class, 'logout'])->name('AdminLogout');
    
    // ადმინისტრატორის პანელის მთავარი გვერდი 
    Route::get('/', function () {
        return view('admin.index');
    })->name('AdminMainPage');
    
    // ადმინისტრატორები
    Route::resource('admins', AdminsController::class);
    
    // საკონტაქტო ინფორმაციის გვერდი
    Route::resource('contacts', ContactsController::class, ['only' => ['edit','update']]);
    Route::get('/contacts/cache', [ContactsController::class, 'cache'])->name('contacts.cache');
    
    // სიახლეები
    Route::resource('articles', ArticlesController::class);

    // კომენტარების გვერდი
    Route::resource('comments', CommentsController::class, ['only' => ['index','destroy']]);
    Route::get('/admin/comments', [CommentsController::class, 'index'])->name('comments.index');
Route::post('/admin/comments/confirm/{id}', [CommentsController::class, 'confirm'])->name('comments.confirm');
});       


require __DIR__.'/auth.php';


