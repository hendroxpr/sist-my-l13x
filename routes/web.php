<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\MenusubController;
use App\Http\Controllers\MenuutamaController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [FrontController::class, 'loginform'])->name('front.index')->middleware('guest');
Route::get('/login/', [FrontController::class, 'loginform'])->name('front.admin_loginform')->middleware('guest');
Route::get('/register/', [FrontController::class, 'registerform'])->name('front.admin_registerform')->middleware('guest');
Route::post('/register/', [FrontController::class, 'create'])->name('front.admin_create')->middleware('guest');
Route::get('/registerlistaplikasi/', [FrontController::class, 'listaplikasi'])->name('front.admin_registerlistaplikasi')->middleware('guest');
Route::post('/login/', [FrontController::class, 'authenticate'])->name('front.admin_login')->middleware('guest');
Route::post('/logout/', [FrontController::class, 'logout'])->name('front.admin_logout');
Route::get('/logout/', [FrontController::class, 'logout'])->name('login');

/* halaman evot01 */
Route::get('/loginevot/', [FrontController::class, 'loginevotform'])->name('front.admin_loginevotform')->middleware('guest');
Route::post('/loginevot/', [FrontController::class, 'cekloginevot'])->name('front.admin_cekloginevot')->middleware('guest');
/* halaman pilkaos */
Route::get('/pilkaos/', [FrontController::class, 'pilkaosform'])->name('front.admin_pilkaosform')->middleware('guest');
Route::post('/pilkaos/', [FrontController::class, 'cekpilkaos'])->name('front.admin_cekpilkaos')->middleware('guest');

/* admin */
Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('auth');   /* halaman beranda */

/* halaman admin-user */
Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users_index')->middleware('auth'); /* halaman menu utama */
Route::get('/admin/usersshow', [UsersController::class, 'show'])->name('admin.users_show')->middleware('auth'); /* menampilkan data menu utama pada datatable javascript */
Route::post('/admin/userscreate', [UsersController::class, 'create'])->name('admin.users_create')->middleware('auth'); /* menambah data user */
Route::get('/admin/usersedit/{id}', [UsersController::class, 'edit'])->middleware('auth'); /* menampilkan data menu utama yang akan dirubah */
Route::delete('/admin/usersdestroy/{id}', [UsersController::class, 'destroy'])->middleware('auth'); /* hapus data menu utama */
Route::get('/admin/userslistaplikasi', [UsersController::class, 'listaplikasi'])->name('admin.users_listaplikasi')->middleware('auth'); /* list aplikasi */

/* halaman admin-instansi */
Route::get('/admin/instansi', [InstansiController::class, 'index'])->name('admin.instansi_index')->middleware('auth'); /* halaman menu utama */
Route::get('/admin/instansishow', [InstansiController::class, 'show'])->name('admin.instansi_show')->middleware('auth'); /* menampilkan data menu utama pada datatable javascript */
Route::post('/admin/instansiupdate', [InstansiController::class, 'update'])->name('admin.instansi_update')->middleware('auth'); /* update data instansi */

/* halaman admin-menuutama */
Route::get('/admin/menuutama', [MenuutamaController::class, 'index'])->name('admin.menuutama_index')->middleware('auth'); /* halaman menu utama */
Route::get('/admin/menuutamashow', [MenuutamaController::class, 'show'])->name('admin.menuutama_show')->middleware('auth'); /* menampilkan data menu utama pada datatable javascript */
Route::post('/admin/menuutamacreate', [MenuutamaController::class, 'create'])->name('admin.menuutama_create')->middleware('auth'); /* menambah data menuutama */
Route::get('/admin/menuutamaedit/{id}', [MenuutamaController::class, 'edit'])->middleware('auth'); /* menampilkan data menu utama yang akan dirubah */
Route::delete('/admin/menuutamadestroy/{id}', [MenuutamaController::class, 'destroy'])->middleware('auth'); /* hapus data menu utama */

/* halaman admin-menusub */
Route::get('/admin/menusub', [MenusubController::class, 'index'])->name('admin.menusub_index')->middleware('auth'); /* halaman menu sub */
Route::get('/admin/menusubshow', [MenusubController::class, 'show'])->name('admin.menusub_show')->middleware('auth'); /* menampilkan data menu sub pada datatable javascript */
Route::post('/admin/menusubcreate', [MenusubController::class, 'create'])->name('admin.menusub_create')->middleware('auth'); /* menambah data menusub */
Route::get('/admin/menusubedit/{id}', [MenusubController::class, 'edit'])->middleware('auth'); /* menampilkan data menu sub yang akan dirubah */
Route::delete('/admin/menusubdestroy/{id}', [MenusubController::class, 'destroy'])->middleware('auth'); /* hapus data menu sub */
Route::get('/admin/menusublistmenuutama', [MenusubController::class, 'listmenuutama'])->name('admin.menusub_listmenuutama')->middleware('auth'); /* list menuutama */
Route::get('/admin/menusublistaplikasi', [MenusubController::class, 'listaplikasi'])->name('admin.menusub_listaplikasi')->middleware('auth'); /* list aplikasi */
Route::post('/admin/menusubkirimsyarat', [MenusubController::class, 'kirimsyarat'])->name('admin.menusub_kirimsyarat')->middleware('auth'); /* kirim syarat */

