<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\InstituteSettingController;
use App\Http\Controllers\UserSettingController;

Route::get('/lang/{locale}', function (string $locale) {
    if (! in_array($locale, ['bn', 'en'], true)) {
        abort(404);
    }

    session(['locale' => $locale]);

    return redirect()->back();
})->name('locale.switch');

// Frontend - Public Home Page
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// Backend Routes (Admin Panel)
Route::prefix('admin')->group(function () {
    // Authentication Routes
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard (protected route)
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        // Notice Routes
        Route::get('/notices', [NoticeController::class, 'index'])->name('notices.index');
        Route::get('/notices/create', [NoticeController::class, 'create'])->name('notices.create');
        Route::post('/notices', [NoticeController::class, 'store'])->name('notices.store');
        Route::get('/notices/categories', [NoticeController::class, 'categories'])->name('notices.categories');
        Route::post('/notices/categories', [NoticeController::class, 'storeCategory'])->name('notices.categories.store');
        Route::delete('/notices/categories/{id}', [NoticeController::class, 'destroyCategory'])->name('notices.categories.destroy');
        Route::get('/notices/{slug}', [NoticeController::class, 'show'])->name('notices.show');
        Route::get('/notices/{id}/edit', [NoticeController::class, 'edit'])->name('notices.edit');
        Route::put('/notices/{id}', [NoticeController::class, 'update'])->name('notices.update');
        Route::delete('/notices/{id}', [NoticeController::class, 'destroy'])->name('notices.destroy');
        
        // News Routes
        Route::get('/news', [NewsController::class, 'index'])->name('news.index');
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news', [NewsController::class, 'store'])->name('news.store');
        Route::get('/news/categories', [NewsController::class, 'categories'])->name('news.categories');
        Route::post('/news/categories', [NewsController::class, 'storeCategory'])->name('news.categories.store');
        Route::delete('/news/categories/{id}', [NewsController::class, 'destroyCategory'])->name('news.categories.destroy');
        Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
        Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');
        
        // Blog Routes
        Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
        Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
        Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
        Route::get('/blogs/categories', [BlogController::class, 'categories'])->name('blogs.categories');
        Route::post('/blogs/categories', [BlogController::class, 'storeCategory'])->name('blogs.categories.store');
        Route::delete('/blogs/categories/{id}', [BlogController::class, 'destroyCategory'])->name('blogs.categories.destroy');
        Route::get('/blogs/{slug}', [BlogController::class, 'show'])->name('blogs.show');
        Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
        Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
        Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');
        
        // Institute Settings Routes
        Route::get('/settings/institute', [InstituteSettingController::class, 'index'])->name('settings.institute');
        Route::post('/settings/institute', [InstituteSettingController::class, 'update'])->name('settings.institute.update');
        
        // User Settings Routes
        Route::get('/settings/user', [UserSettingController::class, 'index'])->name('settings.user');
        Route::post('/settings/user', [UserSettingController::class, 'store'])->name('settings.user.store');
        Route::post('/settings/user/update-login', [UserSettingController::class, 'updateLogin'])->name('settings.user.update-login');
        Route::post('/settings/user/update-status', [UserSettingController::class, 'updateStatus'])->name('settings.user.update-status');
        Route::put('/settings/profile', [UserSettingController::class, 'updateProfile'])->name('settings.profile.update');
        Route::put('/settings/password', [UserSettingController::class, 'updatePassword'])->name('settings.password.update');
        Route::put('/settings/preferences', [UserSettingController::class, 'updatePreferences'])->name('settings.preferences.update');
        
        // Profile Route
        Route::get('/profile', [UserSettingController::class, 'profile'])->name('profile');
    });
});
