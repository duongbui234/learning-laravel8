<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SetupUserController;
use App\Models\Contact;
use App\Models\ContactForm;
use App\Models\HomeAbout;
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
    $about = DB::table('home_abouts')->first();
    $images = DB::table('multipics')->get();
    return view('home', compact('brands', 'sliders', 'about', 'images'));
});

Route::get('portfolio', function () {
    $images = DB::table('multipics')->get();
    return view('pages.portfolio', compact('images'));
})->name('portfolio');

Route::get('/home', function () {
    echo 'This is home';
});


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
Route::get('/slider/edit/{id}', [HomeController::class, 'editSlider']);
Route::post('/slider/update/{id}', [HomeController::class, 'updateSlider']);
Route::get('/slider/delete/{id}', [HomeController::class, 'delSlider']);

// Home about router
Route::get('about/all', [AboutController::class, 'homeAbout'])->name('about.all');
Route::get('about/add', function () {
    return view('admin.home_about.create');
})->name('about.add');
Route::post('about/store', [AboutController::class, 'storeAbout'])->name('about.store');
Route::get('about/edit/{id}', function ($id) {
    $about = HomeAbout::find($id);

    return view('admin.home_about.edit', compact('about'));
});
Route::post('/about/update/{id}', [AboutController::class, 'updateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'deleteAbout']);

// Multi pictures router
Route::get('/multi/all', [BrandController::class, 'multiPic'])->name('multi.pic');
Route::post('/multi/store', [BrandController::class, 'storeImg'])->name('store.image');

// Contact admin
Route::get('/contact/all', [ContactController::class, 'allContact'])->name('all.contact');
Route::get('/contact/add', function () {
    return view('admin.contact.create');
})->name('contact.add');
Route::get('/contact/message', function () {
    $messages = ContactForm::all();
    return view('admin.contact.message', compact('messages'));
})->name('contact.message');
Route::get('/message/delete/{id}', function ($id) {
    ContactForm::find($id)->delete();
    return Redirect()->back()->with('success', "delete successfully");
});
Route::post('contact/store', [ContactController::class, 'storeContact'])->name('contact.store');

// Contact page
Route::get('/contact', function () {
    $contact = DB::table('contacts')->first();
    return view('pages.contact', compact('contact'));
})->name('contact');
Route::post('/contact/form', [ContactController::class, 'createContactForm'])->name('contact.form');

// Setup user profile
Route::get('password/change', [SetupUserController::class, 'editPass'])->name('password.change');
Route::post('password/update', [SetupUserController::class, 'changePass'])->name('password.update');
Route::get('profile/change', [SetupUserController::class, 'editProfile'])->name('profile.change');
Route::post('profile/update', [SetupUserController::class, 'changeProfile'])->name('profile.update');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('user/logout', [BrandController::class, 'logOut'])->name('admin.logout');
