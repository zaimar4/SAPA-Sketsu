<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\ResponseController;

Route::get('/', function () {
    return view('auth.login');
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
    Route::get('/dashboard', [ComplaintController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/reports/all', [ComplaintController::class, 'showAll'])->name('admin.reports');
    Route::get('/report/export-pdf', [ComplaintController::class, 'exportPDF'])->name('admin.export-pdf');
    Route::get('/report/export-excel', [ComplaintController::class, 'exportExcel'])->name('admin.export-excel');

    Route::patch('/report/quik-status', [ComplaintController::class, 'quickUpdateStatus'])->name('admin.quik-update-status');
    Route::get('/report/{complaint:slug}', [ComplaintController::class, 'show'])->name('admin.complaints-show');
    Route::patch('/report/{complaint:slug}', [ComplaintController::class, 'update'])->name('admin.update-status');
});
Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
   Route::get('/dashboard', [ComplaintController::class, 'index'])->name('user.dashboard');
    Route::post('/reports', [ComplaintController::class, 'store'])->name('user.reports');
    Route::get('/reports/all', [ComplaintController::class, 'showAll'])->name('user.reports-all');
    Route::get('/laporan/{complaint:slug}', [ComplaintController::class, 'show'])->name('user.complaints-show');
    Route::delete('/laporan/{id}', [ComplaintController::class, 'destroy'])->name('user.complaints-destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/responses', [ResponseController::class, 'store'])->name('responses.store');

});

require __DIR__.'/auth.php';
