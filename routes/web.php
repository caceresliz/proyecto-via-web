<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Livewire\Actividades;
use App\Http\Livewire\Almacens;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Categorias;
use App\Http\Livewire\Plans;
use App\Http\Livewire\Product;
use App\Http\Livewire\Promocions;
use App\Http\Livewire\Reportes;
use App\Http\Livewire\Servicios;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Auth;

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

//Route::get('/', function () {return view('home');});
Route::get('/', function () {return view('inicio');})->name('inicio');
route::post('/logout','Auth\LoginController@logout')->name('logout');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::middleware(['auth'])->group(function (){

    Route::group(['middleware' => ['role:GERENTE']], function () {
        Route::get('categorias', Categorias::class);
        Route::get('almacenes', Almacens::class);
        Route::get('promociones', Promocions::class);
        Route::get('productos', Product::class);
        Route::get('plan', Plans::class);
        Route::get('actividades', Actividades::class);
        Route::get('servicios', Servicios::class);
        Route::get('reportes', Reportes::class);
        Route::get('report/pdf/{reportType}', [ExportController::class, 'reportPDF']);
        Route::get('clientes',\App\Http\Livewire\Clientes::class);
        Route::get('telefonoclientes',\App\Http\Livewire\TelefonoClientes::class);
        Route::get('telefonousers',\App\Http\Livewire\TelefonoUsuarios::class);
        Route::get('viaticos',\App\Http\Livewire\Viaticos::class);
        Route::get('roles',\App\Http\Livewire\Roles::class);
        Route::get('permisos',\App\Http\Livewire\Permisos::class);
        Route::get('asignar',\App\Http\Livewire\Asignar::class);
        Route::get('users',\App\Http\Livewire\Users::class);
    });

    /*Route::group(['middleware' => ['role:TECNICO']], function () {
        Route::get('promociones', Promocions::class);
        Route::get('productos', Product::class);
        Route::get('plan', Plans::class);
        Route::get('actividades', Actividades::class);
    });*/
});
