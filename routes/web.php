<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

use App\Http\Controllers\Admin\{AttendanceController, ClassVideoController, ProjectController as AdminProject, AssignmentController as AdminAssignment};
use App\Http\Controllers\Student\{ProjectController as CandidateProject, AssignmentController as CandidateAssignment};
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Student\AssignmentController;
use App\Http\Controllers\Student\ProjectController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\CertificationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Trainer\TrainerCourseController;


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
    return view('frontend.home');
})->name('home');

Route::get('/about', function () {
    return view('frontend.about');
})->name('about');

Route::get('fontend/courses', [frontendController::class, 'courses'])->name('frontend.courses');
Route::get('/course/{id}', [FrontendController::class, 'courseDetails'])->name('frontend.course.details');
Route::get('/features', [FrontendController::class, 'features'])->name('frontend.features');

// Frontend - Courses
Route::get('/courses/data-science-ai-ml', [FrontendController::class, 'dataScienceProgram'])
    ->name('frontend.courses.data-science-ai-ml');

Route::get('/courses/microsoft-powerbi-analytics', [FrontendController::class, 'powerBiProgram'])
    ->name('frontend.courses.powerbi-analytics');

Route::get('/courses/placement-assistance-mock-interview', [FrontendController::class,'placementProgram'])->name('frontend.courses.placement-assistance');

Route::get('/courses/data-analytics', [FrontendController::class, 'dataAnalytics'])
    ->name('frontend.courses.data-analytics');

Route::get('/blogs', [FrontendController::class, 'blog'])->name('blogs.index');
Route::get('/blogs/{slug}', [FrontendController::class, 'blogshow'])->name('blogs.show');

Route::get('/trainer_program', [FrontendController::class, 'trainer_program'])
    ->name('frontend.trainer_program');


Route::get('/contact', function () {
    return view('frontend.contact');
})->name('contact');

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

Route::post('/chatbot/reply', [ChatbotController::class, 'reply']);



Route::middleware(['auth'])->group(function () {

    Route::resource('attendances', AttendanceController::class);
    // Admin Routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::resource('users', UserController::class);
        Route::resource('class-videos', ClassVideoController::class);
        Route::resource('blogs', BlogController::class)->names('blogs');

        Route::get('notifications/create', [NotificationController::class, 'create'])->name('notifications.create');
        Route::post('notifications', [NotificationController::class, 'store'])->name('notifications.store');
        Route::delete('notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

        Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
        Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    });

    Route::resource('courses', CourseController::class);
    Route::get('courses/{id}/view', [CourseController::class, 'show'])->name('courses.show');

    // Student Routes
    Route::middleware('student')->prefix('student')->name('student.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'studentdashboard'])->name('dashboard');
        Route::resource('projects', CandidateProject::class)->only(['index', 'create', 'store']);
        // Route::resource('assignments', AssignmentController::class)->only(['index', 'create', 'store']);
    });

    Route::get('/notifications/fetch', [NotificationController::class, 'fetch'])->name('notifications.fetch');
    Route::post('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');


    Route::middleware(['auth', 'role:student,trainer'])
        ->prefix('student')
        ->name('student.')
        ->group(function () {
            Route::get('assignments', [AssignmentController::class, 'index'])->name('assignments.index');
            Route::get('assignments/create/{id?}', [AssignmentController::class, 'create'])->name('assignments.create');
            Route::post('assignments/store/{id?}', [AssignmentController::class, 'store'])->name('assignments.store');
            Route::delete('assignments/{id}', [AssignmentController::class, 'destroy'])->name('assignments.destroy');
            Route::get('assignments/{id}/file', [AssignmentController::class, 'viewFile'])
            ->name('assignments.viewfile');
         
            Route::get('projects', [ProjectController::class, 'index'])->name('projects.index');
            Route::get('projects_create/{id?}', [ProjectController::class, 'create'])->name('projects.create');
            Route::post('projects/store/{id?}', [ProjectController::class, 'store'])->name('projects.store');
            Route::delete('projects/{id}', [ProjectController::class, 'destroy'])->name('projects.destroy');
            Route::get('projects/{id}/file', [ProjectController::class, 'viewFile'])
            ->name('projects.viewfile');
        });


    // trainer Routes
    Route::middleware('trainer')->prefix('trainer')->name('trainer.')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'trainerdashboard'])->name('dashboard');
        Route::resource('class-videos', ClassVideoController::class);
        Route::resource('projects', CandidateProject::class)->only(['index', 'create', 'store']);
        Route::resource('assignments', CandidateAssignment::class)->only(['index', 'create', 'store']);
    });

    Route::resource('certifications', CertificationController::class);
});




// Route::get('/dashboard', function () {
//     return view('dashboard'); 
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');

Route::middleware(['auth', 'role:student,admin'])
        ->name('student.')
        ->group(function () {
            Route::get('invoices', [InvoiceController::class, 'index'])->name('invoices.index');
            Route::get('invoice/view/{id}', [InvoiceController::class, 'viewInvoice'])->name('invoice.view');
            Route::get('invoice/download/{id}', [InvoiceController::class, 'downloadPdf'])->name('invoice.download');
        
        Route::middleware(['role:student'])->group(function () {
            Route::get('invoice/pay/{id}', [PaymentController::class, 'createOrder'])->name('payment.checkout');
            Route::post('payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');
        });

});

Route::middleware(['auth', 'role:admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('invoice/edit/{invoice}', [InvoiceController::class, 'edit'])->name('invoice.edit');
        Route::put('invoice/update/{invoice}', [InvoiceController::class, 'update'])->name('invoice.update');
});

Route::middleware(['auth', 'role:trainer'])->group(function() {
    Route::get('/trainer/courses', [TrainerCourseController::class, 'courses'])->name('trainer.courses');
    Route::get('/trainer/course/{id}/student/{studentId}', [TrainerCourseController::class, 'courseView'])->name('trainer.course.view');
});

Route::post('/student/video/complete/{video}', [CourseController::class, 'markVideoComplete'])
    ->name('video.complete');

Route::middleware(['auth', 'check.course.paid'])
    ->group(function () {
        Route::get('courses/{id}/view', [CourseController::class, 'show'])->name('courses.show');
});
