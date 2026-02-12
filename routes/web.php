<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProjectRequestController;
use App\Http\Controllers\TelechargerCVController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\AdminRequestController;


/* ==============================
   Pages publiques
============================== */
Route::get('/', [HomeController::class, 'index'])->name('home');

// Redirige toute requête GET /contact vers la page d'accueil

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/project-request/{project}', [ProjectRequestController::class, 'create'])->name('project.request.create');
Route::post('/project-request', [ProjectRequestController::class, 'store'])->name('project.request.store');

Route::get('/telecharger-cv', [TelechargerCVController::class, 'create'])->name('telecharger_cv.create');
Route::post('/telecharger-cv', [TelechargerCVController::class, 'store'])->name('telecharger_cv.store');

/* ==============================
   Authentification
============================== */
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/* Mot de passe oublié / réinitialisation */
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.update');

/* ==============================
   Dashboard & admin (auth requis)
============================== */
Route::middleware('auth')->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');

    /* ===== Projets / demandes ===== */
    // Commenté car doublon avec /dashboard/demandes
    /*
    Route::prefix('dashboard')->name('admin.')->group(function () {
        Route::get('/project_requests', [ProjectRequestController::class, 'index'])->name('project.requests.index');
        Route::patch('/project_requests/{requestItem}/{status}', [ProjectRequestController::class, 'updateStatus'])->name('project.requests.status');
    });
    */

    /* ===== CV ===== */
    Route::get('/admin/telecharger-cv', [TelechargerCVController::class, 'index'])->name('admin.telecharger_cv.index');
    Route::post('/admin/telecharger-cv/{request}/approve', [TelechargerCVController::class, 'approve'])->name('admin.telecharger_cv.approve');
    Route::get('/admin/telecharger-cv/{request}/download', [TelechargerCVController::class, 'download'])->name('admin.telecharger_cv.download');

    /* ===== Profil ===== */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.show');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* ===== Settings ===== */
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::match(['post', 'patch'], '/settings', [SettingsController::class, 'update'])->name('settings.update');

});

/* ===== Routes admin supplémentaires ===== */
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/contact', [AdminContactController::class, 'index'])->name('contact.index'); // liste des messages
    Route::post('contact/{contact}/reply', [AdminContactController::class, 'reply'])->name('contact.reply');
    Route::get('/contact/{contact}', [AdminContactController::class, 'show'])->name('contact.show'); // voir un message
    Route::delete('/contact/{contact}', [AdminContactController::class, 'destroy'])->name('contact.destroy'); // supprimer

    Route::get('/cv', [TelechargerCVController::class, 'index'])->name('cv.index');
    Route::get('/projects', [ProjectRequestController::class, 'index'])->name('projects.index');
});

/* ===== Route pour mise à jour status depuis dashboard ===== */
Route::middleware('auth')->put('/dashboard/request-items/{id}/status', [DashboardController::class, 'updateStatus'])->name('dashboard.request-items.status');

Route::middleware('auth')->prefix('dashboard')->name('admin.')->group(function () {
    // Page liste des demandes
    Route::get('/demandes', [ProjectRequestController::class, 'index'])->name('project.requests.index');

    // Accepter / Refuser une demande

});

Route::middleware('auth')->get(
    '/dashboard/history',
    [HistoryController::class, 'index']
)->name('admin.history');

/* ===== ProjectController (Admin) ===== */
// Commenté les doublons pour éviter conflit de nom de route 'admin.projects.store'
/*
Route::prefix('admin')->name('admin.')->group(function () {
    Route::post('/projects/store', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('projects.store');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('projects/create', [App\Http\Controllers\Admin\ProjectController::class, 'create'])->name('projects.create');
    Route::post('projects', [App\Http\Controllers\Admin\ProjectController::class, 'store'])->name('projects.store');
});
*/

use App\Http\Controllers\Admin\ProjectController;

// Page principale des projets
Route::get('/admin/projects', [ProjectController::class, 'index'])->name('admin.projects');

// (Optionnel) Recherche dynamique dans les projets
Route::get('/projects/search', [ProjectController::class, 'search'])->name('projects.search');

// routes/web.php
Route::get('/admin/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
Route::post('/admin/projects', [ProjectController::class, 'store'])->name('admin.projects.store');

Route::post('/admin/projects/delete-by-date', [ProjectController::class, 'destroyByDate'])->name('admin.projects.destroyByDate');

use App\Http\Controllers\RechercheController;

Route::get('/ajax-recherche', [RechercheController::class, 'ajaxRecherche'])->name('ajax.recherche');





//la page about proteger
Route::middleware('auth')->get('/profile/about', [ProfileController::class, 'about'])->name('profile.about');

Route::middleware('auth')->get('/profile/cv', [ProfileController::class, 'cv'])->name('profile.cv');


/*
|--------------------------------------------------------------------------
| Routes Admin Requests
|--------------------------------------------------------------------------
|
| Toutes les routes pour gérer les demandes projets et CV dans le dashboard.
|
*/

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | PAGE PRINCIPALE : LISTE DES DEMANDES
    |--------------------------------------------------------------------------
    */
    Route::get('/requests', [AdminRequestController::class, 'index'])
        ->name('requests.index');

    /*
    |--------------------------------------------------------------------------
    | VOIR PLUS (DETAILS)
    |--------------------------------------------------------------------------
    */
    Route::get('/requests/project/{id}', [AdminRequestController::class, 'showProject'])
        ->name('requests.project.show');

    Route::get('/requests/cv/{id}', [AdminRequestController::class, 'showCV'])
        ->name('requests.cv.show');

    /*
    |--------------------------------------------------------------------------
    | CHANGER STATUT (ACCEPTER / REFUSER) - AJAX
    |--------------------------------------------------------------------------
    */
    Route::put('/requests/project/{id}/status', [AdminRequestController::class, 'updateProjectStatus'])
        ->name('requests.project.status');

    Route::put('/requests/cv/{id}/status', [AdminRequestController::class, 'updateCVStatus'])
        ->name('requests.cv.status');

    /*
    |--------------------------------------------------------------------------
    | ENVOI FICHIER (DEPUIS VOIR PLUS)
    |--------------------------------------------------------------------------
    */
    Route::post('/requests/project/{id}/send', [AdminRequestController::class, 'sendProject'])
        ->name('requests.project.send');

    Route::post('/requests/cv/{id}/send', [AdminRequestController::class, 'sendCV'])
        ->name('requests.cv.send');
});


use App\Http\Controllers\Admin\DownloadController;


// Téléchargement projet sécurisé (lien signé)
Route::get('/download/project/{id}', [DownloadController::class, 'project'])
    ->name('download.project')
    ->middleware('signed'); // <--- obligatoire pour la sécurité

// Téléchargement CV sécurisé (lien signé)
Route::get('/download/cv/{id}', [DownloadController::class, 'cv'])
    ->name('download.cv')
    ->middleware('signed'); // <--- obligatoire pour la sécurité
