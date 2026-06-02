<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\BoletoPublicoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BoletoAdminController;
use App\Http\Controllers\Admin\ContribuyenteAdminController;
use App\Http\Controllers\Admin\TablaArbitrioController;
use App\Http\Controllers\Admin\ConfiguracionMunicipalController;
use App\Http\Controllers\Admin\ReporteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
| Accesibles sin autenticación para ciudadanos.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

// Flujo de generación de boleto
Route::get('/generar-boleto', [BoletoPublicoController::class, 'buscarDpi'])->name('boleto.buscar');
Route::post('/generar-boleto/verificar', [BoletoPublicoController::class, 'verificarDpi'])->name('boleto.verificar-dpi');
Route::get('/generar-boleto/registrar/{dpi}', [BoletoPublicoController::class, 'registrar'])->name('boleto.registrar');
Route::post('/generar-boleto/guardar', [BoletoPublicoController::class, 'guardarContribuyente'])->name('boleto.guardar');

// Resumen y pago
Route::get('/boleto/{codigo}/resumen', [BoletoPublicoController::class, 'resumen'])->name('boleto.resumen');
Route::post('/boleto/{codigo}/pagar', [BoletoPublicoController::class, 'procesarPago'])->name('boleto.pagar');
Route::get('/boleto/{codigo}/confirmacion', [BoletoPublicoController::class, 'confirmacion'])->name('boleto.confirmacion');
Route::get('/boleto/{codigo}/descargar', [BoletoPublicoController::class, 'descargar'])->name('boleto.descargar');

// Verificación pública por código QR
Route::get('/verificar/{codigo}', [BoletoPublicoController::class, 'verificar'])->name('boleto.verificar');

/*
|--------------------------------------------------------------------------
| Rutas Administrativas
|--------------------------------------------------------------------------
| Protegidas con middleware de autenticación.
*/

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Gestión de boletos
    Route::resource('boletos', BoletoAdminController::class)->except(['edit', 'update']);
    Route::post('boletos/{boleto}/anular', [BoletoAdminController::class, 'anular'])->name('boletos.anular');
    Route::get('boletos/{boleto}/pdf', [BoletoAdminController::class, 'descargarPdf'])->name('boletos.pdf');

    // Gestión de contribuyentes
    Route::resource('contribuyentes', ContribuyenteAdminController::class)->except(['create', 'store']);

    // Tabla de arbitrios
    Route::resource('tabla-arbitrios', TablaArbitrioController::class);

    // Configuración municipal
    Route::get('configuracion', [ConfiguracionMunicipalController::class, 'edit'])->name('configuracion.edit');
    Route::put('configuracion', [ConfiguracionMunicipalController::class, 'update'])->name('configuracion.update');

    // Reportes
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');
    Route::post('reportes/pdf', [ReporteController::class, 'generarPdf'])->name('reportes.pdf');
    Route::post('reportes/excel', [ReporteController::class, 'generarExcel'])->name('reportes.excel');
});

require __DIR__.'/settings.php';
