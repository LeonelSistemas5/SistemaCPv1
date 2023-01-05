<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\JoinController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\TwoFaController;
use App\Http\Livewire\Admin\AuditTrails;
use App\Http\Livewire\Admin\Cajas\Conceptos\Conceptos;
use App\Http\Livewire\Admin\Cajas\Pagos\Pagos;
use App\Http\Livewire\Admin\Colegios\Capitulos\Capitulos;
use App\Http\Livewire\Admin\Colegios\General\Colegios;
use App\Http\Livewire\Admin\Colegios\Sedes\Sedes;
use App\Http\Livewire\Admin\Cursos\Cursos;
use App\Http\Livewire\Admin\Cursos\Inscritos;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\SentEmails\SentEmails;
use App\Http\Livewire\Admin\SentEmails\SentEmailsBody;
use App\Http\Livewire\Admin\Settings\Settings;
use App\Http\Livewire\Admin\Tramites\OficinaShow;
use App\Http\Livewire\Admin\Tramites\RequisitosShow;
use App\Http\Livewire\Admin\Tramites\TypeTramite;
use App\Http\Livewire\Admin\Users\EditUser;
use App\Http\Livewire\Admin\Users\ShowUser;
use App\Http\Livewire\Admin\Users\Users;
use App\Http\Livewire\Admin\Usuarios\Administradores\Administradores;
use App\Http\Livewire\Admin\Usuarios\Colegiados\Colegiados;
use App\Http\Livewire\Admin\Usuarios\Roles\Roles;
use App\Http\Livewire\Welcome;
use Illuminate\Support\Facades\Route;

Route::get('/', Welcome::class);

//unauthenticated
Route::middleware(['web', 'guest'])->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.reset.update');

    Route::get('join/{token}', [JoinController::class, 'index'])->name('join');
    Route::put('join/{id}', [JoinController::class, 'update'])->name('join.update');
});

//authenticated
Route::middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware'])->prefix('admin')->group(function () {
    Route::get('2fa', [TwoFaController::class, 'index'])->name('2fa');
    Route::post('2fa', [TwoFaController::class, 'update'])->name('2fa.update');
    Route::get('2fa-setup', [TwoFaController::class, 'setup'])->name('2fa-setup');
    Route::post('2fa-setup', [TwoFaController::class, 'setupUpdate'])->name('2fa-setup.update');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/', Dashboard::class)->name('admin');

    Route::get('profile/{user}', ShowUser::class)->name('admin.profile');
    Route::get('profile/{user}/edit', EditUser::class)->name('admin.profile.edit');

    Route::get('cursos', Cursos::class)->name('admin.cursos.index');
    Route::get('cursos/inscritos/{curso}', Inscritos::class)->name('admin.cursos.inscritos');

    Route::get('cajas')->name('admin.cajas');
    Route::get('cajas/pagos', Pagos::class)->name('admin.cajas.pagos');
    Route::get('cajas/conceptos', Conceptos::class)->name('admin.cajas.conceptos');

    Route::get('tramites')->name('admin.tramites.index');
    Route::get('tramites/oficina', OficinaShow::class)->name('admin.tramites.oficina');
    Route::get('tramites/tipotramite', TypeTramite::class)->name('admin.tramites.tipotramite');
    Route::get('tramites/requisito', RequisitosShow::class)->name('admin.tramites.requisito');

    Route::get('reportes')->name('admin.reportes.index');

    Route::get('usuarios')->name('admin.usuarios');
    Route::get('usuarios/administradores', Administradores::class)->name('admin.usuarios.administradores');
    Route::get('usuarios/colegiados', Colegiados::class)->name('admin.usuarios.colegiados');
    Route::get('usuarios/roles', Roles::class)->name('admin.usuarios.roles');

    Route::get('colegios')->name('admin.colegios');
    Route::get('colegios/general',Colegios::class)->name('admin.colegios.general');
    Route::get('colegios/sedes',Sedes::class)->name('admin.colegios.sedes');
    Route::get('colegios/capitulos',Capitulos::class)->name('admin.colegios.capitulos');

    Route::get('settings/audit-trails', AuditTrails::class)->name('admin.settings.audit-trails.index');
    Route::get('settings/sent-emails', SentEmails::class)->name('admin.settings.sent-emails');
    Route::get('settings/sent-emails-body/{id}', SentEmailsBody::class)->name('admin.settings.sent-emails.body');
});

//Admin only routes
Route::middleware(['web', 'auth', 'activeUser', 'IpCheckMiddleware', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('settings/system-settings', Settings::class)->name('admin.settings');
});
