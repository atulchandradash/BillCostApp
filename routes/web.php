<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\UserAuthController;
use Illuminate\Support\Facades\Route;

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



Route::get('/auth', function () {
    return view('auth.auth');
})->name('auth');

// AuthRoute
Route::post('/registration', [UserAuthController::class, 'registration'])->name('registration');
Route::post('/login', [UserAuthController::class, 'login'])->name('login');


Route::group(['middleware' => 'UserAuth'], function () {

    Route::get('/', [HomeController::class, 'index'])->name('welcome');

    // addCostSection
    Route::post('/addCost', [HomeController::class, 'addCost'])->name('addCost');
    Route::delete('/deleteCost/{id}', [HomeController::class, 'deleteCost'])->name('deleteCost');
    // --------    

    // ProfileSection
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    // --------


    // search

    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::Post('/search', [SearchController::class, 'searchResult'])->name('search.result');


    // --------


    // CategoiresSection
    Route::get('/addcCategories', [HomeController::class, 'addcCategories'])->name('addcCategories');
    Route::post('/addCategoriePost', [HomeController::class, 'addCategoriePost'])->name('addCategoriePost');
    Route::delete('/addCategories/{id}', [HomeController::class, 'deleteCategories'])->name('deleteCategories');
    // ---------


    //Logout

    Route::post('/logout', [UserAuthController::class, 'logout'])->name('logout');

    // ---
});