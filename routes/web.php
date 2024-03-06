<?php

use App\Http\Controllers\CotizadorController;
use App\Http\Controllers\MaterialesController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

// ============================================== COTIZADOR ======================================================== //

Route::get('/', [CotizadorController::class, 'index'])->name('Cotizaciones');

Route::get('apiCotizaciones', [CotizadorController::class, 'apiCotizaciones'])->name('apiCotizaciones');

Route::get('apiMateriales', [CotizadorController::class, 'apiMateriales'])->name('apiMateriales');

Route::get('apiMaterialesImg/{id}', [CotizadorController::class, 'apiMaterialesImg']);

Route::get('apiTintas', [CotizadorController::class, 'apiTintas'])->name('apiTintas');

Route::get('apiAcabados', [CotizadorController::class, 'apiAcabados'])->name('apiAcabados');

Route::get('apiAdicionales', [CotizadorController::class, 'apiAdicionales'])->name('apiAdicionales');

Route::get('obtenerCotizacion', [CotizadorController::class, 'obtenerCotizacion'])->name('obtenerCotizacion');

Route::get('obtenerClientes', [CotizadorController::class, 'obtenerClientes'])->name('obtenerClientes');

Route::get('obtenerFolio', [CotizadorController::class, 'obtenerFolio'])->name('obtenerFolio');

Route::get('cotizacionTMP', [CotizadorController::class, 'cotizacionTMP'])->name('cotizacionTMP');

Route::get('updateCotizacionTMP', [CotizadorController::class, 'updateCotizacionTMP'])->name('updateCotizacionTMP');

Route::get('eliminarCotizacionTMP', [CotizadorController::class, 'eliminarCotizacionTMP'])->name('eliminarCotizacionTMP');

Route::get('obtenerMaterial', [CotizadorController::class, 'obtenerMaterial'])->name('obtenerMaterial');

Route::get('obtenerTinta', [CotizadorController::class, 'obtenerTinta'])->name('obtenerTinta');

Route::get('obtenerAcabado', [CotizadorController::class, 'obtenerAcabado'])->name('obtenerAcabado');

Route::get('obtenerAdicional', [CotizadorController::class, 'obtenerAdicional'])->name('obtenerAdicional');

Route::get('obtenerTintaAcabado', [CotizadorController::class, 'obtenerTintaAcabado'])->name('obtenerTintaAcabado');

Route::get('obtenerTintaTP', [CotizadorController::class, 'obtenerTintaTP'])->name('obtenerTintaTP');

Route::get('modalMateriales', [CotizadorController::class, 'modalMateriales'])->name('modalMateriales');

Route::get('modalTintas', [CotizadorController::class, 'modalTintas'])->name('modalTintas');

Route::get('modalAcabados', [CotizadorController::class, 'modalAcabados'])->name('modalAcabados');

Route::get('obtenerPrimerMaterial', [CotizadorController::class, 'obtenerPrimerMaterial'])->name('obtenerPrimerMaterial');

Route::get('addMaterialCotizador', [CotizadorController::class, 'addMaterialCotizador'])->name('addMaterialCotizador');

Route::get('addTintaCotizador', [CotizadorController::class, 'addTintaCotizador'])->name('addTintaCotizador');

Route::get('addAcabadoCotizador', [CotizadorController::class, 'addAcabadoCotizador'])->name('addAcabadoCotizador');

Route::get('addAdicionalCotizador', [CotizadorController::class, 'addAdicionalCotizador'])->name('addAdicionalCotizador');

Route::get('editarMaterialCotizaciones', [CotizadorController::class, 'editarMaterialCotizaciones'])->name('editarMaterialCotizaciones');

Route::get('editarTintaCotizaciones', [CotizadorController::class, 'editarTintaCotizaciones'])->name('editarTintaCotizaciones');

Route::get('editarAcabadoCotizaciones', [CotizadorController::class, 'editarAcabadoCotizaciones'])->name('editarAcabadoCotizaciones');

Route::get('editarAdicionalCotizaciones', [CotizadorController::class, 'editarAdicionalCotizaciones'])->name('editarAdicionalCotizaciones');

Route::get('eliminarMaterialCotizador', [CotizadorController::class, 'eliminarMaterialCotizador'])->name('eliminarMaterialCotizador');

Route::get('eliminarTintaCotizador', [CotizadorController::class, 'eliminarTintaCotizador'])->name('eliminarTintaCotizador');

Route::get('eliminarAcabadoCotizador', [CotizadorController::class, 'eliminarAcabadoCotizador'])->name('eliminarAcabadoCotizador');

Route::get('eliminarAdicionalCotizador', [CotizadorController::class, 'eliminarAdicionalCotizador'])->name('eliminarAdicionalCotizador');

Route::get('eliminarMaterialesCotizador', [CotizadorController::class, 'eliminarMaterialesCotizador'])->name('eliminarMaterialesCotizador');

Route::get('obtenerMatEspCombo', [CotizadorController::class, 'obtenerMatEspCombo'])->name('obtenerMatEspCombo');

Route::get('obtenerMaterialesE', [CotizadorController::class, 'obtenerMaterialesE'])->name('obtenerMaterialesE');

Route::get('generarCotizacion', [CotizadorController::class, 'generarCotizacion'])->name('generarCotizacion');

Route::get('obtenerTotalDetalle', [CotizadorController::class, 'obtenerTotalDetalle'])->name('obtenerTotalDetalle');

Route::get('obtenerImpresionVuelta', [CotizadorController::class, 'obtenerImpresionVuelta'])->name('obtenerImpresionVuelta');

Route::get('clonarDetalle', [CotizadorController::class, 'clonarDetalle'])->name('clonarDetalle');

Route::get('sinCambiosCotizacion', [CotizadorController::class, 'sinCambiosCotizacion'])->name('sinCambiosCotizacion');

Route::get('sinCambiosNuevaCotizacion', [CotizadorController::class, 'sinCambiosNuevaCotizacion'])->name('sinCambiosNuevaCotizacion');

Route::get('actualizarMedidasMaterial', [CotizadorController::class, 'actualizarMedidasMaterial'])->name('actualizarMedidasMaterial');

Route::get('pdf/imprimirCotizacionGrid/{id}', [CotizadorController::class, 'imprimirCotizacionGrid']);

Route::get('pdf/imprimirCotizacionOP/{id}', [CotizadorController::class, 'imprimirCotizacionOP']);

Route::get('pdf/imprimirCotizacion/{id}', [CotizadorController::class, 'imprimirCotizacion']);

Route::get('pdf/imprimirCotizacionAcabados/{id}', [CotizadorController::class, 'imprimirCotizacionAcabados']);

// ============================================== MATERIALES ======================================================== //

Route::get('materiales', [MaterialesController::class, 'index'])->name('Materiales');

Route::get('apiMaterialesIndex', [MaterialesController::class, 'apiMaterialesIndex'])->name('apiMaterialesIndex');

Route::get('obtenerMaterialIndex', [MaterialesController::class, 'obtenerMaterialIndex'])->name('obtenerMaterialIndex');

Route::get('guardarMaterialIndex', [MaterialesController::class, 'guardarMaterialIndex'])->name('guardarMaterialIndex');

Route::get('activarMaterialIndex', [MaterialesController::class, 'activarMaterialIndex'])->name('activarMaterialIndex');

// ============================================== ACABADOS ======================================================== //

Route::get('apiAcabadosIndex', [MaterialesController::class, 'apiAcabadosIndex'])->name('apiAcabadosIndex');

Route::get('obtenerAcabadoIndex', [MaterialesController::class, 'obtenerAcabadoIndex'])->name('obtenerAcabadoIndex');

Route::get('guardarAcabadoIndex', [MaterialesController::class, 'guardarAcabadoIndex'])->name('guardarAcabadoIndex');

Route::get('activarAcabadoIndex', [MaterialesController::class, 'activarAcabadoIndex'])->name('activarAcabadoIndex');

// ============================================== TINTAS ======================================================== //

Route::get('apiTintasIndex', [MaterialesController::class, 'apiTintasIndex'])->name('apiTintasIndex');

Route::get('obtenerTintaIndex', [MaterialesController::class, 'obtenerTintaIndex'])->name('obtenerTintaIndex');

Route::get('guardarTintaIndex', [MaterialesController::class, 'guardarTintaIndex'])->name('guardarTintaIndex');

Route::get('activarTintaIndex', [MaterialesController::class, 'activarTintaIndex'])->name('activarTintaIndex');

// ============================================== SALIR ======================================================== //

Route::get('/logout', function () {
    Session::flush();

    return redirect("/");
})->name('Logout');

Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');

    $array = array();
    foreach (Cookie::get() as $key => $item) {
        $array[] = cookie($key, null, -2628000, null, null);
    }
    return back()->withCookies($array);

})->name('cache');
