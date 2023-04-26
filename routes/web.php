<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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
});

// Auth::routes();
Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->hasRole('admins')) {
            return redirect()->route('dashboard.admin');
        }

        if ($user->hasRole('resellers')) {
            return redirect()->route('dashboard.reseller');
        }

        if ($user->hasRole('members')) {
            return redirect()->route('dashboard.member');
        }
    }

    return redirect('/login')->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ]);
});
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'role:admins', 'can:dashboard.admin'])->group(function () {
    Route::get('/dashboard-admin', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.admin');
});

Route::middleware(['auth', 'role:resellers', 'can:dashboard.reseller'])->group(function () {
    Route::get('/dashboard-reseller', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.reseller');
});

Route::middleware(['auth', 'role:members', 'can:dashboard.member'])->group(function () {
    Route::get('/dashboard-member', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard.member');
});
