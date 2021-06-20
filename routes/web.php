<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\DB;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $sliders = DB::table('sliders')->get();
    return view('home', compact('brands', 'sliders'));
});
Route::get('/home', function () {
    echo 'This is home';
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', [ContactController::class, 'index']);

// Category router
Route::get('/category/all', [CategoryController::class, 'allCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'addCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'editCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'updateCat']);
Route::get('/category/softdelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restoreCat']);
Route::get('/category/delete/{id}', [CategoryController::class, 'deleteCat']);

// Brand router
Route::get('/brand/all', [BrandController::class, 'allBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'storeBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'editBrand']);
Route::post('/brand/update/{id}', [BrandController::class, 'updateBrand']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delBrand']);

// Home slider router
Route::get('slider/all', [HomeController::class, 'homeSlider'])->name('slider.all');
Route::get('slider/add', [HomeController::class, 'addSlider']);
Route::post('slider/store', [HomeController::class, 'storeSlider'])->name('slider.store');

// MultiImg router
Route::get('/multi/all', [BrandController::class, 'multiPic'])->name('multi.pic');
Route::post('/multi/store', [BrandController::class, 'storeImg'])->name('store.image');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all();
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('user/logout', [BrandController::class, 'logOut'])->name('admin.logout');
