<?php

use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SitemapController;
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
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post(
    '/subscribe',
    [SubscriberController::class, 'store']
)
    ->name('subscribe');

Route::get(
    '/privacy-policy',
    [FrontendController::class, 'privacy']
)
    ->name('privacy.policy');

Route::get(
    '/terms-and-conditions',
    [FrontendController::class, 'terms']
)
    ->name('terms.conditions');
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
        //Media Manager
        Route::resource('media', MediaController::class)
            ->parameters([
                'media' => 'media'
            ]);
        //Testimonials
        Route::resource('testimonials', TestimonialController::class);
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/', fn() => redirect()->route('admin.dashboard'));

        // Users
        Route::resource('users', UserController::class);
        Route::patch('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])
            ->name('users.toggle-status');

        // Companies
        Route::resource('companies', CompanyController::class);
        Route::resource('social-links', SocialLinkController::class);
        Route::patch('social-links/{socialLink}/toggle-status', [SocialLinkController::class, 'toggleStatus'])
            ->name('social-links.toggle-status');
        Route::post('social-links/reorder', [SocialLinkController::class, 'reorder'])
            ->name('social-links.reorder');
        //Contact us
        Route::get('/contacts', [ContactController::class, 'index'])
            ->name('contacts.index');
        //announcements
        Route::resource('announcements', AnnouncementController::class);
    });
    //Subscribe
    Route::get(
        '/subscribers',
        [AdminSubscriberController::class, 'index']
    )
        ->name('subscribers.index');


    Route::delete(
        '/subscribers/{id}',
        [AdminSubscriberController::class, 'destroy']
    )
        ->name('subscribers.delete');
});
