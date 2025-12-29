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

Route::get('/category', [CategoryController::class, 'index'])
    ->name('category.index');

Route::get('/', function () {
    $concerts = Concert::with('category')->get();
    $category = Category::all();
    return view('welcome', compact('concerts', 'category'));
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboardadmin'])->name('admin.dashboardadmin');
    Route::get('/transactions', [AdminController::class, 'transactions'])->name('admin.transadmin');
    Route::get('/concertmanage', [AdminController::class, 'concertmanage'])->name('admin.concertmanage');
    Route::get('/ticketmanage', [AdminController::class, 'ticketmanage'])->name('admin.ticketmanage');
    Route::get('/accountmanage', [AdminController::class, 'accountmanage'])->name('admin.accountmanage');
    Route::get('/editprofadmin', [AdminController::class, 'editprofadmin'])->name('admin.editprofadmin');
    Route::get('/admin/ticket/{id}/edit', [AdminController::class, 'editTicket'])
        ->name('admin.ticket.edit');
    Route::post('/admin/ticket/{id}/update', [AdminController::class, 'updateTicket'])
        ->name('admin.ticket.update');
    Route::get('/concertmanage/create', [AdminController::class, 'createTicket'])
        ->name('admin.ticket.create');
    Route::post('/concertmanage/store', [AdminController::class, 'storeTicket'])
        ->name('admin.ticket.store');
    Route::get('/categorymanage', [AdminController::class, 'showCategory'])
        ->name('admin.categorymanage');

    Route::get('/category/create', [AdminController::class, 'createCategory'])
        ->name('admin.category.create');

    Route::post('/category/store', [AdminController::class, 'storeCategory'])
        ->name('admin.category.store');

    Route::get('/category/{id}/edit', [AdminController::class, 'editCategory'])
        ->name('admin.category.edit');

    Route::post('/category/{id}/update', [AdminController::class, 'updateCategory'])
        ->name('admin.category.update');

    Route::post('/category/{id}/delete', [AdminController::class, 'deleteCategory'])
        ->name('admin.category.delete');

});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboardadmin');
    }

    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
