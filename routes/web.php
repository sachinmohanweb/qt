<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceGalleryController;
use App\Http\Controllers\DataTableController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.form')->middleware('auth');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change')->middleware('auth');

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // DataTable Routes
    Route::get('/users/data', [DataTableController::class, 'users'])->name('users.data');
    Route::get('/testimonials/data', [DataTableController::class, 'testimonials'])->name('testimonials.data');
    Route::get('/blogs/data', [DataTableController::class, 'blogs'])->name('blogs.data');
    Route::get('/service-types/data', [DataTableController::class, 'serviceTypes'])->name('service-types.data');
    Route::get('/services/data', [DataTableController::class, 'services'])->name('services.data');
    Route::get('/service-galleries/data', [DataTableController::class, 'serviceGalleries'])->name('service-galleries.data');
    Route::get('/products/data', [DataTableController::class, 'products'])->name('products.data');
    Route::get('/feedback/data', [DataTableController::class, 'feedback'])->name('feedback.data');
    
    // Users Management
    Route::resource('users', UserController::class);
    
    // Products Management
    Route::resource('products', ProductController::class);
    
    // Feedback Management
    Route::resource('feedback', FeedbackController::class);
    
    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{testimonial}/toggle-home-visibility', [TestimonialController::class, 'toggleHomeVisibility'])->name('testimonials.toggle-home-visibility');
    Route::post('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])->name('testimonials.toggle-status');
    
    // Blogs Management
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/toggle-home-visibility', [BlogController::class, 'toggleHomeVisibility'])->name('blogs.toggle-home-visibility');
    Route::post('blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggle-status');
    
    // Service Types Management
    Route::resource('service-types', ServiceTypeController::class);
    Route::post('service-types/{serviceType}/toggle-status', [ServiceTypeController::class, 'toggleStatus'])->name('service-types.toggle-status');
    
    // Services Management
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
    
    // Service Galleries Management
    Route::resource('service-galleries', ServiceGalleryController::class);
    Route::post('service-galleries/{serviceGallery}/toggle-status', [ServiceGalleryController::class, 'toggleStatus'])->name('service-galleries.toggle-status');
});

