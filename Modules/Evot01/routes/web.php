<?php

use Illuminate\Support\Facades\Route;
use Modules\Evot01\Http\Controllers\Laporan\HasilvotingController;
use Modules\Evot01\Http\Controllers\Master\KandidatController;
use Modules\Evot01\Http\Controllers\Master\PemilihController;
use Modules\Evot01\Http\Controllers\Master\PeriodeController;

// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('evot01s', Evot01Controller::class)->names('evot01');
// });

Route::prefix('evot01')->group(function() {
    /* master - periode */    
    Route::get('/master/periode', [PeriodeController::class, 'index'])->name('evot01.master.periode.index')->middleware('auth'); /* halaman periode */
    Route::get('/master/periodeshow', [PeriodeController::class, 'show'])->name('evot01.master.periode_show')->middleware('auth'); /* menampilkan data periode pada datatable javascript */
    Route::post('/master/periodecreate', [PeriodeController::class, 'create'])->name('evot01.master.periode_create')->middleware('auth'); /* menambah periode */
    Route::get('/master/periodeedit/{id}', [PeriodeController::class, 'edit'])->name('evot01.master.periode_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::delete('/master/periodedestroy/{id}', [PeriodeController::class, 'destroy'])->name('evot01.master.periode_destroy')->middleware('auth'); /* hapus data periode */
    
    /* master - kandidat */    
    Route::get('/master/kandidat', [KandidatController::class, 'index'])->name('evot01.master.kandidat.index')->middleware('auth'); /* halaman kandidat */
    Route::get('/master/kandidatshow', [KandidatController::class, 'show'])->name('evot01.master.kandidat_show')->middleware('auth'); /* menampilkan data kandidat pada datatable javascript */
    Route::post('/master/kandidatcreate', [KandidatController::class, 'create'])->name('evot01.master.kandidat_create')->middleware('auth'); /* menambah kandidat */
    Route::get('/master/kandidatedit/{id}', [KandidatController::class, 'edit'])->name('evot01.master.kandidat_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::delete('/master/kandidatdestroy/{id}', [KandidatController::class, 'destroy'])->name('evot01.master.kandidat_destroy')->middleware('auth'); /* hapus data kandidat */
    
    /* master - pemilih */    
    Route::get('/master/pemilih', [PemilihController ::class, 'index'])->name('evot01.master.pemilih.index')->middleware('auth'); /* halaman pemilih */
    Route::get('/master/pemilihshow', [PemilihController::class, 'show'])->name('evot01.master.pemilih_show')->middleware('auth'); /* menampilkan data pemilih pada datatable javascript */
    Route::post('/master/pemilihcreate', [PemilihController::class, 'create'])->name('evot01.master.pemilih_create')->middleware('auth'); /* menambah pemilih */
    Route::post('/master/pemilihimport', [PemilihController::class, 'importdata'])->name('evot01.master.pemilih_import')->middleware('auth'); /* import pemilih */
    Route::get('/master/pemilihedit/{id}', [PemilihController::class, 'edit'])->name('evot01.master.pemilih_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::delete('/master/pemilihdestroy/{id}', [PemilihController::class, 'destroy'])->name('evot01.master.pemilih_destroy')->middleware('auth'); /* hapus data pemilih */
    Route::delete('/master/pemilihdestroyall/{id}', [PemilihController::class, 'destroyall'])->name('evot01.master.pemilih_destroyall')->middleware('auth'); /* hapus data pemilih all */

    /* download */
    Route::get('/download/import-pemilih-form', function () {
        $filePath = storage_path('app/public/excel-files/import-pemilih-form.xlsx');
        if (file_exists($filePath)) {
            return response()->download($filePath, 'import-pemilih-form.xlsx');
        }
        abort(404, 'File tidak ditemukan');
    })->name('evot01.download.import-pemilih-form');

    /* laporan - hasilvoting */    
    Route::get('/laporan/hasilvoting', [HasilvotingController::class, 'index'])->name('evot01.laporan.hasilvoting.index')->middleware('auth'); /* halaman hasilvoting */
    Route::get('/laporan/hasilvotingshow', [HasilvotingController::class, 'show'])->name('evot01.laporan.hasilvoting_show')->middleware('auth'); /* menampilkan data hasilvoting pada datatable javascript */


});