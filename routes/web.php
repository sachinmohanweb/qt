<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceGalleryController;
use App\Http\Controllers\VideoItemsController;
use App\Http\Controllers\DataTableController;
use App\Http\Controllers\WebsiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Authentication Routes
Route::get('/admin', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/change-password', [AuthController::class, 'showChangePasswordForm'])->name('password.form')
                ->middleware('auth');
Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change')
                ->middleware('auth');

Route::get('/', [WebsiteController::class, 'Index'])->name('web.index');
Route::get('/design', [WebsiteController::class, 'Design'])->name('web.design');
Route::get('/construction', [WebsiteController::class, 'Construction'])->name('web.construction');
Route::get('/interior', [WebsiteController::class, 'Interior'])->name('web.interior');
Route::get('/maintenance', [WebsiteController::class, 'Maintenance'])->name('web.maintenance');
Route::get('/about', [WebsiteController::class, 'About'])->name('web.about');
Route::get('/projects', [WebsiteController::class, 'Project'])->name('web.project');
Route::get('/project_details/{id}/{slug}', [WebsiteController::class, 'ProjectDetails'])->name('web.project.details');
Route::get('/blogs', [WebsiteController::class, 'Blog'])->name('web.blog');
Route::get('/blog_details/{slug}', [WebsiteController::class, 'BlogDetails'])->name('web.blog.details');
Route::get('/contact', [WebsiteController::class, 'Contact'])->name('web.contact');


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
    Route::get('/service-galleries/data',[DataTableController::class,'serviceGalleries'])->name('service-galleries.data');
    Route::get('/video-items/data',[DataTableController::class,'VideoItems'])->name('video-items.data');

    
    // Users Management
    Route::resource('users', UserController::class);
    
    // Testimonials Management
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/{testimonial}/toggle-home-visibility', [TestimonialController::class, 'toggleHomeVisibility'])->name('testimonials.toggle-home-visibility');
    Route::post('testimonials/{testimonial}/toggle-status', [TestimonialController::class, 'toggleStatus'])
        ->name('testimonials.toggle-status');
    
    // Blogs Management
    Route::resource('blogs', BlogController::class);
    Route::post('blogs/{blog}/toggle-home-visibility', [BlogController::class, 'toggleHomeVisibility'])
        ->name('blogs.toggle-home-visibility');
    Route::post('blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggle-status');
    Route::post('blogs/upload-image', [BlogController::class, 'uploadImage'])->name('admin.upload_image');
    
    // Service Types Management
    Route::resource('service-types', ServiceTypeController::class);
    Route::post('service-types/{serviceType}/toggle-status', [ServiceTypeController::class, 'toggleStatus'])
        ->name('service-types.toggle-status');
    
    // Services Management
    Route::resource('services', ServiceController::class);
    Route::post('services/{service}/toggle-home-visibility', [ServiceController::class, 'toggleHomeVisibility'])
        ->name('services.toggle-home-visibility');
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])
        ->name('services.toggle-status');
    
    // Service Galleries Management
    Route::resource('service-galleries', ServiceGalleryController::class);
    Route::post('service-galleries/{serviceGallery}/toggle-status', [ServiceGalleryController::class, 'toggleStatus'])
        ->name('service-galleries.toggle-status');

    // Video Items Management
    Route::resource('video-items', VideoItemsController::class);
    Route::post('video-items/{videoitem}/toggle-home-visibility', [VideoItemsController::class, 'toggleHomeVisibility'])
        ->name('video-items.toggle-home-visibility');
    Route::post('video-items/{VideoItems}/toggle-status', [VideoItemsController::class, 'toggleStatus'])
        ->name('video-items.toggle-status');
});

