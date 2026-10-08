<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FarmerController;
use App\Http\Controllers\FarmerAuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\BuyerAuthController;
use App\Http\Controllers\IntentController;
use App\Http\Controllers\ContactController;


Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'create'])
        ->name('contact.create');

    Route::post('/contact', [ContactController::class, 'store'])
        ->name('contact.store');
});



/*
|--------------------------------------------------------------------------
| Home / Front Pages
|--------------------------------------------------------------------------
*/
Route::middleware(['admin'])->group(function () {

    Route::get('/admin/contacts', [AdminController::class, 'contacts'])
        ->name('admin.contacts');

    Route::post('/admin/contacts/{id}/reply',
        [AdminController::class, 'replyContact'])
        ->name('admin.contacts.reply');

});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about-system', function () {
    return view('about');
})->name('about.system');

/*
|--------------------------------------------------------------------------
| Farmer Authentication
|--------------------------------------------------------------------------
*/
Route::get('/farmer/register', [FarmerAuthController::class, 'showRegister'])
    ->name('farmer.register');

Route::post('/farmer/register', [FarmerAuthController::class, 'register'])
    ->name('farmer.register.submit');

Route::get('/farmer/login', [FarmerAuthController::class, 'showLogin'])
    ->name('farmer.login');

Route::post('/farmer/login', [FarmerAuthController::class, 'login'])
    ->name('farmer.login.submit');

Route::get('/farmer/logout', [FarmerAuthController::class, 'logout'])
    ->name('farmer.logout');

/*
|--------------------------------------------------------------------------
| Farmer Module
|--------------------------------------------------------------------------
*/
Route::prefix('farmer')->group(function () {

    Route::get('/dashboard', [FarmerController::class, 'dashboard'])
        ->name('farmer.dashboard');

    Route::get('/produce', [FarmerController::class, 'produce'])
        ->name('farmer.produce');

    Route::post('/produce/store', [FarmerController::class, 'storeProduce'])
        ->name('farmer.produce.store');

    Route::get('/matches', [FarmerController::class, 'matches'])
        ->name('farmer.matches');

    Route::post('/match/{id}/accept', [FarmerController::class, 'acceptMatch'])
        ->name('farmer.match.accept');

    Route::post('/match/{id}/reject', [FarmerController::class, 'rejectMatch'])
        ->name('farmer.match.reject');
});

/*
|--------------------------------------------------------------------------
| Buyer Authentication
|--------------------------------------------------------------------------
*/
Route::get('/buyer/register', [BuyerAuthController::class, 'showRegister'])
    ->name('buyer.register');

Route::post('/buyer/register', [BuyerAuthController::class, 'register'])
    ->name('buyer.register.submit');

Route::get('/buyer/login', [BuyerAuthController::class, 'showLogin'])
    ->name('buyer.login');

Route::post('/buyer/login', [BuyerAuthController::class, 'login'])
    ->name('buyer.login.submit');

Route::get('/buyer/logout', [BuyerAuthController::class, 'logout'])
    ->name('buyer.logout');

/*
|--------------------------------------------------------------------------
| Buyer Module
|--------------------------------------------------------------------------
*/
Route::prefix('buyer')->group(function () {

    Route::get('/dashboard', [BuyerController::class, 'dashboard'])
        ->name('buyer.dashboard');

    Route::get('/intent/create', [BuyerController::class, 'createIntent'])
        ->name('buyer.intent.create');

    Route::post('/intent/store', [BuyerController::class, 'storeIntent'])
        ->name('buyer.intent.store');

    Route::get('/matches', [BuyerController::class, 'matches'])
        ->name('buyer.matches');
});

/*
|--------------------------------------------------------------------------
| Admin Authentication
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AdminController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'login'])
    ->name('admin.login.submit');

Route::get('/admin/logout', [AdminController::class, 'logout'])
    ->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Admin Module
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/farmers', [AdminController::class, 'farmers'])
        ->name('admin.farmers');

    Route::get('/buyers', [AdminController::class, 'buyers'])
        ->name('admin.buyers');

    Route::get('/analytics', [AdminController::class, 'analytics'])
        ->name('admin.analytics');

    Route::post('/farmer/{id}/approve', [AdminController::class, 'approveFarmer'])
        ->name('admin.farmer.approve');
});

/*
|--------------------------------------------------------------------------
| Optional – Intent Matches (Debug / Admin View)
|--------------------------------------------------------------------------
*/
Route::get('/intent/{id}/matches', [IntentController::class, 'showMatches'])
    ->name('intent.matches');
