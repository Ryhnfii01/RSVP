<?php

use App\Http\Controllers\InvitationController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\EventManagementController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\InvitationListController;
use App\Http\Controllers\Admin\WishController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Homepage - Template Selector
Route::get('/', [InvitationController::class, 'home'])->name('home');

// Template 1 - Elegant Modern (existing template)
Route::prefix('template-1')->name('template1.')->group(function () {
    Route::get('/', [InvitationController::class, 'template1'])->name('index');
    Route::post('/rsvp', [GuestController::class, 'store'])->name('rsvp.store')->middleware('throttle:rsvp');
});

// Template 2 - Classic Romantic (new template)
Route::prefix('template-2')->name('template2.')->group(function () {
    Route::get('/', [InvitationController::class, 'template2'])->name('index');
    Route::post('/rsvp', [GuestController::class, 'store'])->name('rsvp.store')->middleware('throttle:rsvp');
});

// Template 3 - Elegant Nature (nature-inspired template)
Route::prefix('template-3')->name('template3.')->group(function () {
    Route::get('/', [InvitationController::class, 'template3'])->name('index');
    Route::post('/rsvp', [GuestController::class, 'store'])->name('rsvp.store')->middleware('throttle:rsvp');
});

// Template 4 - Bugis Emerald (traditional Bugis template)
Route::prefix('template-4')->name('template4.')->group(function () {
    Route::get('/', [InvitationController::class, 'template4'])->name('index');
    Route::post('/rsvp', [GuestController::class, 'store'])->name('rsvp.store')->middleware('throttle:rsvp');
});

// Undangan publik per acara
Route::get('/u/{event:slug}', [InvitationController::class, 'show'])->name('invitation.show');
Route::post('/u/{event:slug}/rsvp', [GuestController::class, 'store'])->name('invitation.rsvp')->middleware('throttle:rsvp');
Route::get('/u/{event:slug}/{code}', [InvitationController::class, 'personal'])
    ->where('code', '[a-z0-9]{6,16}')
    ->name('invitation.personal')
    ->middleware('throttle:personal-link');

// Legacy route redirect
Route::get('/invitation', function () {
    return redirect()->route('template1.index');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes (Protected)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'auth.session'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.index');

    // Guests Management
    Route::get('/guests', [AdminController::class, 'guests'])->name('guests');
    Route::get('/guests/{id}', [AdminController::class, 'showGuest'])->name('guests.show');
    Route::delete('/guests/{id}', [AdminController::class, 'deleteGuest'])->name('guests.delete');
    Route::get('/guests/export/csv', [AdminController::class, 'exportGuests'])->name('guests.export');

    // Daftar undangan + link personal
    Route::get('/invitations', [InvitationListController::class, 'index'])->name('invitations.index');
    Route::post('/invitations', [InvitationListController::class, 'store'])->name('invitations.store');
    Route::post('/invitations/import', [InvitationListController::class, 'import'])->name('invitations.import');
    Route::get('/invitations/template.csv', [InvitationListController::class, 'template'])->name('invitations.template');
    Route::delete('/invitations/{invitation}', [InvitationListController::class, 'destroy'])->name('invitations.destroy');
    Route::put('/invitations/message', [InvitationListController::class, 'updateMessage'])->name('invitations.message');
    Route::get('/invitations/export.csv', [InvitationListController::class, 'export'])->name('invitations.export');
    Route::get('/invitations/{invitation}/edit', [InvitationListController::class, 'edit'])->name('invitations.edit');
    Route::put('/invitations/{invitation}', [InvitationListController::class, 'update'])->name('invitations.update');
    Route::get('/invitations/{invitation}/whatsapp', [InvitationListController::class, 'whatsapp'])->name('invitations.whatsapp');

    // Akun Saya (semua user)
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/account/profile', [AccountController::class, 'updateProfile'])->name('account.profile');
    Route::put('/account/password', [AccountController::class, 'updatePassword'])->name('account.password');

    // Moderasi ucapan tamu
    Route::get('/wishes', [WishController::class, 'index'])->name('wishes.index');
    Route::put('/wishes/settings', [WishController::class, 'updateSettings'])->name('wishes.settings');
    Route::post('/wishes/approve-all', [WishController::class, 'approveAll'])->name('wishes.approve-all');
    Route::put('/wishes/{guest}', [WishController::class, 'updateStatus'])->name('wishes.status');
    Route::delete('/wishes/{guest}', [WishController::class, 'destroy'])->name('wishes.destroy');

    // Galeri foto
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::post('/gallery/{photo}/move', [GalleryController::class, 'move'])->name('gallery.move');
    Route::delete('/gallery/{photo}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // Settings
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');

    // Event Settings
    Route::get('/event-settings', [AdminController::class, 'editEventSettings'])->name('event-settings.edit');
    Route::put('/event-settings', [AdminController::class, 'updateEventSettings'])->name('event-settings.update');

    // Super admin: pilih acara, kelola semua acara dan akun client
    Route::middleware('role:super_admin')->group(function () {
        Route::post('/switch-event', [AdminController::class, 'switchEvent'])->name('switch-event');

        Route::get('/events', [EventManagementController::class, 'index'])->name('events.index');
        Route::get('/events/create', [EventManagementController::class, 'create'])->name('events.create');
        Route::post('/events', [EventManagementController::class, 'store'])->name('events.store');
        Route::post('/events/{event}/manage', [EventManagementController::class, 'manage'])->name('events.manage');

        Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
        Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
        Route::put('/clients/{client}/password', [ClientController::class, 'resetPassword'])->name('clients.password');
        Route::put('/clients/{client}/phone', [ClientController::class, 'updatePhone'])->name('clients.phone');
    });
});
