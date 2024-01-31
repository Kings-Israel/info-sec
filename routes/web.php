<?php

use App\Models\User;
use App\Models\Session;
use App\Models\Visitor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\VisitorController;

Route::get('/guest/{id}/pdf', [VisitorController::class, 'guestPdf'])->name('guest-pdf');

Route::get('/', function () {
    return view('auth/login');
});

Route::post('/guest/register', [UserController::class, 'store'])->name('user.store');

Route::post('/add-session', [SessionController::class, 'store'])->name('session.store')->middleware(['auth'])->name('session');
Route::post('/add-user', [UserController::class, 'store'])->name('user.store')->middleware(['auth'])->name('user');
Route::get('/guest/register/{id}/success', function ($id) {
    $user = User::find($id);
    return view('success', compact('user'));
})->name('success');

Route::get('/guest/{visitor}/edit', [VisitorController::class, 'edit'])->name('edit-guest');
Route::post('/guest/{visitor}/update', [VisitorController::class, 'update'])->name('update-guest');

Route::get('/session/{session}/edit', [SessionController::class, 'edit'])->name('edit-session');
Route::post('/session/{session}/update', [SessionController::class, 'update'])->name('update-session');

Route::get('/guest/{id}/view', function ($id) {
    $guest = Visitor::findOrFail($id);
    $sessions = $guest->sessions()->get();
    return view('view-guest', compact('guest', 'sessions'));
})->middleware(['auth'])->name('view-guest');
Route::get('/visitor/{id}/download', 'VisitorController@download')->middleware(['auth'])->name('visitor.download');

Route::post('/visitors/import', [VisitorController::class, 'import'])->middleware(['auth'])->name('visitors.import');

Route::get('/visitor/{id}', [VisitorController::class, 'show'])->name('visitor.view');

Route::get('/session/{id}/view', function ($id) {
    $session = Session::findOrFail($id);
    $guests = $session->visitors()->count();
    return view('view-session', compact('session', 'guests'));
})->middleware(['auth'])->name('view-session');


Route::get('/dashboard', function () {
    $users = User::all();
    $guests = Visitor::all();
    $sessions = Session::all();
    $session_days = Session::all()->groupBy('session_date');
    return view('dashboard', compact('users', 'guests', 'sessions', 'session_days'));
})->middleware(['auth'])->name('dashboard');

Route::get('/sessions', function () {
    $sessions = Session::all();
    return view('sessions', compact('sessions'));
})->middleware(['auth'])->name('sessions');

Route::get('/add-session', function () {
    return view('add-session');
})->middleware(['auth'])->name('add-session');

Route::get('/session/{id}/view', function ($id) {
    $session = Session::find($id);
    return view('view-session', compact('session'));
})->middleware(['auth'])->name('view-session');

Route::get('/guest', function () {
    return view('guest');
})->middleware(['auth'])->name('guest');

Route::group(['middleware' => ['auth', 'is_admin']], function() {
    Route::get('/add-guest', function () {
        $sessions = Session::all();
        return view('add-guest', compact('sessions'));
    })->name('add-guest');

    Route::post('/add-guest', [VisitorController::class, 'store'])->name('guest.store')->name('guest');
});

Route::get('/users', function () {
    $users = User::where('id', '!=', 1)->get();
    return view('users', compact('users'));
})->middleware(['auth'])->name('users');

Route::get('/add-user', function () {
    return view('add-users');
})->middleware(['auth'])->name('add-user');

Route::get('/guests/search', [VisitorController::class, 'search'])->middleware(['auth'])->name('guest.search');


Route::put('/guest/{id}/delete', [VisitorController::class, 'delete'])->name('guest.delete')->middleware(['auth']);
Route::put('/session/{id}/delete', [SessionController::class, 'delete'])->name('session.delete')->middleware(['auth']);

Route::get('/report', [SessionController::class, 'report'])->name('report');

require __DIR__.'/auth.php';
