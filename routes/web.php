<?php

use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Frontend Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
// Public
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
});
/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->group(function () {

    // Guest-only (not logged in)
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | Protected Admin Routes (requires auth + admin role)
    |----------------------------------------------------------------------
    */
    Route::middleware(['auth', 'admin.role'])->group(function () {
        //Blogs
        // Blog Posts
        Route::resource('blogs', AdminBlogController::class);
        Route::patch('blogs/{blog}/toggle-featured', [AdminBlogController::class, 'toggleFeatured'])
            ->name('blogs.toggle-featured');
        Route::patch('blogs/{blog}/toggle-status', [AdminBlogController::class, 'toggleStatus'])
            ->name('blogs.toggle-status');

        //Banner
        Route::resource('hero', HeroSectionController::class);
        //Services
        Route::resource('services', ServiceController::class);
        //Page manager
        Route::resource('pages', PageController::class);
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        // Users
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');

        // Companies
        Route::resource('companies', CompanyController::class);
    });
});
