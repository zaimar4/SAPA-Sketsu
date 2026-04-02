<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ComplaintController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {

    $role = Auth::user()->role;

    if ($role === 'admin') {
        return redirect('/admin/dashboard');
    }

    if ($role === 'user') {
        return redirect('/user/dashboard');
    }
    abort(403);

})->middleware(['auth'])->name('dashboard');;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboardadmin');
    })->name('admin.dashboard');
});
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
   Route::get('/dashboard', [ComplaintController::class, 'index'])->name('user.dashboard');
    Route::post('/reports', [ComplaintController::class, 'store'])->name('user.reports');
    Route::get('/reports/all', [ComplaintController::class, 'showAll'])->name('user.reports-all');
    Route::get('/laporan/{complaint:slug}', [ComplaintController::class, 'show'])->name('user.complaints-show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
