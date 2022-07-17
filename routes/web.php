<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\StoreController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\HomeController;

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
})->name('home');

/*Route::get('/teste', function () {
    /*
    $user = new \App\Models\User;
    $user->name = 'Brayan';
    $user->email = 'brayan@opensolution.com.br';
    $user->password = bcrypt('nepo1592');
    $user->save();
    */

    /*
        \App\Models\User::all() - retorna todos os usuários
        \App\Models\User::find(1) - retorna o usário com base no ID
        \App\Models\User::where('name'. 'Brayan')->get() - select * from users where name = 'Brayan'
        \App\Models\User::paginate(10) - paginar dados com laravel
     */
    /*
    $user = \App\Models\User::all();

    return $user;
}); */

Route::group(['middleware' => ['auth']], function(){
    Route::prefix('admin')->name('admin.')->group(function () {

        /*Route::prefix('stores')->name('stores.')->group(function () {

            Route::get('/', [StoreController::class, 'index'])->name('index');
            Route::get('/create', [StoreController::class, 'create'])->name('create');
            Route::post('/store', [StoreController::class, 'store'])->name('store');
            Route::get('/{store}/edit', [StoreController::class, 'edit'])->name('edit');
            Route::post('/update/{store}', [StoreController::class, 'update'])->name('update');
            Route::get('/destroy/{store}', [StoreController::class, 'destroy'])->name('destroy');
        });*/

        Route::resource('stores', StoreController::class);
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);

    });
});

Auth::routes();

//Route::get('/home', [HomeController::class, 'index'])->name('home'); /*->middleware('auth'); */

/*

Request -> Middleware -> Aplicação

*/