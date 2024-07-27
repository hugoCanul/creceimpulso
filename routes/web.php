<?php

use App\Livewire\Administration\Coordinadores\CoordinatorController;
use App\Livewire\Administration\Rates\RatesController;
use App\Livewire\Permission\Role\RoleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([ 'auth:sanctum', config('jetstream.auth_session'), 'verified',
])->group(function () {
    Route::get('/dashboard', function () { return view('dashboard');})->name('dashboard');

     // Inicio de Routes propias
    //  Route::middleware(['role:SuperUser'])->group( function() {
        Route::group([ 'prefix' => 'Permisos' ], function(){
            Route::get('Roles', RoleController::class)->name('indexRoles');
            // Route::get('AsignarPermimsos', AsignPrmissionController::class)->name('IndexAsignar');
            // Route::get('UsuariosNuevos', UserController::class)->name('IndexUsers');
        });
    // });

    Route::group(['prefix' => 'Administracion'], function(){
        Route::get('Coordinator', CoordinatorController::class)->name('indexcoordinator');
        Route::get('TazasInteres', RatesController::class)->name('IndexRates');
    });

});
