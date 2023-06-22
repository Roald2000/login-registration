<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', function () {
    if (Auth::check()) {
        return view('home');
    }
    return redirect()->route('login');
})->name('home');

//? Displays Form Inputs
Route::get('/login', [AuthManager::class, 'login'])->name('login');
Route::get('/registration', [AuthManager::class, 'registration'])->name('registration');

//? Executes the action and method for login,register and logout
Route::post('/login', [AuthManager::class, 'postLogin'])->name('post.login');
Route::post('/registration', [AuthManager::class, 'postRegistration'])->name('post.registration');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


//? Routes the authenticated user can access
Route::group(['middleware' => 'auth'], function () {
    //* Views for user access
    Route::get('/profile',  [UserProfileController::class, 'profile'])->name('profile');
});
