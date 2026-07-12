<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('/medecins', 'medecins.index')->name('medecins.index');
Route::view('/specialites', 'specialites.index')->name('specialites.index');
Route::get('/specialites/{slug}', fn ($slug) => view('specialites.index', ['specialite_slug' => $slug]))
    ->name('specialites.show');
Route::view('/centres-de-sante', 'centres-sante.index')->name('centres-sante.index');
Route::view('/aide', 'aide')->name('aide');
Route::view('/a-propos', 'apropos')->name('apropos');
Route::view('/inscrire-cabinet', 'cabinets.register')->name('cabinets.register.show');
Route::post('/inscrire-cabinet', fn () => back()->with('success', 'Demande cabinet recue.'))->name('cabinets.register.submit');
Route::view('/connexion-cabinet', 'auth.login-cabinet')->name('cabinets.login.show');

Route::get('/register/patient', [PatientController::class, 'showForm'])->name('register.patient');
Route::post('/register/patient', [PatientController::class, 'register'])->name('register.patient.submit');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/rendez-vous/nouveau', [AppointmentController::class, 'create'])->name('rendezvous.create');

Route::middleware(['auth'])->group(function () {
    Route::post('/rendezvous', [AppointmentController::class, 'store'])->name('rendezvous.store');
    Route::get('/rendezvous/{appointment}', [AppointmentController::class, 'show'])->name('rendezvous.show');
    Route::get('/rendezvous/{appointment}/edit', [AppointmentController::class, 'edit'])->name('rendezvous.edit');
    Route::delete('/rendezvous/{appointment}', [AppointmentController::class, 'destroy'])->name('rendezvous.destroy');
});

Route::prefix('patient')->middleware(['auth', 'can:access-patient'])->group(function () {
    Route::redirect('/', '/patient/dashboard');
    Route::view('/dashboard', 'patient.dashboard')->name('patient.dashboard');
    Route::view('/dossier', 'patient.dossier')->name('patient.dossier');
    Route::get('/dossier/export', fn () => back()->with('status', 'Export PDF disponible prochainement.'))->name('patient.dossier.export');
    Route::post('/dossier/documents', fn () => back()->with('success', 'Document enregistre.'))->name('patient.documents.store');
    Route::view('/profil', 'patient.profile')->name('patient.profile');

    Route::post('/profil/update', [PatientProfileController::class, 'updateProfile'])->name('patient.profile.update');
    Route::post('/profil/avatar', [PatientProfileController::class, 'updateAvatar'])->name('patient.avatar.update');
    Route::post('/profil/password', [PatientProfileController::class, 'updatePassword'])->name('patient.password.update');
    Route::post('/preferences', [PatientProfileController::class, 'updatePreferences'])->name('patient.preferences.update');
});

Route::prefix('admin')->middleware(['auth', 'can:access-admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::post('/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::view('/rendez-vous', 'rendezvous.tableau_bord')->name('admin.rendezvous');
    Route::get('/statistiques', [AdminController::class, 'rapport'])->name('admin.statistiques');
    Route::get('/settings', fn () => back()->with('status', 'Parametres disponibles prochainement.'))->name('admin.settings');
});

Route::prefix('medecin')->middleware(['auth', 'can:access-medecin'])->group(function () {
    Route::view('/rendez-vous', 'rendezvous.tableau_bord')->name('medecin.rendezvous');
    Route::view('/nouvelle-consultation', 'patients.nouvelle_consultation')->name('medecin.consultation');
    Route::post('/consultations/{patient?}', fn () => back()->with('success', 'Consultation enregistree.'))
        ->name('consultations.store');
});
