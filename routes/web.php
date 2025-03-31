<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ExportArticleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'loginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', AdminUserController::class);
});

Route::middleware(['auth', 'is_editor'])->prefix('editor')->name('editor.')->group(function () {
    Route::get('/articles', [EditorController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [EditorController::class, 'create'])->name('articles.create');
    Route::post('/articles', [EditorController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [EditorController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [EditorController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [EditorController::class, 'destroy'])->name('articles.destroy');
});


Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

Route::post('/notifications/mark-as-read/{id}', function ($id) {
    $notification = auth()->user()->notifications()->find($id);
    if ($notification) {
        $notification->markAsRead();
    }
    return back();
})->name('notifications.read');

Route::get('/admin/notifications', function () {
    return view('admin.notifications');
})->middleware('auth', 'role:admin')->name('admin.notifications');

Route::get('/export/articles/excel', [ExportArticleController::class, 'exportExcel'])->name('export.articles.excel');
Route::get('/export/articles/pdf', [ExportArticleController::class, 'exportPDF'])->name('export.articles.pdf');

Route::middleware(['auth', 'role:editor'])->group(function () {
    Route::get('/editor/articles/export/excel', [ExportArticleController::class, 'exportExcel'])->name('editor.articles.export.excel');
    Route::get('/editor/articles/export/pdf', [ExportArticleController::class, 'exportPDF'])->name('editor.articles.export.pdf');
});
