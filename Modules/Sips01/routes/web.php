<?php

use Illuminate\Support\Facades\Route;
use Modules\Sips01\Http\Controllers\Master\AlasankeluarController;
use Modules\Sips01\Http\Controllers\Master\AlasansetelahkeluarController;
use Modules\Sips01\Http\Controllers\Master\BeasiswaController;
use Modules\Sips01\Http\Controllers\Master\BidangController;
use Modules\Sips01\Http\Controllers\master\BulanController;
use Modules\Sips01\Http\Controllers\Master\DataguruController;
use Modules\Sips01\Http\Controllers\Master\DatasiswaController;
use Modules\Sips01\Http\Controllers\Master\DesaController;
use Modules\Sips01\Http\Controllers\master\DudiController;
use Modules\Sips01\Http\Controllers\Master\JenistagihanController;
use Modules\Sips01\Http\Controllers\Master\KabupatenController;
use Modules\Sips01\Http\Controllers\Master\KecamatanController;
use Modules\Sips01\Http\Controllers\Master\KelasController;
use Modules\Sips01\Http\Controllers\Master\KompetensiController;
use Modules\Sips01\Http\Controllers\Master\MapelController;
use Modules\Sips01\Http\Controllers\Master\ProgramController;
use Modules\Sips01\Http\Controllers\Master\PropinsiController;
use Modules\Sips01\Http\Controllers\Master\SiswakelasController;
use Modules\Sips01\Http\Controllers\master\TpController;
use Modules\Sips01\Http\Controllers\Master\WalikelasController;
use Modules\Sips01\Http\Controllers\Pengaturan\ParametertagihanController;
use Modules\Sips01\Http\Controllers\Transaksi\BayartagihanController;
use Modules\Sips01\Http\Controllers\transaksi\MagangController;
use Modules\Sips01\Http\Controllers\Transaksi\NaikkelasController;
use Modules\Sips01\Http\Controllers\transaksi\NilaiController;
use Modules\Sips01\Http\Controllers\transaksi\SiswakeluarController;

// use Modules\Sips01\Http\Controllers\Sips01Controller;
// Route::middleware(['auth', 'verified'])->group(function () {
//     Route::resource('sips01s', Sips01Controller::class)->names('sips01');
// });

Route::prefix('sips01')->group(function() {
    /* master - tp */
    Route::get('/master/tp', [TpController::class, 'index'])->name('sips01.master.tp.index')->middleware('auth'); /* halaman tp */
    Route::get('/master/tpshow', [TpController::class, 'show'])->name('sips01.master.tp_show')->middleware('auth'); /* menampilkan data tp pada datatable javascript */
    Route::post('/master/tpcreate', [TpController::class, 'create'])->name('sips01.master.tp_create')->middleware('auth'); /* menambah data tp */
    Route::get('/master/tpedit/{id}', [TpController::class, 'edit'])->name('sips01.master.tp_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/tpupdate', [TpController::class, 'update'])->name('sips01.master.tp_update')->middleware('auth'); /* update data tp */
    Route::delete('/master/tpdestroy/{id}', [TpController::class, 'destroy'])->name('sips01.master.tp_destroy')->middleware('auth'); /* hapus data tp */

    /* master - bulan */
    Route::get('/master/bulan', [BulanController::class, 'index'])->name('sips01.master.bulan.index')->middleware('auth'); /* halaman bulan */
    Route::get('/master/bulanshow', [BulanController::class, 'show'])->name('sips01.master.bulan_show')->middleware('auth'); /* menampilkan data bulan pada datatable javascript */
    Route::post('/master/bulancreate', [BulanController::class, 'create'])->name('sips01.master.bulan_create')->middleware('auth'); /* menambah data bulan */
    Route::get('/master/bulanedit/{id}', [BulanController::class, 'edit'])->name('sips01.master.bulan_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/bulanupdate', [BulanController::class, 'update'])->name('sips01.master.bulan_update')->middleware('auth'); /* update data bulan */
    Route::delete('/master/bulandestroy/{id}', [BulanController::class, 'destroy'])->name('sips01.master.bulan_destroy')->middleware('auth'); /* hapus data bulan */
    Route::get('/master/bulanlisttp', [BulanController::class, 'listtp'])->name('sips01.master.bulan_listtp')->middleware('auth'); /* list tp */
    Route::post('/master/bulankirimsyarat', [BulanController::class, 'kirimsyarat'])->name('sips01.master.bulan_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    
    /* master - bidang */
    Route::get('/master/bidang', [BidangController::class, 'index'])->name('sips01.master.bidang.index')->middleware('auth'); /* halaman bidang */
    Route::get('/master/bidangshow', [BidangController::class, 'show'])->name('sips01.master.bidang_show')->middleware('auth'); /* menampilkan data bidang pada datatable javascript */
    Route::post('/master/bidangcreate', [BidangController::class, 'create'])->name('sips01.master.bidang_create')->middleware('auth'); /* menambah data bidang */
    Route::get('/master/bidangedit/{id}', [BidangController::class, 'edit'])->name('sips01.master.bidang_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/bidangupdate', [BidangController::class, 'update'])->name('sips01.master.bidang_update')->middleware('auth'); /* update data bidang */
    Route::delete('/master/bidangdestroy/{id}', [BidangController::class, 'destroy'])->name('sips01.master.bidang_destroy')->middleware('auth'); /* hapus data bidang */
    
    /* master - program */
    Route::get('/master/program', [ProgramController::class, 'index'])->name('sips01.master.program.index')->middleware('auth'); /* halaman program */
    Route::get('/master/programshow', [ProgramController::class, 'show'])->name('sips01.master.program_show')->middleware('auth'); /* menampilkan data program pada datatable javascript */
    Route::get('/master/programlistbidang', [ProgramController::class, 'listbidang'])->name('sips01.master.program_listbidang')->middleware('auth'); /* menampilkan list bidang */
    Route::post('/master/programcreate', [ProgramController::class, 'create'])->name('sips01.master.program_create')->middleware('auth'); /* menambah data program */
    Route::get('/master/programedit/{id}', [ProgramController::class, 'edit'])->name('sips01.master.program_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/programupdate', [ProgramController::class, 'update'])->name('sips01.master.program_update')->middleware('auth'); /* update data program */
    Route::delete('/master/programdestroy/{id}', [ProgramController::class, 'destroy'])->name('sips01.master.program_destroy')->middleware('auth'); /* hapus data program */
    Route::post('/master/programkirimsyarat', [ProgramController::class, 'kirimsyarat'])->name('sips01.master.program_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    
    /* master - kompetensi */
    Route::get('/master/kompetensi', [KompetensiController::class, 'index'])->name('sips01.master.kompetensi.index')->middleware('auth'); /* halaman kompetensi */
    Route::get('/master/kompetensishow', [KompetensiController::class, 'show'])->name('sips01.master.kompetensi_show')->middleware('auth'); /* menampilkan data kompetensi pada datatable javascript */
    Route::get('/master/kompetensilistbidang', [KompetensiController::class, 'listbidang'])->name('sips01.master.kompetensi_listbidang')->middleware('auth'); /* menampilkan list bidang */
    Route::get('/master/kompetensilistprogram/{id}', [KompetensiController::class, 'listprogram'])->name('sips01.master.kompetensi_listprogram')->middleware('auth'); /* menampilkan list program */
    Route::get('/master/kompetensilistdataguru', [KompetensiController::class, 'listdataguru'])->name('sips01.master.kompetensi_listdataguru')->middleware('auth'); /* menampilkan list dataguru */
    Route::post('/master/kompetensicreate', [KompetensiController::class, 'create'])->name('sips01.master.kompetensi_create')->middleware('auth'); /* menambah data kompetensi */
    Route::get('/master/kompetensiedit/{id}', [KompetensiController::class, 'edit'])->name('sips01.master.kompetensi_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/kompetensiupdate', [KompetensiController::class, 'update'])->name('sips01.master.kompetensi_update')->middleware('auth'); /* update data kompetensi */
    Route::post('/master/kompetensikirimsyarat', [KompetensiController::class, 'kirimsyarat'])->name('sips01.master.kompetensi_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::delete('/master/kompetensidestroy/{id}', [KompetensiController::class, 'destroy'])->name('sips01.master.kompetensi_destroy')->middleware('auth'); /* hapus data kompetensi */

    /* master - propinsi */
    Route::get('/master/propinsi', [PropinsiController::class, 'index'])->name('sips01.master.propinsi.index')->middleware('auth'); /* halaman propinsi */
    Route::get('/master/propinsishow', [PropinsiController::class, 'show'])->name('sips01.master.propinsi_show')->middleware('auth'); /* menampilkan data propinsi pada datatable javascript */
    Route::post('/master/propinsicreate', [PropinsiController::class, 'create'])->name('sips01.master.propinsi_create')->middleware('auth'); /* menambah data propinsi */
    Route::get('/master/propinsiedit/{id}', [PropinsiController::class, 'edit'])->name('sips01.master.propinsi_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/propinsiupdate', [PropinsiController::class, 'update'])->name('sips01.master.propinsi_update')->middleware('auth'); /* update data propinsi */
    Route::delete('/master/propinsidestroy/{id}', [PropinsiController::class, 'destroy'])->name('sips01.master.propinsi_destroy')->middleware('auth'); /* hapus data propinsi */

    /* master - kabupaten */
    Route::get('/master/kabupaten', [KabupatenController::class, 'index'])->name('sips01.master.kabupaten.index')->middleware('auth'); /* halaman kabupaten */
    Route::get('/master/kabupatenshow', [KabupatenController::class, 'show'])->name('sips01.master.kabupaten_show')->middleware('auth'); /* menampilkan data kabupaten pada datatable javascript */
    Route::get('/master/kabupatenlistpropinsi', [KabupatenController::class, 'listpropinsi'])->name('sips01.master.kabupaten_listpropinsi')->middleware('auth'); /* menampilkan list propinsi */
    Route::post('/master/kabupatencreate', [KabupatenController::class, 'create'])->name('sips01.master.kabupaten_create')->middleware('auth'); /* menambah data kabupaten */
    Route::get('/master/kabupatenedit/{id}', [KabupatenController::class, 'edit'])->name('sips01.master.kabupaten_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/kabupatenupdate', [KabupatenController::class, 'update'])->name('sips01.master.kabupaten_update')->middleware('auth'); /* update data kabupaten */
    Route::post('/master/kabupatenkirimsyarat', [KabupatenController::class, 'kirimsyarat'])->name('sips01.master.kabupaten_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::delete('/master/kabupatendestroy/{id}', [KabupatenController::class, 'destroy'])->name('sips01.master.kabupaten_destroy')->middleware('auth'); /* hapus data kabupaten */

    /* master - kecamatan */
    Route::get('/master/kecamatan', [KecamatanController::class, 'index'])->name('sips01.master.kecamatan.index')->middleware('auth'); /* halaman kecamatan */
    Route::get('/master/kecamatanshow', [KecamatanController::class, 'show'])->name('sips01.master.kecamatan_show')->middleware('auth'); /* menampilkan data kecamatan pada datatable javascript */
    Route::get('/master/kecamatanlistpropinsi', [KecamatanController::class, 'listpropinsi'])->name('sips01.master.kecamatan_listpropinsi')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/master/kecamatanlistkabupaten/{id}', [KecamatanController::class, 'listkabupaten'])->name('sips01.master.kecamatan_listkabupaten')->middleware('auth'); /* menampilkan list kabupaten */
    Route::post('/master/kecamatancreate', [KecamatanController::class, 'create'])->name('sips01.master.kecamatan_create')->middleware('auth'); /* menambah data kecamatan */
    Route::get('/master/kecamatanedit/{id}', [KecamatanController::class, 'edit'])->name('sips01.master.kecamatan_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/kecamatanupdate', [KecamatanController::class, 'update'])->name('sips01.master.kecamatan_update')->middleware('auth'); /* update data kecamatan */
    Route::post('/master/kecamatankirimsyarat', [KecamatanController::class, 'kirimsyarat'])->name('sips01.master.kecamatan_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::delete('/master/kecamatandestroy/{id}', [KecamatanController::class, 'destroy'])->name('sips01.master.kecamatan_destroy')->middleware('auth'); /* hapus data kecamatan */

    /* master - desa */
    Route::get('/master/desa', [DesaController::class, 'index'])->name('sips01.master.desa.index')->middleware('auth'); /* halaman desa */
    Route::get('/master/desashow', [DesaController::class, 'show'])->name('sips01.master.desa_show')->middleware('auth'); /* menampilkan data desa pada datatable javascript */
    Route::get('/master/desalistpropinsi', [DesaController::class, 'listpropinsi'])->name('sips01.master.desa_listpropinsi')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/master/desalistkabupaten/{id}', [DesaController::class, 'listkabupaten'])->name('sips01.master.desa_listkabupaten')->middleware('auth'); /* menampilkan list kabupaten */
    Route::get('/master/desalistkecamatan/{id}', [DesaController::class, 'listkecamatan'])->name('sips01.master.desa_listkecamatan')->middleware('auth'); /* menampilkan list kecamatan */
    Route::post('/master/desacreate', [DesaController::class, 'create'])->name('sips01.master.desa_create')->middleware('auth'); /* menambah data desa */
    Route::get('/master/desaedit/{id}', [DesaController::class, 'edit'])->name('sips01.master.desa_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/desaupdate', [DesaController::class, 'update'])->name('sips01.master.desa_update')->middleware('auth'); /* update data desa */
    Route::post('/master/desakirimsyarat', [DesaController::class, 'kirimsyarat'])->name('sips01.master.desa_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::delete('/master/desadestroy/{id}', [DesaController::class, 'destroy'])->name('sips01.master.desa_destroy')->middleware('auth'); /* hapus data desa */

    /* master - dataguru */
    Route::get('/master/dataguru', [DataguruController::class, 'index'])->name('sips01.master.dataguru.index')->middleware('auth'); /* halaman dataguru */
    Route::get('/master/datagurushow', [DataguruController::class, 'show'])->name('sips01.master.dataguru_show')->middleware('auth'); /* menampilkan data dataguru pada datatable javascript */
    Route::get('/master/datagurushowkabupaten', [DataguruController::class, 'showkabupaten'])->name('sips01.master.dataguru_showkabupaten')->middleware('auth'); /* menampilkan data kabupaten pada datatable javascript */
    Route::get('/master/datagurulistpangkat', [DataguruController::class, 'listpangkat'])->name('sips01.master.dataguru_listpangkat')->middleware('auth'); /* menampilkan list pangkat */
    Route::get('/master/dataguruliststatusprofesi', [DataguruController::class, 'liststatusprofesi'])->name('sips01.master.dataguru_liststatusprofesi')->middleware('auth'); /* menampilkan list statusprofesi */
    Route::get('/master/dataguruliststatuspegawai', [DataguruController::class, 'liststatuspegawai'])->name('sips01.master.dataguru_liststatuspegawai')->middleware('auth'); /* menampilkan list statuspegawai */
    Route::get('/master/datagurulistpendidikan', [DataguruController::class, 'listpendidikan'])->name('sips01.master.dataguru_listpendidikan')->middleware('auth'); /* menampilkan list pendidikan */
    Route::get('/master/datagurulistjk', [DataguruController::class, 'listjk'])->name('sips01.master.dataguru_listjk')->middleware('auth'); /* menampilkan list jk */
    Route::get('/master/datagurulistagama', [DataguruController::class, 'listagama'])->name('sips01.master.dataguru_listagama')->middleware('auth'); /* menampilkan list agama */
    Route::get('/master/datagurulisttempatlahir', [DataguruController::class, 'listtempatlahir'])->name('sips01.master.dataguru_listtempatlahir')->middleware('auth'); /* menampilkan list tempatlahir */
    Route::post('/master/datagurucreate', [DataguruController::class, 'create'])->name('sips01.master.dataguru_create')->middleware('auth'); /* menambah data dataguru */
    Route::get('/master/dataguruedit/{id}', [DataguruController::class, 'edit'])->name('sips01.master.dataguru_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/dataguruupdate', [DataguruController::class, 'update'])->name('sips01.master.dataguru_update')->middleware('auth'); /* update data dataguru */
    Route::delete('/master/datagurudestroy/{id}', [DataguruController::class, 'destroy'])->name('sips01.master.dataguru_destroy')->middleware('auth'); /* hapus data dataguru */
    
    /* master - kelas */
    Route::get('/master/kelas', [KelasController::class, 'index'])->name('sips01.master.kelas.index')->middleware('auth'); /* halaman kelas */
    Route::get('/master/kelasshow', [KelasController::class, 'show'])->name('sips01.master.kelas_show')->middleware('auth'); /* menampilkan data kelas pada datatable javascript */
    Route::get('/master/kelaslisttingkat', [KelasController::class, 'listtingkat'])->name('sips01.master.kelas_listtingkat')->middleware('auth'); /* menampilkan list tingkat */
    Route::get('/master/kelaslistkompetensi', [KelasController::class, 'listkompetensi'])->name('sips01.master.kelas_listkompetensi')->middleware('auth'); /* menampilkan list kompetensi */
    Route::post('/master/kelascreate', [KelasController::class, 'create'])->name('sips01.master.kelas_create')->middleware('auth'); /* menambah data kelas */
    Route::get('/master/kelasedit/{id}', [KelasController::class, 'edit'])->name('sips01.master.kelas_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/kelasupdate', [KelasController::class, 'update'])->name('sips01.master.kelas_update')->middleware('auth'); /* update data kelas */
    Route::delete('/master/kelasdestroy/{id}', [KelasController::class, 'destroy'])->name('sips01.master.kelas_destroy')->middleware('auth'); /* hapus data kelas */

    /* master - walikelas */
     Route::get('/master/walikelas', [WalikelasController::class, 'index'])->name('sips01.master.walikelas.index')->middleware('auth'); /* halaman walikelas */
     Route::get('/master/walikelasshow', [WalikelasController::class, 'show'])->name('sips01.master.walikelas_show')->middleware('auth'); /* menampilkan data walikelas pada datatable javascript */
     Route::get('/master/walikelaslisttp', [WalikelasController::class, 'listtp'])->name('sips01.master.walikelas_listtp')->middleware('auth'); /* menampilkan list tp */
     Route::get('/master/walikelaslistkelas', [WalikelasController::class, 'listkelas'])->name('sips01.master.walikelas_listkelas')->middleware('auth'); /* menampilkan list kelas */
     Route::get('/master/walikelaslistdataguru', [WalikelasController::class, 'listdataguru'])->name('sips01.master.walikelas_listdataguru')->middleware('auth'); /* menampilkan list dataguru */
     Route::post('/master/walikelascreate', [WalikelasController::class, 'create'])->name('sips01.master.walikelas_create')->middleware('auth'); /* menambah data walikelas */
     Route::get('/master/walikelasedit/{id}', [WalikelasController::class, 'edit'])->name('sips01.master.walikelas_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
     Route::post('/master/walikelasupdate', [WalikelasController::class, 'update'])->name('sips01.master.walikelas_update')->middleware('auth'); /* update data walikelas */
     Route::post('/master/walikelaskirimsyarat', [WalikelasController::class, 'kirimsyarat'])->name('sips01.master.walikelas_kirimsyarat')->middleware('auth'); /* kirimsyarat */
     Route::delete('/master/walikelasdestroy/{id}', [WalikelasController::class, 'destroy'])->name('sips01.master.walikelas_destroy')->middleware('auth'); /* hapus data walikelas */

    /* master - alasankeluar */
    Route::get('/master/alasankeluar', [AlasankeluarController::class, 'index'])->name('sips01.master.alasankeluar.index')->middleware('auth'); /* halaman alasankeluar */
    Route::get('/master/alasankeluarshow', [AlasankeluarController::class, 'show'])->name('sips01.master.alasankeluar_show')->middleware('auth'); /* menampilkan data alasankeluar pada datatable javascript */
    Route::post('/master/alasankeluarcreate', [AlasankeluarController::class, 'create'])->name('sips01.master.alasankeluar_create')->middleware('auth'); /* menambah data alasankeluar */
    Route::get('/master/alasankeluaredit/{id}', [AlasankeluarController::class, 'edit'])->name('sips01.master.alasankeluar_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/alasankeluarupdate', [AlasankeluarController::class, 'update'])->name('sips01.master.alasankeluar_update')->middleware('auth'); /* update data alasankeluar */
    Route::delete('/master/alasankeluardestroy/{id}', [AlasankeluarController::class, 'destroy'])->name('sips01.master.alasankeluar_destroy')->middleware('auth'); /* hapus data alasankeluar */
   
    /* master - alasansetelahkeluar */
    Route::get('/master/alasansetelahkeluar', [AlasansetelahkeluarController::class, 'index'])->name('sips01.master.alasansetelahkeluar.index')->middleware('auth'); /* halaman alasansetelahkeluar */
    Route::get('/master/alasansetelahkeluarshow', [AlasansetelahkeluarController::class, 'show'])->name('sips01.master.alasansetelahkeluar_show')->middleware('auth'); /* menampilkan data alasansetelahkeluar pada datatable javascript */
    Route::post('/master/alasansetelahkeluarcreate', [AlasansetelahkeluarController::class, 'create'])->name('sips01.master.alasansetelahkeluar_create')->middleware('auth'); /* menambah data alasansetelahkeluar */
    Route::get('/master/alasansetelahkeluaredit/{id}', [AlasansetelahkeluarController::class, 'edit'])->name('sips01.master.alasansetelahkeluar_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/alasansetelahkeluarupdate', [AlasansetelahkeluarController::class, 'update'])->name('sips01.master.alasansetelahkeluar_update')->middleware('auth'); /* update data alasansetelahkeluar */
    Route::delete('/master/alasansetelahkeluardestroy/{id}', [AlasansetelahkeluarController::class, 'destroy'])->name('sips01.master.alasansetelahkeluar_destroy')->middleware('auth'); /* hapus data alasansetelahkeluar */
    
    /* master - jenistagihan */
    Route::get('/master/jenistagihan', [JenistagihanController::class, 'index'])->name('sips01.master.jenistagihan.index')->middleware('auth'); /* halaman jenistagihan */
    Route::get('/master/jenistagihanshow', [JenistagihanController::class, 'show'])->name('sips01.master.jenistagihan_show')->middleware('auth'); /* menampilkan data jenistagihan pada datatable javascript */
    Route::post('/master/jenistagihancreate', [JenistagihanController::class, 'create'])->name('sips01.master.jenistagihan_create')->middleware('auth'); /* menambah data jenistagihan */
    Route::get('/master/jenistagihanedit/{id}', [JenistagihanController::class, 'edit'])->name('sips01.master.jenistagihan_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/jenistagihanupdate', [JenistagihanController::class, 'update'])->name('sips01.master.jenistagihan_update')->middleware('auth'); /* update data jenistagihan */
    Route::delete('/master/jenistagihandestroy/{id}', [JenistagihanController::class, 'destroy'])->name('sips01.master.jenistagihan_destroy')->middleware('auth'); /* hapus data jenistagihan */
    
    /* master - datasiswa */
    Route::get('/master/datasiswa', [DatasiswaController::class, 'index'])->name('sips01.master.datasiswa.index')->middleware('auth'); /* halaman datasiswa */
    Route::get('/master/datasiswashow', [DatasiswaController::class, 'show'])->name('sips01.master.datasiswa_show')->middleware('auth'); /* menampilkan data datasiswa pada datatable javascript */
    Route::post('/master/datasiswacreate', [DatasiswaController::class, 'create'])->name('sips01.master.datasiswa_create')->middleware('auth'); /* create/update data datasiswa pada datatable javascript */
    Route::get('/master/datasiswaedit/{id}', [DatasiswaController::class, 'edit'])->name('sips01.master.datasiswa_edit')->middleware('auth'); /* edit data datasiswa pada datatable javascript */
    Route::delete('/master/datasiswadestroy/{id}', [DatasiswaController::class, 'destroy'])->name('sips01.master.datasiswa_destroy')->middleware('auth'); /* hapus data datasiswa */
    Route::get('/master/datasiswashowbeasiswa', [DatasiswaController::class, 'showbeasiswa'])->name('sips01.master.datasiswa_showbeasiswa')->middleware('auth'); /* menampilkan data beasiswa pada datatable javascript */
    Route::get('/master/datasiswaedit/{id}', [DatasiswaController::class, 'edit'])->name('sips01.master.datasiswa_edit')->middleware('auth'); /* edit data datasiswa pada datatable javascript */
    Route::get('/master/datasiswashowkabupaten', [DatasiswaController::class, 'showkabupaten'])->name('sips01.master.datasiswa_showkabupaten')->middleware('auth'); /* menampilkan data kabupaten pada datatable javascript */
    Route::get('/master/datasiswashowkompetensi', [DatasiswaController::class, 'showkompetensi'])->name('sips01.master.datasiswa_showkompetensi')->middleware('auth'); /* menampilkan data showkompetensi pada datatable javascript */
    Route::get('/master/datasiswashowdesa', [DatasiswaController::class, 'showdesa'])->name('sips01.master.datasiswa_showdesa')->middleware('auth'); /* menampilkan data desa pada datatable javascript */
    Route::post('/master/datasiswakirimsyarat', [DatasiswaController::class, 'kirimsyarat'])->name('sips01.master.datasiswa_kirimsyarat')->middleware('auth'); /* kirim syarat */
    Route::get('/master/datasiswalisttpmasuk', [DatasiswaController::class, 'listtpmasuk'])->name('sips01.master.datasiswa_listtpmasuk')->middleware('auth'); /* list tpmasuk */
    Route::get('/master/datasiswaliststatussiswa', [DatasiswaController::class, 'liststatussiswa'])->name('sips01.master.datasiswa_liststatussiswa')->middleware('auth'); /* menampilkan list statussiswa */
    Route::get('/master/datasiswalistpendidikan', [DatasiswaController::class, 'listpendidikan'])->name('sips01.master.datasiswa_listpendidikan')->middleware('auth'); /* menampilkan list pendidikan */
    Route::get('/master/datasiswalistjk', [DatasiswaController::class, 'listjk'])->name('sips01.master.datasiswa_listjk')->middleware('auth'); /* menampilkan list jk */
    Route::get('/master/datasiswalistagama', [DatasiswaController::class, 'listagama'])->name('sips01.master.datasiswa_listagama')->middleware('auth'); /* menampilkan list agama */
    Route::get('/master/datasiswalisttempatlahir', [DatasiswaController::class, 'listtempatlahir'])->name('sips01.master.datasiswa_listtempatlahir')->middleware('auth'); /* menampilkan list tempatlahir */
    Route::get('/master/datasiswalistkompetensi', [DatasiswaController::class, 'listkompetensi'])->name('sips01.master.datasiswa_listkompetensi')->middleware('auth'); /* menampilkan list listkompetensi */
    Route::get('/master/datasiswaliststatusanak', [DatasiswaController::class, 'liststatusanak'])->name('sips01.master.datasiswa_liststatusanak')->middleware('auth'); /* menampilkan list statusanak */
    Route::get('/master/datasiswalistdesa', [DatasiswaController::class, 'listdesa'])->name('sips01.master.datasiswa_listdesa')->middleware('auth'); /* menampilkan list desa */
    Route::get('/master/datasiswalisttinggal', [DatasiswaController::class, 'listtinggal'])->name('sips01.master.datasiswa_listtinggal')->middleware('auth'); /* menampilkan list tinggal */
    Route::get('/master/datasiswalistgd', [DatasiswaController::class, 'listgd'])->name('sips01.master.datasiswa_listgd')->middleware('auth'); /* menampilkan list gd */
    Route::get('/master/datasiswalistkelas', [DatasiswaController::class, 'listkelas'])->name('sips01.master.datasiswa_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/master/datasiswalistalasankeluar', [DatasiswaController::class, 'listalasankeluar'])->name('sips01.master.datasiswa_listalasankeluar')->middleware('auth'); /* menampilkan list alasankeluar */
    Route::get('/master/datasiswalistalasansetelahkeluar', [DatasiswaController::class, 'listalasansetelahkeluar'])->name('sips01.master.datasiswa_listalasansetelahkeluar')->middleware('auth'); /* menampilkan list alasansetelahkeluar */
    Route::post('/master/datasiswaimport', [DatasiswaController::class, 'importdata'])->name('sips01.master.datasiswa_import')->middleware('auth'); /* import datasiswa */
    Route::post('/master/datasiswakirim', [DatasiswaController::class, 'kirim'])->name('sips01.master.datasiswa_kirim')->middleware('auth'); /* kirim data */
    Route::post('/master/datasiswaupdate', [DatasiswaController::class, 'update'])->name('sips01.master.datasiswa_update')->middleware('auth'); /* update data datasiswa */
    Route::get('/master/datasiswaprintdatainduk', [DatasiswaController::class, 'printdatainduk'])->name('sips01.master.datasiswa_printdatainduk')->middleware('auth'); /* print data induk */
    Route::post('/master/datasiswakirimid', [DatasiswaController::class, 'kirimid'])->name('sips01.master.datasiswa_kirimid')->middleware('auth'); /* kirim id datasiswa */
    Route::post('/master/datasiswakirimiddatasiswa', [DatasiswaController::class, 'kirimiddatasiswa'])->name('sips01.master.datasiswa_kirimiddatasiswa')->middleware('auth'); /* kirim iddatasiswa */

    /* master - siswakelas */
    Route::get('/master/siswakelas', [SiswakelasController::class, 'index'])->name('sips01.master.siswakelas.index')->middleware('auth'); /* halaman siswakelas */
    Route::get('/master/siswakelasshow', [SiswakelasController::class, 'show'])->name('sips01.master.siswakelas_show')->middleware('auth'); /* menampilkan data siswakelas pada datatable javascript */
    Route::get('/master/siswakelaslisttp', [SiswakelasController::class, 'listtp'])->name('sips01.master.siswakelas_listtp')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/master/siswakelaslistkelas', [SiswakelasController::class, 'listkelas'])->name('sips01.master.siswakelas_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/master/siswakelasshowwali', [SiswakelasController::class, 'showwalikelas'])->name('sips01.master.siswakelas_showwalikelas')->middleware('auth'); /* menampilkan list kecamatan */
    Route::post('/master/siswakelascreate', [SiswakelasController::class, 'create'])->name('sips01.master.siswakelas_create')->middleware('auth'); /* menambah data siswakelas */
    Route::get('/master/siswakelasedit/{id}', [SiswakelasController::class, 'edit'])->name('sips01.master.siswakelas_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/siswakelasupdate', [SiswakelasController::class, 'update'])->name('sips01.master.siswakelas_update')->middleware('auth'); /* update data siswakelas */
    Route::post('/master/siswakelaskirimsyarat', [SiswakelasController::class, 'kirimsyarat'])->name('sips01.master.siswakelas_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::post('/master/siswakelasimport', [SiswakelasController::class, 'import'])->name('sips01.master.siswakelas_import')->middleware('auth'); /* import */
    Route::delete('/master/siswakelasdestroy/{id}', [SiswakelasController::class, 'destroy'])->name('sips01.master.siswa_destroy')->middleware('auth'); /* hapus data siswakelas */
    Route::get('/master/siswakelasprint', [SiswakelasController::class, 'print'])->name('sips01.master.siswakelas_print')->middleware('auth'); /* menampilkan data siswakelas pada datatable javascript */

    /* master - beasiswa */
    Route::get('/master/beasiswa', [BeasiswaController::class, 'index'])->name('sips01.master.beasiswa.index')->middleware('auth'); /* halaman beasiswa */
    Route::get('/master/beasiswashow', [BeasiswaController::class, 'show'])->name('sips01.master.beasiswa_show')->middleware('auth'); /* menampilkan data beasiswa pada datatable javascript */
    Route::post('/master/beasiswacreate', [BeasiswaController::class, 'create'])->name('sips01.master.beasiswa_create')->middleware('auth'); /* menambah data beasiswa */
    Route::get('/master/beasiswaedit/{id}', [BeasiswaController::class, 'edit'])->name('sips01.master.beasiswa_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/beasiswaupdate', [BeasiswaController::class, 'update'])->name('sips01.master.beasiswa_update')->middleware('auth'); /* update data beasiswa */
    Route::post('/master/beasiswakirimsyarat', [BeasiswaController::class, 'kirimsyarat'])->name('sips01.master.beasiswa_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::delete('/master/beasiswadestroy/{id}', [BeasiswaController::class, 'destroy'])->name('sips01.master.beasiswa_destroy')->middleware('auth'); /* hapus data beasiswa */
    Route::get('/master/beasiswalisttp', [BeasiswaController::class, 'listtp'])->name('sips01.master.beasiswa_listtp')->middleware('auth'); /* menampilkan list tp */
    Route::get('/master/beasiswalistkelas/{id}', [BeasiswaController::class, 'listkelas'])->name('sips01.master.beasiswa_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/master/beasiswalistdatasiswa/{id}', [BeasiswaController::class, 'listdatasiswa'])->name('sips01.master.beasiswa_listdatasiswa')->middleware('auth'); /* menampilkan list datasiswa */

    /* download */
    Route::get('/download/import-datasiswa-form', function () {
        $filePath = storage_path('app/public/excel-files/import-datasiswa-form.xlsx');
        if (file_exists($filePath)) {
            return response()->download($filePath, 'import-datasiswa-form.xlsx');
        }
        abort(404, 'File tidak ditemukan');
    })->name('sips01.download.import-datasiswa-form');

    /* master - mapel */
    Route::get('/master/mapel', [MapelController::class, 'index'])->name('sips01.master.mapel.index')->middleware('auth'); /* halaman mapel */
    Route::get('/master/mapelshow', [MapelController::class, 'show'])->name('sips01.master.mapel_show')->middleware('auth'); /* menampilkan data mapel pada datatable javascript */
    Route::get('/master/mapellistkelompokmapel', [MapelController::class, 'listkelompokmapel'])->name('sips01.master.mapel_listkelompokmapel')->middleware('auth'); /* menampilkan list propinsi */
    Route::post('/master/mapelcreate', [MapelController::class, 'create'])->name('sips01.master.mapel_create')->middleware('auth'); /* menambah data mapel */
    Route::get('/master/mapeledit/{id}', [MapelController::class, 'edit'])->name('sips01.master.mapel_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/mapelupdate', [MapelController::class, 'update'])->name('sips01.master.mapel_update')->middleware('auth'); /* update data mapel */
    Route::post('/master/mapelkirimsyarat', [MapelController::class, 'kirimsyarat'])->name('sips01.master.mapel_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::delete('/master/mapeldestroy/{id}', [MapelController::class, 'destroy'])->name('sips01.master.mapel_destroy')->middleware('auth'); /* hapus data mapel */

    /* master - dudi */
    Route::get('/master/dudi', [DudiController::class, 'index'])->name('sips01.master.dudi.index')->middleware('auth'); /* halaman dudi */
    Route::get('/master/dudishow', [DudiController::class, 'show'])->name('sips01.master.dudi_show')->middleware('auth'); /* menampilkan data dudi pada datatable javascript */
    Route::post('/master/dudicreate', [DudiController::class, 'create'])->name('sips01.master.dudi_create')->middleware('auth'); /* menambah data dudi */
    Route::get('/master/dudiedit/{id}', [DudiController::class, 'edit'])->name('sips01.master.dudi_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/master/dudiupdate', [DudiController::class, 'update'])->name('sips01.master.dudi_update')->middleware('auth'); /* update data dudi */
    Route::delete('/master/dudidestroy/{id}', [DudiController::class, 'destroy'])->name('sips01.master.dudi_destroy')->middleware('auth'); /* hapus data dudi */

    /* transaksi - naikkelas */
    Route::get('/transaksi/naikkelas', [NaikkelasController::class, 'index'])->name('sips01.transaksi.naikkelas.index')->middleware('auth'); /* halaman naikkelas */
    Route::get('/transaksi/naikkelasshow1', [NaikkelasController::class, 'show1'])->name('sips01.transaksi.naikkelas_show1')->middleware('auth'); /* menampilkan data naikkelas pada datatable javascript */
    Route::get('/transaksi/naikkelasshow2', [NaikkelasController::class, 'show2'])->name('sips01.transaksi.naikkelas_show2')->middleware('auth'); /* menampilkan data naikkelas pada datatable javascript */
    Route::get('/transaksi/naikkelaslisttp', [NaikkelasController::class, 'listtp'])->name('sips01.transaksi.naikkelas_listtp')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/transaksi/naikkelaslistkelas', [NaikkelasController::class, 'listkelas'])->name('sips01.transaksi.naikkelas_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::post('/transaksi/naikkelaskirimsyarat', [NaikkelasController::class, 'kirimsyarat'])->name('sips01.transaksi.naikkelas_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::post('/transaksi/naikkelasproses', [NaikkelasController::class, 'proses'])->name('sips01.transaksi.naikkelas_proses')->middleware('auth'); /* proses */

    /* transaksi - siswakeluar */
    Route::get('/transaksi/siswakeluar', [SiswakeluarController::class, 'index'])->name('sips01.transaksi.siswakeluar.index')->middleware('auth'); /* halaman siswakeluar */
    Route::get('/transaksi/siswakeluarshow', [SiswakeluarController::class, 'show'])->name('sips01.transaksi.siswakeluar_show')->middleware('auth'); /* menampilkan data siswakeluar pada datatable javascript */
    Route::get('/transaksi/siswakeluarlisttp', [SiswakeluarController::class, 'listtp'])->name('sips01.transaksi.siswakeluar_listtp')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/transaksi/siswakeluarlistkelas', [SiswakeluarController::class, 'listkelas'])->name('sips01.transaksi.siswakeluar_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/transaksi/siswakeluarlistalasankeluar', [SiswakeluarController::class, 'listalasankeluar'])->name('sips01.transaksi.siswakeluar_listalasankeluar')->middleware('auth'); /* menampilkan list alasankeluar */
    Route::get('/transaksi/siswakeluarlistalasansetelahkeluar', [SiswakeluarController::class, 'listalasansetelahkeluar'])->name('sips01.transaksi.siswakeluar_listalasansetelahkeluar')->middleware('auth'); /* menampilkan list alasansetelahkeluar */
    Route::get('/transaksi/siswakeluarshowwali', [SiswakeluarController::class, 'showwalikelas'])->name('sips01.transaksi.siswakeluar_showwalikelas')->middleware('auth'); /* menampilkan list kecamatan */
    Route::post('/transaksi/siswakeluarcreate', [SiswakeluarController::class, 'create'])->name('sips01.transaksi.siswakeluar_create')->middleware('auth'); /* menambah data siswakeluar */
    Route::get('/transaksi/siswakeluaredit/{id}', [SiswakeluarController::class, 'edit'])->name('sips01.transaksi.siswakeluar_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/transaksi/siswakeluarupdate', [SiswakeluarController::class, 'update'])->name('sips01.transaksi.siswakeluar_update')->middleware('auth'); /* update data siswakeluar */
    Route::post('/transaksi/siswakeluarkirimsyarat', [SiswakeluarController::class, 'kirimsyarat'])->name('sips01.transaksi.siswakeluar_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::post('/transaksi/siswakeluarsaveall', [SiswakeluarController::class, 'saveall'])->name('sips01.transaksi.siswakeluar_saveall')->middleware('auth'); /* saveall */
    Route::get('/transaksi/siswakeluardestroy/{id}', [SiswakeluarController::class, 'destroy'])->name('sips01.transaksi.siswa_destroy')->middleware('auth'); /* hapus data siswakeluar */
    Route::get('/transaksi/siswakeluarprint', [SiswakeluarController::class, 'print'])->name('sips01.transaksi.siswakeluar_print')->middleware('auth'); /* menampilkan data siswakeluar pada datatable javascript */

    /* transaksi - nilai */
    Route::get('/transaksi/nilai', [NilaiController::class, 'index'])->name('sips01.transaksi.nilai.index')->middleware('auth'); /* halaman nilai */
    Route::get('/transaksi/nilaishow', [NilaiController::class, 'show'])->name('sips01.transaksi.nilai_show')->middleware('auth'); /* menampilkan data nilai pada datatable javascript */
    Route::get('/transaksi/nilailisttp', [NilaiController::class, 'listtp'])->name('sips01.transaksi.nilai_listtp')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/transaksi/nilailistkelas', [NilaiController::class, 'listkelas'])->name('sips01.transaksi.nilai_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/transaksi/nilailistmapel', [NilaiController::class, 'listmapel'])->name('sips01.transaksi.nilai_listmapel')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/transaksi/nilaishowwali', [NilaiController::class, 'showwalikelas'])->name('sips01.transaksi.nilai_showwalikelas')->middleware('auth'); /* menampilkan list kecamatan */
    Route::post('/transaksi/nilaicreate', [NilaiController::class, 'create'])->name('sips01.transaksi.nilai_create')->middleware('auth'); /* menambah data nilai */
    Route::get('/transaksi/nilaiedit/{id}', [NilaiController::class, 'edit'])->name('sips01.transaksi.nilai_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/transaksi/nilaiupdate', [NilaiController::class, 'update'])->name('sips01.transaksi.nilai_update')->middleware('auth'); /* update data nilai */
    Route::post('/transaksi/nilaikirimsyarat', [NilaiController::class, 'kirimsyarat'])->name('sips01.transaksi.nilai_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::post('/transaksi/nilaikirimid', [NilaiController::class, 'kirimid'])->name('sips01.transaksi.nilai_kirimid')->middleware('auth'); /* kirimid */
    Route::post('/transaksi/nilaiimportnilai', [NilaiController::class, 'importnilai'])->name('sips01.transaksi.nilai_importnilai')->middleware('auth'); /* import nilai */
    Route::post('/transaksi/nilaiimportabsensi', [NilaiController::class, 'importabsensi'])->name('sips01.transaksi.nilai_importabsensi')->middleware('auth'); /* import absensi */
    Route::delete('/transaksi/nilaidestroy/{id}', [NilaiController::class, 'destroy'])->name('sips01.transaksi.siswa_destroy')->middleware('auth'); /* hapus data nilai */
    Route::get('/transaksi/nilaiprintnilai', [NilaiController::class, 'printnilai'])->name('sips01.transaksi.nilai_printnilai')->middleware('auth'); /* menampilkan data nilai pada datatable javascript */
    
    /* download */
    Route::get('/download/import-nilai-form', function () {
        $filePath = storage_path('app/public/excel-files/import-nilai-form.xlsx');
        if (file_exists($filePath)) {
            return response()->download($filePath, 'import-nilai-form.xlsx');
        }
        abort(404, 'File tidak ditemukan');
    })->name('sips01.download.import-nilai-form');
    
    Route::get('/download/import-absensi-form', function () {
        $filePath = storage_path('app/public/excel-files/import-absensi-form.xlsx');
        if (file_exists($filePath)) {
            return response()->download($filePath, 'import-absensi-form.xlsx');
        }
        abort(404, 'File tidak ditemukan');
    })->name('sips01.download.import-absensi-form');

    /* transaksi - magang */
    Route::get('/transaksi/magang', [MagangController::class, 'index'])->name('sips01.transaksi.magang.index')->middleware('auth'); /* halaman magang */
    Route::get('/transaksi/magangshow', [MagangController::class, 'show'])->name('sips01.transaksi.magang_show')->middleware('auth'); /* menampilkan data magang pada datatable javascript */
    Route::get('/transaksi/magangshowdatasiswa', [MagangController::class, 'showdatasiswa'])->name('sips01.transaksi.magang_showdatasiswa')->middleware('auth'); /* menampilkan datasiswa pada datatable javascript */
    Route::get('/transaksi/magangshowdudi', [MagangController::class, 'showdudi'])->name('sips01.transaksi.magang_showdudi')->middleware('auth'); /* menampilkan dudi pada datatable javascript */
    Route::get('/transaksi/maganglisttp', [MagangController::class, 'listtp'])->name('sips01.transaksi.magang_listtp')->middleware('auth'); /* menampilkan list propinsi */
    Route::get('/transaksi/maganglistkelas', [MagangController::class, 'listkelas'])->name('sips01.transaksi.magang_listkelas')->middleware('auth'); /* menampilkan list kelas */
    Route::get('/transaksi/magangshowwali', [MagangController::class, 'showwalikelas'])->name('sips01.transaksi.magang_showwalikelas')->middleware('auth'); /* menampilkan list kecamatan */
    Route::post('/transaksi/magangcreate', [MagangController::class, 'create'])->name('sips01.transaksi.magang_create')->middleware('auth'); /* menambah data magang */
    Route::get('/transaksi/magangedit/{id}', [MagangController::class, 'edit'])->name('sips01.transaksi.magang_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
    Route::post('/transaksi/magangupdate', [MagangController::class, 'update'])->name('sips01.transaksi.magang_update')->middleware('auth'); /* update data magang */
    Route::post('/transaksi/magangkirimsyarat', [MagangController::class, 'kirimsyarat'])->name('sips01.transaksi.magang_kirimsyarat')->middleware('auth'); /* kirimsyarat */
    Route::post('/transaksi/magangimport', [MagangController::class, 'import'])->name('sips01.transaksi.magang_import')->middleware('auth'); /* import */
    Route::delete('/transaksi/magangdestroy/{id}', [MagangController::class, 'destroy'])->name('sips01.transaksi.siswa_destroy')->middleware('auth'); /* hapus data magang */
    Route::get('/transaksi/magangprint', [MagangController::class, 'print'])->name('sips01.transaksi.magang_print')->middleware('auth'); /* menampilkan data magang pada datatable javascript */

     /* pengaturan - parametertagihan */
     Route::get('/pengaturan/parametertagihan', [ParametertagihanController::class, 'index'])->name('sips01.pengaturan.parametertagihan.index')->middleware('auth'); /* halaman parametertagihan */
     Route::get('/pengaturan/parametertagihanshow', [ParametertagihanController::class, 'show'])->name('sips01.pengaturan.parametertagihan_show')->middleware('auth'); /* menampilkan data parametertagihan pada datatable javascript */
     Route::get('/pengaturan/parametertagihanlisttp', [ParametertagihanController::class, 'listtp'])->name('sips01.pengaturan.parametertagihan_listtp')->middleware('auth'); /* menampilkan list tp */
     Route::get('/pengaturan/parametertagihanlisttingkat', [ParametertagihanController::class, 'listtingkat'])->name('sips01.pengaturan.parametertagihan_listtingkat')->middleware('auth'); /* menampilkan list tingkat */
     Route::get('/pengaturan/parametertagihanlistdataguru', [ParametertagihanController::class, 'listdataguru'])->name('sips01.pengaturan.parametertagihan_listdataguru')->middleware('auth'); /* menampilkan list dataguru */
     Route::get('/pengaturan/parametertagihanlistjenistagihan', [ParametertagihanController::class, 'listjenistagihan'])->name('sips01.pengaturan.parametertagihan_listjenistagihan')->middleware('auth'); /* menampilkan list jenistagihan */
     Route::post('/pengaturan/parametertagihancreate', [ParametertagihanController::class, 'create'])->name('sips01.pengaturan.parametertagihan_create')->middleware('auth'); /* menambah data parametertagihan */
     Route::get('/pengaturan/parametertagihanedit/{id}', [ParametertagihanController::class, 'edit'])->name('sips01.pengaturan.parametertagihan_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
     Route::post('/pengaturan/parametertagihanupdate', [ParametertagihanController::class, 'update'])->name('sips01.pengaturan.parametertagihan_update')->middleware('auth'); /* update data parametertagihan */
     Route::post('/pengaturan/parametertagihankirimsyarat', [ParametertagihanController::class, 'kirimsyarat'])->name('sips01.pengaturan.parametertagihan_kirimsyarat')->middleware('auth'); /* kirimsyarat */
     Route::delete('/pengaturan/parametertagihandestroy/{id}', [ParametertagihanController::class, 'destroy'])->name('sips01.pengaturan.parametertagihan_destroy')->middleware('auth'); /* hapus data parametertagihan */
 
     /* transaksi - bayartagihan */
     Route::get('/transaksi/bayartagihan', [BayartagihanController::class, 'index'])->name('sips01.transaksi.bayartagihan.index')->middleware('auth'); /* halaman bayartagihan */
     Route::get('/transaksi/bayartagihanshow', [BayartagihanController::class, 'show'])->name('sips01.transaksi.bayartagihan_show')->middleware('auth'); /* menampilkan data bayartagihan pada datatable javascript */
     Route::get('/transaksi/bayartagihanshowdatasiswa', [BayartagihanController::class, 'showdatasiswa'])->name('sips01.transaksi.bayartagihan_showdatasiswa')->middleware('auth'); /* menampilkan data siswa pada datatable javascript */
     Route::get('/transaksi/bayartagihanlisttp', [BayartagihanController::class, 'listtp'])->name('sips01.transaksi.bayartagihan_listtp')->middleware('auth'); /* menampilkan list tp */
     Route::get('/transaksi/bayartagihanlistbulan', [BayartagihanController::class, 'listbulan'])->name('sips01.transaksi.bayartagihan_listbulan')->middleware('auth'); /* menampilkan list bulan */
     Route::get('/transaksi/bayartagihanlistkelas', [BayartagihanController::class, 'listkelas'])->name('sips01.transaksi.bayartagihan_listkelas')->middleware('auth'); /* menampilkan list kelas */
     Route::get('/transaksi/bayartagihanlistdataguru', [BayartagihanController::class, 'listdataguru'])->name('sips01.transaksi.bayartagihan_listdataguru')->middleware('auth'); /* menampilkan list kelas */
     Route::get('/transaksi/bayartagihanlistjenistagihan', [BayartagihanController::class, 'listjenistagihan'])->name('sips01.transaksi.bayartagihan_listjenistagihan')->middleware('auth'); /* menampilkan list jenistagihan */
     Route::get('/transaksi/bayartagihanlistalasansetelahkeluar', [BayartagihanController::class, 'listalasansetelahkeluar'])->name('sips01.transaksi.bayartagihan_listalasansetelahkeluar')->middleware('auth'); /* menampilkan list alasansetelahkeluar */
     Route::get('/transaksi/bayartagihanshowwali', [BayartagihanController::class, 'showwalikelas'])->name('sips01.transaksi.bayartagihan_showwalikelas')->middleware('auth'); /* menampilkan list kelas */
     Route::post('/transaksi/bayartagihancreate', [BayartagihanController::class, 'create'])->name('sips01.transaksi.bayartagihan_create')->middleware('auth'); /* menambah data bayartagihan */
     Route::get('/transaksi/bayartagihanedit/{id}', [BayartagihanController::class, 'edit'])->name('sips01.transaksi.bayartagihan_edit')->middleware('auth'); /* menampilkan data yang akan dirubah */
     Route::post('/transaksi/bayartagihanupdate', [BayartagihanController::class, 'update'])->name('sips01.transaksi.bayartagihan_update')->middleware('auth'); /* update data bayartagihan */
     Route::post('/transaksi/bayartagihankirimsyarat', [BayartagihanController::class, 'kirimsyarat'])->name('sips01.transaksi.bayartagihan_kirimsyarat')->middleware('auth'); /* kirimsyarat */
     Route::post('/transaksi/bayartagihancariid', [BayartagihanController::class, 'cariid'])->name('sips01.transaksi.bayartagihan_cariid')->middleware('auth'); /* cari data siswa */
     Route::post('/transaksi/bayartagihannomorbukti', [BayartagihanController::class, 'nomorbukti'])->name('sips01.transaksi.bayartagihan_nomorbukti')->middleware('auth'); /* buat nomorbukti */
     Route::delete('/transaksi/bayartagihandestroy/{id}', [BayartagihanController::class, 'destroy'])->name('sips01.transaksi.bayartagihan_destroy')->middleware('auth'); /* hapus data bayartagihan */
     Route::get('/transaksi/bayartagihanprintkwintansi', [BayartagihanController::class, 'printkwintansi'])->name('sips01.transaksi.bayartagihan_printkwintansi')->middleware('auth'); /* cetak data */



});