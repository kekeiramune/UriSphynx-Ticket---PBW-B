<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConcertController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Models\Concert;
use App\Models\Category;

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

Route::get('/concert/{id_concert}', [ConcertController::class, 'show'])
    ->name('concert.show');

Route::get('/payment/{concert}', [PaymentController::class, 'create'])
    ->name('payment.form');

Route::post('/payment/{concert}', [PaymentController::class, 'store'])
    ->name('payment.store');


Route::get('/category', [CategoryController::class, 'index'])
    ->name('category.index');

Route::get('/', function () {
    $concerts = Concert::with('category')->get();
    // Auto-update status for landing page
    foreach ($concerts as $concert) {
        if (\Carbon\Carbon::parse($concert->concert_time)->isPast() && $concert->status_concert !== 'Finished') {
            $concert->update(['status_concert' => 'Finished']);
        }
    }
    // Re-fetch or refresh fetching isn't strictly necessary since update() doesn't mutate the instance in-place fully for all fields in all versions, 
    // but the status_concert attribute on $concert should be updated by the update() call in standard Eloquent.
    // However, to be extra safe and ensure view gets clean data:
    $concerts = Concert::with('category')->get();

    $category = Category::all();
    return view('welcome', compact('concerts', 'category'));
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboardadmin'])->name('admin.dashboardadmin');
    // Concert Management Routes
    Route::get('/concertmanage', [AdminController::class, 'concertmanage'])->name('admin.concertmanage');
    Route::get('/concert/create', [AdminController::class, 'createConcert'])->name('admin.concert.create');
    Route::post('/concert/store', [AdminController::class, 'storeConcert'])->name('admin.concert.store');
    Route::get('/concert/{id}/edit', [AdminController::class, 'editConcert'])->name('admin.concert.edit');
    Route::put('/concert/{id}/update', [AdminController::class, 'updateConcert'])->name('admin.concert.update');
    Route::post('/concert/{id}/delete', [AdminController::class, 'deleteConcert'])->name('admin.concert.delete');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transadmin');
    Route::get('/ticketmanage', [AdminController::class, 'ticketmanage'])->name('admin.ticketmanage');
    Route::get('/accountmanage', [AdminController::class, 'accountmanage'])->name('admin.accountmanage');
    Route::get('/editprofadmin', [AdminController::class, 'editprofadmin'])->name('admin.editprofadmin');
    Route::get('/ticket/{id}/edit', [AdminController::class, 'editTicket'])
        ->name('admin.ticket.edit');
    Route::post('/ticket/{id}/update', [AdminController::class, 'updateTicket'])
        ->name('admin.ticket.update');
    Route::get('/concertmanage/create', [AdminController::class, 'createTicket'])
        ->name('admin.ticket.create');
    Route::post('/concertmanage/store', [AdminController::class, 'storeTicket'])
        ->name('admin.ticket.store');
    // Ticket Price Management Routes
    Route::get('/ticketprice/create', [AdminController::class, 'createTicketPrice'])
        ->name('admin.ticketprice.create');
    Route::post('/ticketprice/store', [AdminController::class, 'storeTicketPrice'])
        ->name('admin.ticketprice.store');
    Route::post('/ticket/{id}/delete', [AdminController::class, 'deleteTicket'])
        ->name('admin.ticket.delete');
    Route::get('/categorymanage', [AdminController::class, 'showCategory'])
        ->name('admin.categorymanage');

    Route::get('/category/create', [AdminController::class, 'createCategory'])
        ->name('admin.category.create');

    Route::post('/category/store', [AdminController::class, 'storeCategory'])
        ->name('admin.category.store');

    Route::get('/category/{id}/edit', [AdminController::class, 'editCategory'])
        ->name('admin.category.edit');

    Route::put('/category/{id}/update', [AdminController::class, 'updateCategory'])
        ->name('admin.category.update');

    Route::post('/category/{id}/delete', [AdminController::class, 'deleteCategory'])
        ->name('admin.category.delete');

    Route::put('/transaction/{id}/approve', [AdminController::class, 'approveTransaction'])
        ->name('admin.transaction.approve');

    Route::put('/transaction/{id}/reject', [AdminController::class, 'rejectTransaction'])
        ->name('admin.transaction.reject');

    Route::put('/profile', [AdminController::class, 'update'])
        ->name('admin.profile.update');


});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\UserDashboardController::class, 'index'])
        ->name('dashboard');
    
    Route::get('/transaction/{id}', [App\Http\Controllers\UserDashboardController::class, 'showTransaction'])
        ->name('transaction.show');
    
    Route::get('/ticket/{id}', [App\Http\Controllers\UserDashboardController::class, 'showTicket'])
        ->name('ticket.show');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
