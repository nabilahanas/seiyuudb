<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CharaController;
use App\Http\Controllers\VAController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\Auth\LoginController;
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

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});
Route::get('add', [CharaController::class, 'create'])->name('chara.create');
Route::get('add_va', [VAController::class, 'create'])->name('chara.create_va');
Route::get('add_agency', [AgencyController::class, 'create'])->name('chara.create_agency');

Route::post('store', [CharaController::class, 'store'])->name('chara.store');
Route::post('store_va', [VAController::class, 'store'])->name('chara.store_va');
Route::post('store_agency', [AgencyController::class, 'store'])->name('chara.store_agency');
Route::post('search', [CharaController::class, 'searchSum'])->name('chara.search_summary');

Route::get('/home', [CharaController::class, 'index'])->name('chara.index');
Route::get('/va', [VAController::class, 'index'])->name('chara.index_va');
Route::get('/agency', [AgencyController::class, 'index'])->name('chara.index_agency');
Route::get('/summary', [CharaController::class, 'indexSum'])->name('chara.index_summary');

Route::get('edit/{id}', [CharaController::class, 'edit'])->name('chara.edit');
Route::get('edit_va/{id}', [VAController::class, 'edit'])->name('chara.edit_va');
Route::get('edit_agency/{id}', [AgencyController::class, 'edit'])->name('chara.edit_agency');

Route::post('update/{id}', [CharaController::class,'update'])->name('chara.update');
Route::post('update_va/{id}', [VAController::class,'update'])->name('chara.update_va');
Route::post('update_agency/{id}', [AgencyController::class,'update'])->name('chara.update_agency');

Route::post('delete/{id}', [CharaController::class,'delete'])->name('chara.delete');
Route::post('delete_va/{id}', [VAController::class,'delete'])->name('chara.delete_va');
Route::post('delete_agency/{id}', [AgencyController::class,'delete'])->name('chara.delete_agency');

Route::post('softdelete/{id}', [CharaController::class,'softdelete'])->name('chara.softdelete');
Route::post('softdelete_va/{id}', [VAController::class,'softdelete'])->name('chara.softdelete_va');
Route::post('softdelete_agency/{id}', [AgencyController::class,'softdelete'])->name('chara.softdelete_agency');

Route::get('restore', [CharaController::class,'restore'])->name('chara.restore');
Route::get('restore_va', [VAController::class,'restore'])->name('chara.restore_va');
Route::get('restore_agency', [AgencyController::class,'restore'])->name('chara.restore_agency');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');