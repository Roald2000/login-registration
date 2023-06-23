<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\ForgetPasswordManager;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserProfileController;
use App\Models\UserPosts;
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
        $posts = UserPosts::latest()->limit(100)->get(); // Get the latest post
        return view('posts.posts', compact('posts'));
    }
    return redirect()->route('auth.login');
})->name('home');

//? Displays Form Inputs
Route::get('/login', [AuthManager::class, 'login'])->name('auth.login');
Route::get('/registration', [AuthManager::class, 'registration'])->name('auth.registration');

Route::get('/forgot', [ForgetPasswordManager::class, 'forgetPassword'])->name('auth.forgot');

// Route::post('/forgot-post', [ForgetPasswordManager::class, 'forgetPasswordPost'])->name('auth.forgot.post');
// Route::get('/reset-password/{token}', [ForgetPasswordManager::class, 'resetPassword'])->name('reset.password');
// Route::post('/reset-password',)

//? Executes the action and method for login,register and logout
Route::post('/login', [AuthManager::class, 'postLogin'])->name('post.login');
Route::post('/registration', [AuthManager::class, 'postRegistration'])->name('post.registration');
Route::get('/logout', [AuthManager::class, 'logout'])->name('logout');


//? Routes the authenticated user can access
Route::group(['middleware' => 'auth'], function () {
    //* Views for user access
    Route::get('/profile',  [UserProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/setup',  [UserProfileController::class, 'setup'])->name('profile.setup');
    Route::post('/profile/update',  [UserProfileController::class, 'update'])->name('profile.update');

    Route::get('/profile/check/{id}', [UserProfileController::class, 'checkProfile'])->name('profile.check');

    Route::post('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/delete/{id}', [PostController::class, 'delete'])->name('posts.delete');
});
