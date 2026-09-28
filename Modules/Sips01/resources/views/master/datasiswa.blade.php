@extends('admin.layouts.main')

@section('contents')

@php
    $kunci1 = auth()->user()->kunci1;
    $kunci2 = auth()->user()->kunci2;    
    $level = auth()->user()->levels;
    foreach ($menu as $item) {
        $idaplikasi = $item->idaplikasi;
    }
@endphp

@php
    $idtp = session('idtp');    
@endphp 

<style>
    tr.baris-tidak-aktif td {
        background-color: #ffc0cb !important;
        color: #000000 !important;
        --bs-table-bg: #ffc0cb !important; /* Untuk kompatibilitas penuh dengan Bootstrap 5 */
    }
</style>

@if($kunci1==1)
    <div class="container-fluid px-0" style="display:block"> 
@else
    @if($idaplikasi<>$kunci1)
        <div>
            @include('admin.layouts.forbidden')
        </div>

        <div class="container-fluid px-0" style="display:none"> 
    @else
        <div class="container-fluid px-0" style="display:block">
    @endif
@endif

    <div class="card-header border-0 bg-transparent px-0 py-0">
    
        <div class="row g-3 align-items-center">
            
            <!-- Kolom Kiri: Area Filter Input/Select -->
            <div class="col-md-6">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <label for="idtpx1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Tahun Pelajaran
                    </label>
                    <div class="col-sm-4">
                        <select name="idtpx1" id="idtpx1" value="{{ $idtp }}" class="form-select">
                            <option value="" selected disabled>-- Pilih Tahun Pelajaran --</option>
                        </select>
                    </div>
                </div>
                
                <!-- Baris Filter 2 -->
                <div class="row mb-0 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label mb-md-0 small fw-bold"></label>
                    </div>
                    <div class="col-md-7">
                        {{-- Tempatkan Form Input/Select 2 di sini --}}
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Area Tombol Aksi Mandiri -->
            <div class="col-md-6 mt-0">
                <!-- d-flex & justify-content-md-end menggantikan w3-row dan align="right" -->
                <div class="d-flex justify-content-md-end align-items-center gap-2">
                    <input name="levelx" id="levelx" type="hidden" value="{{ auth()->user()->levels }}">           
                    <!-- Tombol Refresh (Menggunakan Bootstrap Icons & Kelas btn-success standar) -->
                    <a href="{{ url('/') }}{{ $link }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-clockwise fs-6"></i> Refresh
                    </a>            
                    <!-- Tombol Tambah (Menggunakan Bootstrap Icons & Kelas btn-primary standar) -->
                    <button id="btn_tambah1" name="btn_tambah1" type="button" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg fs-6 fw-bold"></i> Tambah
                    </button>

                    <button id="btn_importexcel1x" name="btn_importexcel1x" type="button" class="btn btn-warning text-white d-inline-flex align-items-center gap-2" style="height: 36px;">
                        <i class="bi bi-file-earmark-excel" style="font-size: 18px;"></i> Import
                    </button>

                    <button id="btn_kirim1x" name="btn_kirim1x" type="button" class="btn btn-info text-white d-inline-flex align-items-center gap-2" style="height: 36px;">
                        <i class="bi bi-database-up" style="font-size: 18px;"></i> Kirim
                    </button>

                </div> 
            </div>
        </div>
        
    </div>

    <div class="card-body px-0 py-0" id="headerjudul" style="display: block;">

        <!-- tab-pesertadidik1 -->
        <ul class="nav nav-tabs" id="tab-pesertadidik1" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="identitas-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#identitas-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="#identitas-isi-tab-pesertadidik1" aria-selected="true">Identitas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="datadiri-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#datadiri-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="datadiri--isi-tab-pesertadidik1" aria-selected="false">Data Diri</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="tempattinggal-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#tempattinggal-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="tempattinggal-isi-tab-pesertadidik1" aria-selected="false">Tempat Tinggal</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kesehatan-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#kesehatan-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="kesehatan-isi-tab-pesertadidik1" aria-selected="false">Kesehatan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pendidikan-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#pendidikan-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="pendidikan-isi-tab-pesertadidik1" aria-selected="false">Pendidikan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ayahkandung-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#ayahkandung-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="ayahkandung-isi-tab-pesertadidik1" aria-selected="false">Ayah Kandung</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ibukandung-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#ibukandung-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="ibukandung-isi-tab-pesertadidik1" aria-selected="false">Ibu Kandung</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="wali-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#wali-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="wali-isi-tab-pesertadidik1" aria-selected="false">Wali</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="hobi-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#hobi-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="hobi-isi-tab-pesertadidik1" aria-selected="false">Hobi</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="perkembangan-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#perkembangan-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="perkembangan-isi-tab-pesertadidik1" aria-selected="false">Perkembangan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="selesai-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#selesai-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="selesai-isi-tab-pesertadidik1" aria-selected="false">Selesai</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="images-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#images-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="images-isi-tab-pesertadidik1" aria-selected="false">Images</button>
            </li>
        </ul>
        <!-- end-tab-pesertadidik1 -->

        <!-- tabcontent-tab-pesertadidik1 -->
        <div class="tab-content p-3 border border-top-0" id="tabcontent-tab-pesertadidik1">            
            <!-- identitas-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade show active" id="identitas-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="identitas-tab-pesertadidik1" tabindex="0">
                <div id="reload-identitas1" class="table-responsive">
                    <table id="identitas1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>                            
                                <th style="width:50px">Ecard</th>							
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>							
                                <th style="width:50px">TP Masuk</th>							
                                <th style="width:50px">Tgl Diterima</th>							
                                <th style="width:50px">Status Siswa</th>							
                                <th style="width:100px">Kompetensi</th>							                                    
                                <th style="width:50px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_identitas1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_identitas1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end identitas-isi-tab-pesertadidik1 -->
            
            <!-- datadiri-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="datadiri-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="datadiri-tab-pesertadidik1" tabindex="0">
                <div id="reload-datadiri1" class="table-responsive">
                    <table id="datadiri1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>                            
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>							
                                <th style="width:200px">Nama Panggilan</th>							
                                <th style="width:50px">TTL</th>							
                                <th style="width:50px">L/P</th>							
                                <th style="width:50px">Agama</th>							
                                <th style="width:50px">Warganegara</th>							
                                <th style="width:50px">Bahasa<br>Harian</th>							
                                <th style="width:10px">Status Anak</th>							
                                <th style="width:10px">Anak Ke</th>							
                                <th style="width:50px">Jml Saudara<br>Kdg|Tiri|Angt</th>							
                                <th style="width:50px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_datadiri1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_datadiri1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end datadiri-isi-tab-pesertadidik1 -->

            <!-- tempattinggal-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="tempattinggal-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="tempattinggal-tab-pesertadidik1" tabindex="0">
                <div id="reload-tempattinggal1" class="table-responsive">
                    <table id="tempattinggal1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>							
                                <th style="width:150">Alamat</th>
                                <th style="width:150">Desa<br> Kecamatan<br> Kab./Kodya<br> Propinsi</th>
                                <th style="width:80">Telp/HP</th>							
                                <th style="width:80">Email</th>							
                                <th style="width:80">Jrk ke Sklh<br>(km)</th>							
                                <th style="width:80">Tinggal bersama</th>							                                    
                                <th style="width:50px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_tempattinggal1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_tempattinggal1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end tempattinggal-isi-tab-pesertadidik1 -->
            
            <!-- kesehatan-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="kesehatan-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="kesehatan-tab-pesertadidik1" tabindex="0">
                <div id="reload-kesehatan1" class="table-responsive">
                    <table id="kesehatan1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:50px">Penyakit yang pernah diderita</th>
                                <th style="width:50px">Kelainan Jasmani</th>
                                <th style="width:50px">Golongan<br>darah</th>
                                <th style="width:50px">Tinggi badan<br>(cm)</th>
                                <th style="width:50px">Berat badan<br>(kg)</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_kesehatan1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_kesehatan1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end kesehatan-isi-tab-pesertadidik1 -->

            <!-- pendidikan-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="pendidikan-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="pendidikan-tab-pesertadidik1" tabindex="0">
                <div id="reload-pendidikan1" class="table-responsive">
                    <table id="pendidikan1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:50px">Asal Sekolah</th>
                                <th style="width:50px">Tanggal Ijasah</th>
                                <th style="width:50px">Nomor Ijasah</th>
                                <th style="width:50px">Tanggal SKHUN</th>
                                <th style="width:50px">Nomor SKHUN</th>
                                <th style="width:50px">Lama belajar<br>(tahun)</th>
                                <th style="width:50px">Pindahan</th>
                                <th style="width:50px">Dari Sekolah</th>
                                <th style="width:50px">Alasan Pindah</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_pendidikan1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_pendidikan1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end pendidikan-isi-tab-pesertadidik1 -->

             <!-- ayahkandung-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="ayahkandung-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="ayahkandung-tab-pesertadidik1" tabindex="0">
                <div id="reload-ayahkandung1" class="table-responsive">
                    <table id="ayahkandung1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:50px">Nama Ayah</th>
                                <th style="width:50px">Tempat Lahir<br>Tanggal Lahir<br>Umur(thn)</th>
                                <th style="width:50px">Pekerjaan<br>Penghasilan<br>Pengeluaran</th>
                                <th style="width:150">Alamat</th>
                                <th style="width:150">Desa<br> Kecamatan<br> Kab./Kodya<br> Propinsi</th>
                                <th style="width:80">Telp/HP</th>
                                <th style="width:50px">Masih Hidup(Y/N)<br>Tgl.Meninggal</th>
                                <th style="width:10px">Action</th>
                        </tr>
                        </thead>
                        <tfoot id="show_footer_ayahkandung1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_ayahkandung1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end ayahkandung-isi-tab-pesertadidik1 -->

             <!-- ibukandung-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="ibukandung-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="ibukandung-tab-pesertadidik1" tabindex="0">
                <div id="reload-ibukandung1" class="table-responsive">
                    <table id="ibukandung1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:50px">Nama Ibu</th>
                                <th style="width:50px">Tempat Lahir<br>Tanggal Lahir<br>Umur(thn)</th>
                                <th style="width:50px">Pekerjaan<br>Penghasilan<br>Pengeluaran</th>
                                <th style="width:150">Alamat</th>
                                <th style="width:150">Desa<br> Kecamatan<br> Kab./Kodya<br> Propinsi</th>
                                <th style="width:80">Telp/HP</th>
                                <th style="width:50px">Masih Hidup(Y/N)<br>Tgl.Meninggal</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_ibukandung1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_ibukandung1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end ibukandung-isi-tab-pesertadidik1 -->

             <!-- wali-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="wali-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="wali-tab-pesertadidik1" tabindex="0">
                <div id="reload-wali1" class="table-responsive">
                    <table id="wali1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:50px">Nama Wali</th>
                                <th style="width:50px">Tempat Lahir<br>Tanggal Lahir<br>Umur(thn)</th>
                                <th style="width:50px">Pekerjaan<br>Penghasilan<br>Pengeluaran</th>
                                <th style="width:150">Alamat</th>
                                <th style="width:150">Desa<br> Kecamatan<br> Kab./Kodya<br> Propinsi</th>
                                <th style="width:80">Telp/HP</th>
                                <th style="width:50px">Masih Hidup(Y/N)<br>Tgl.Meninggal</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_wali1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_wali1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end wali-isi-tab-pesertadidik1 -->

             <!-- hobi-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="hobi-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="hobi-tab-pesertadidik1" tabindex="0">
                <div id="reload-hobi1" class="table-responsive">
                    <table id="hobi1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>
                                <th style="width:50px">Kesenian</th>
                                <th style="width:50px">Olahraga</th>
                                <th style="width:50px">Organisasi</th>                                    
                                <th style="width:50px">Lainnya</th>                                    
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_hobi1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_hobi1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end hobi-isi-tab-pesertadidik1 -->

             <!-- perkembangan-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="perkembangan-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="perkembangan-tab-pesertadidik1" tabindex="0">
                <div id="reload-perkembangan1" class="table-responsive">
                    <table id="perkembangan1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>							
                                <th style="width:20px">Beasiswa</th>							
                                <th style="width:30px">TP Keluar</th>							
                                <th style="width:50px">Tgl.Keluar</th>							
                                <th style="width:50px">Alasan Keluar</th>							
                                <th style="width:50px">Tgl.Ijasah</th>							
                                <th style="width:50px">Nomor Ijasah</th>							
                                <th style="width:50px">Tgl.SKHUN</th>							
                                <th style="width:50px">Nomor SKHUN</th>							
                                <th style="width:100px">Keterangan</th>							
                                <th style="width:10px">Aktif</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_perkembangan1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_perkembangan1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end perkembangan-isi-tab-pesertadidik1 -->

             <!-- selesai-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="selesai-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="selesai-tab-pesertadidik1" tabindex="0">
                <div id="reload-selesai1" class="table-responsive">
                    <table id="selesai1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIS</th>
                                <th style="width:50px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>							
                                <th style="width:100px">Alasan Setelah Keluar</th>							
                                <th style="width:100px">Melanjutkan Ke</th>							
                                <th style="width:100px">Jurusan</th>							
                                <th style="width:100px">Bekerja di</th>							
                                <th style="width:20px">Tgl.Mulai</br>kerja</th>							
                                <th style="width:100px">Nama Perusahaan</th>							
                                <th style="width:10px">Penghasilan<br>(per bulan)</th>							
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_selesai1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_selesai1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end selesai-isi-tab-pesertadidik1 -->

             <!-- images-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="images-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="images-tab-pesertadidik1" tabindex="0">
                <div id="reload-images1" class="table-responsive">
                    <table id="images1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:20px">Ecard</th>
                                <th style="width:20px">NIS</th>
                                <th style="width:20px">NISN</th>
                                <th style="width:200px">Nama Lengkap</th>							
                                <th style="width:20px">Foto Awal</th>							
                                <th style="width:20px">Foto Akhir</th>							
                                <th style="width:20px">Foto KTP</th>							
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_images1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_images1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end images-isi-tab-pesertadidik1 -->

        </div>
        <!-- end tabcontent-tab-pesertadidik1 -->

        <!-- ModalAdd modal fade-->
        <div class="modal fade" id="ModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div id="modalx" name="modalx" class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div id="warnax" class="modal-header bg-primary text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i id="iconx"></i>
                            <span id="judulx" class="fw-bold">Tambah Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- end Modal Header -->

                    <!-- Form -->
                    <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">
                                <!-- ID & Hidden Fields -->
                                <input type="hidden" name="id1" id="id1">
                                <input type="hidden" name="cek1" id="cek1">
                            
                                <!-- tab-pesertadidik2 -->
                                <ul class="nav nav-tabs" id="tab-pesertadidik2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="identitas-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#identitas-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="#identitas-isi-tab-pesertadidik2" aria-selected="true">Identitas</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="datadiri-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#datadiri-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="datadiri--isi-tab-pesertadidik2" aria-selected="false">Data Diri</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="tempattinggal-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#tempattinggal-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="tempattinggal-isi-tab-pesertadidik2" aria-selected="false">Tempat Tinggal</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="kesehatan-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#kesehatan-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="kesehatan-isi-tab-pesertadidik2" aria-selected="false">Kesehatan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="pendidikan-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#pendidikan-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="pendidikan-isi-tab-pesertadidik2" aria-selected="false">Pendidikan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ayahkandung-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#ayahkandung-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="ayahkandung-isi-tab-pesertadidik2" aria-selected="false">Ayah Kandung</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="ibukandung-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#ibukandung-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="ibukandung-isi-tab-pesertadidik2" aria-selected="false">Ibu Kandung</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="wali-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#wali-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="wali-isi-tab-pesertadidik2" aria-selected="false">Wali</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="hobi-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#hobi-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="hobi-isi-tab-pesertadidik2" aria-selected="false">Hobi</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="perkembangan-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#perkembangan-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="perkembangan-isi-tab-pesertadidik2" aria-selected="false">Perkembangan</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="selesai-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#selesai-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="selesai-isi-tab-pesertadidik2" aria-selected="false">Selesai</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="images-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#images-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="images-isi-tab-pesertadidik2" aria-selected="false">Images</button>
                                    </li>
                                </ul>
                                <!-- end-tab-pesertadidik2 -->

                                <!-- tabcontent-tab-pesertadidik2 -->
                                <div class="tab-content p-3 border border-top-0" id="tabcontent-tab-pesertadidik2">            
                                    <!-- identitas-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade show active" id="identitas-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="identitas-tab-pesertadidik2" tabindex="0">
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="namalengkap1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama Lengkap<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="namalengkap1" id="namalengkap1" maxlength="200" class="form-control" placeholder="Nama Lengkap" value="{{ old('namalengkap1') }}"  required autofocus>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="ecard1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Ecard<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="ecard1" id="ecard1" maxlength="25" class="form-control" placeholder="Ecard" value="{{ old('ecard1') }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="nis1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                NIS<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nis1" id="nis1" maxlength="25" class="form-control" placeholder="NIS" value="{{ old('nis1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="nisn1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                NISN<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nisn1" id="nisn1" maxlength="25" class="form-control" placeholder="NISN" value="{{ old('nisn1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tglditerima1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Diterima
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglditerima1" id="tglditerima1" maxlength="10" class="form-control" placeholder="Tanggal Diterima" value="{{ old('tglditerima1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="idstatussiswa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Status Siswa
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idstatussiswa1" id="idstatussiswa1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Status Siswa --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <style>
                                            #btn_carikompetensi1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_carikompetensi1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_carikompetensi1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idkompetensi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Kompetensi
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="idkompetensi1" id="idkompetensi1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Kompetensi --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_carikompetensi1" name="btn_carikompetensi1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                                
                                            </div>
                                        </div>

                                        <div class="row mb-0 mt-0 py-0 align-items-center">
                                            <div class="col-sm-1">
                                                
                                                {{--  --}}
                                            </div>
                                            <label class="col-sm-11 col-form-label text-sm-first fw-semibold">
                                                <small class="text-muted"><span class="text-danger">*</span> Wajib diisi.</small>
                                            </label>
                                        </div>

                                        
                                    </div>
                                    <!-- end identitas-isi-tab-pesertadidik2 -->
                                    
                                    <!-- datadiri-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="datadiri-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="datadiri-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="namapanggilan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama Panggilan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="namapanggilan1" id="namapanggilan1" maxlength="50" class="form-control" placeholder="Nama Panggilan" value="{{ old('namapanggilan1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caritempatlahir1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caritempatlahir1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caritempatlahir1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idtempatlahir1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tempat Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="idtempatlahir1" id="idtempatlahir1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Tempat Lahir --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caritempatlahir1" name="btn_caritempatlahir1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tgllahir1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tgllahir1" id="tgllahir1" maxlength="10" class="form-control" placeholder="Tanggal Lahir" value="{{ old('tgllahir1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idjk1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jenis Kelamin
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idjk1" id="idjk1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Jk --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="idagama1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Agama
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idagama1" id="idagama1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Agama --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="warganegara1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Warganegara
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="warganegara1" id="warganegara1" maxlength="50" class="form-control" placeholder="Warganegara" value="{{ old('warganegara1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="bahasa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Bahasa Sehari-hari
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="bahasa1" id="bahasa1" maxlength="30" class="form-control" placeholder="Bahasa Sehari-hari" value="{{ old('bahasa1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idstatusanak1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Status Anak
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idstatusanak1" id="idstatusanak1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Status Anak --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="anakke1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Anak ke
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="anakke1" id="anakke1" maxlength="2" min="1" max="12" class="form-control" placeholder="Anak ke" value="1" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="jmlsdrkandung1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jml Sdr.kandung
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="d-flex flex-row mb-0">
                                                    <div class="col-sm-2">
                                                        <input type="number" name="jmlsdrkandung1" id="jmlsdrkandung1" maxlength="2" min="0" max="9" class="form-control" placeholder="" value="0" >
                                                    </div>
                                                    <label for="jmlsdrtiri1" class="col-sm-3 col-form-label text-sm-center fw-semibold">
                                                        Tiri
                                                    </label>
                                                    <div class="col-sm-2">
                                                        <input type="number" name="jmlsdrtiri1" id="jmlsdrtiri1" maxlength="2" min="0" max="9" class="form-control" placeholder="" value="0" >
                                                    </div>
                                                    <label for="jmlsdrtiri1" class="col-sm-3 col-form-label text-sm-center fw-semibold">
                                                        Angkat
                                                    </label>
                                                    <div class="col-sm-2">
                                                        <input type="number" name="jmlsdrangkat1" id="jmlsdrangkat1" maxlength="2" min="0" max="9" class="form-control" placeholder="" value="0" >
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end datadiri-isi-tab-pesertadidik2 -->

                                    <!-- tempattinggal-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="tempattinggal-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="tempattinggal-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="alamat1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alamat
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="alamat1" id="alamat1" maxlength="50" class="form-control" placeholder="Alamat" value="{{ old('alamat1') }}" >
                                            </div>
                                        </div>

                                        <style>
                                            #btn_caridesa1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caridesa1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caridesa1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="iddesa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Desa/Kel.
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="iddesa1" id="iddesa1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Desa --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caridesa1" name="btn_caridesa1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>                                                
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="telp1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Telp.
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="telp1" id="telp1" maxlength="30" class="form-control" placeholder="Telp" value="{{ old('telp1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="email1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Email
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email1" id="email1" maxlength="30" class="form-control" placeholder="Email" value="{{ old('email1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="jarakkesekolah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jarak Sekolah(km)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="jarakkesekolah1" id="jarakkesekolah1" maxlength="2" class="form-control" placeholder="" value="1" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idtinggal1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tinggal Bersama
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idtinggal1" id="idtinggal1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Tinggal Bersama --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end tempattinggal-isi-tab-pesertadidik2 -->
                                    
                                    <!-- kesehatan-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="kesehatan-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="kesehatan-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="penyakit1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Penyakit
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="penyakit1" id="penyakit1" maxlength="50" class="form-control" placeholder="Penyakit" value="{{ old('penyakit1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="kelainan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Kelainan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="kelainan1" id="kelainan1" maxlength="50" class="form-control" placeholder="Kelainan" value="{{ old('kelainan1') }}" >
                                            </div>
                                        </div>  

                                        <div class="row mb-1 align-items-center">
                                            <label for="idgd1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Golongan Darah
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idgd1" id="idgd1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Golongan Darah --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tinggibadan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tinggi Badan (cm)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="tinggibadan1" id="tinggibadan1" maxlength="4" min="1" max="999" class="form-control" placeholder="Tinggi badan" value="160" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="beratbadan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Berat Badan (kg)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="beratbadan1" id="beratbadan1" maxlength="4" min="1" max="999" class="form-control" placeholder="Berat badan" value="50" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end kesehatan-isi-tab-pesertadidik2 -->
                                    
                                    <!-- pendidikan-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="pendidikan-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="pendidikan-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="asalsekolah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Asal Sekolah
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="asalsekolah1" id="asalsekolah1" maxlength="50" class="form-control" placeholder="Asal sekolah" value="{{ old('asalsekolah1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tglsttb1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Ijazah
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglsttb1" id="tglsttb1" maxlength="10" class="form-control" placeholder="Tgl ijazah" value="{{ old('tglsttb1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="nomorsttb1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nomor Ijazah
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nomorsttb1" id="nomorsttb1" maxlength="50" class="form-control" placeholder="Nomor Ijazah" value="{{ old('nomorsttb1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tglskhun1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal SKL/SKHUN
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglskhun1" id="tglskhun1" maxlength="10" class="form-control" placeholder="Tgl SKL/SKHUN" value="{{ old('tglskhun1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="nomorskhun1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nomor SKL/SKHUN
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nomorskhun1" id="nomorskhun1" maxlength="50" class="form-control" placeholder="Nomor SKL/SKHUN" value="{{ old('nomorskhun1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="lamabelajar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Lama Belajar (Thn)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="lamabelajar1" id="lamabelajar1" maxlength="2" min="1" max="9" class="form-control" placeholder="Berat badan" value="3" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="pindah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pindahan</br><small class="text-muted">(siswa pindahan)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pindah1" id="pindah1" maxlength="50" class="form-control" placeholder="Pindah" value="{{ old('pindah1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="sekolahpindah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Dari Sekolah</br><small class="text-muted">(siswa pindahan)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="sekolahpindah1" id="sekolahpindah1" maxlength="50" class="form-control" placeholder="dari sekolah" value="{{ old('sekolahpindah1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="alasanpindah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alasan Pindah</br><small class="text-muted">(siswa pindahan)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="alasanpindah1" id="alasanpindah1" maxlength="50" class="form-control" placeholder="Alasan Pindah" value="{{ old('alasanpindah1') }}" >
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end pendidikan-isi-tab-pesertadidik2 -->

                                    <!-- ayahkandung-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="ayahkandung-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="ayahkandung-tab-pesertadidik2" tabindex="0">
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="namaayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama Ayah
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="namaayah1" id="namaayah1" maxlength="50" class="form-control" placeholder="Nama Ayah" value="{{ old('namaayah1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caritempatlahirayah1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caritempatlahirayah1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caritempatlahirayah1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="idtempatlahirayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tempat Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="idtempatlahirayah1" id="idtempatlahirayah1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Tempat Lahir --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caritempatlahirayah1" name="btn_caritempatlahirayah1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tgllahirayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tgllahirayah1" id="tgllahirayah1" maxlength="10" class="form-control" placeholder="tgllahirayah1" value="{{ old('tgllahirayah1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="umurayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Umur (thn)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="umurayah1" id="umurayah1" maxlength="3" min="1" max="999" class="form-control" placeholder="umurayah1" value="30" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idagamaayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Agama
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idagamaayah1" id="idagamaayah1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Agama --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idpendidikanayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pendidikan
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idpendidikanayah1" id="idpendidikanayah1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Pendidikan --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="warganegaraayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Warganegara
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="warganegaraayah1" id="warganegaraayah1" maxlength="50" class="form-control" placeholder="warganegara" value="{{ old('warganegaraayah1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="pekerjaanayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pekerjaan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pekerjaanayah1" id="pekerjaanayah1" maxlength="50" class="form-control" placeholder="pekerjaan" value="{{ old('pekerjaanayah1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="penghasilanayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Penghasilan/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="penghasilanayah1" id="penghasilanayah1" class="form-control" placeholder="penghasilan1" value="0" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="pengeluaranayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pengeluaran/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pengeluaranayah1" id="pengeluaranayah1" class="form-control" placeholder="pengeluaran1" value="0" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="alamatayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alamat
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="alamatayah1" id="alamatayah1" maxlength="50" class="form-control" placeholder="alamat" value="{{ old('alamatayah1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caridesaayah1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caridesaayah1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caridesaayah1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="iddesaayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Desa
                                            </label>
                                            <div class="col-sm-8">                                               
                                                <div class="input-group">
                                                    <select name="iddesaayah1" id="iddesaayah1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Desa --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caridesaayah1" name="btn_caridesaayah1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="telpayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Telp.
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="telpayah1" id="telpayah1" maxlength="50" class="form-control" placeholder="telp." value="{{ old('telpayah1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="hidupayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Masih Hidup
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hidupayah1" id="hidupayah1xy" value="Y" checked>
                                                        <label class="form-check-label" for="hidupayah1xy">Y</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hidupayah1" id="hidupayah1xn" value="N">
                                                        <label class="form-check-label" for="hidupayah1xn">N</label>
                                                    </div>
                                                    <input name="hidupayah1" id="hidupayah1" type="hidden" value="Y">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglmeninggalayah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tgl.Meninggal
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglmeninggalayah1" id="tglmeninggalayah1" maxlength="10" class="form-control" placeholder="tanggal" value="{{ old('tglmeninggalayah1') }}" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end ayahkandung-isi-tab-pesertadidik2 -->

                                    <!-- ibukandung-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="ibukandung-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="ibukandung-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="namaibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama Ibu
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="namaibu1" id="namaibu1" maxlength="50" class="form-control" placeholder="Nama Ibu" value="{{ old('namaibu1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caritempatlahiribu1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caritempatlahiribu1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caritempatlahiribu1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="idtempatlahiribu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tempat Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="idtempatlahiribu1" id="idtempatlahiribu1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Tempat Lahir --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caritempatlahiribu1" name="btn_caritempatlahiribu1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tgllahiribu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tgllahiribu1" id="tgllahiribu1" maxlength="10" class="form-control" placeholder="tgllahiribu1" value="{{ old('tgllahiribu1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="umuribu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Umur (thn)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="umuribu1" id="umuribu1" maxlength="3" min="1" max="999" class="form-control" placeholder="umuribu1" value="30" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idagamaibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Agama
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idagamaibu1" id="idagamaibu1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Agama --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idpendidikanibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pendidikan
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idpendidikanibu1" id="idpendidikanibu1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Pendidikan --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="warganegaraibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Warganegara
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="warganegaraibu1" id="warganegaraibu1" maxlength="50" class="form-control" placeholder="warganegara" value="{{ old('warganegaraibu1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="pekerjaanibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pekerjaan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pekerjaanibu1" id="pekerjaanibu1" maxlength="50" class="form-control" placeholder="pekerjaan" value="{{ old('pekerjaanibu1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="penghasilanibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Penghasilan/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="penghasilanibu1" id="penghasilanibu1" class="form-control" placeholder="penghasilan1" value="0" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="pengeluaranibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pengeluaran/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pengeluaranibu1" id="pengeluaranibu1" class="form-control" placeholder="pengeluaran1" value="0" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="alamatibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alamat
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="alamatibu1" id="alamatibu1" maxlength="50" class="form-control" placeholder="alamat" value="{{ old('alamatibu1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caridesaibu1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caridesaibu1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caridesaibu1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="iddesaibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Desa
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="iddesaibu1" id="iddesaibu1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Desa --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caridesaibu1" name="btn_caridesaibu1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="telpibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Telp.
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="telpibu1" id="telpibu1" maxlength="50" class="form-control" placeholder="telp." value="{{ old('telpibu1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="hidupibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Masih Hidup
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hidupibu1" id="hidupibu1xy" value="Y" checked>
                                                        <label class="form-check-label" for="hidupibu1xy">Y</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hidupibu1" id="hidupibu1xn" value="N">
                                                        <label class="form-check-label" for="hidupibu1xn">N</label>
                                                    </div>
                                                    <input name="hidupibu1" id="hidupibu1" type="hidden" value="Y">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglmeninggalibu1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tgl.Meninggal
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglmeninggalibu1" id="tglmeninggalibu1" maxlength="10" class="form-control" placeholder="tanggal" value="{{ old('tglmeninggalibu1') }}" >
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end ibukandung-isi-tab-pesertadidik2 -->

                                    <!-- wali-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="wali-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="wali-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="namawali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama Wali
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="namawali1" id="namawali1" maxlength="50" class="form-control" placeholder="Nama Wali" value="{{ old('namawali1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caritempatlahirwali1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caritempatlahirwali1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caritempatlahirwali1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="idtempatlahirwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tempat Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="idtempatlahirwali1" id="idtempatlahirwali1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Tempat Lahir --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caritempatlahirwali1" name="btn_caritempatlahirwali1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tgllahirwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tgllahirwali1" id="tgllahirwali1" maxlength="10" class="form-control" placeholder="tgllahirwali1" value="{{ old('tgllahirwali1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="umurwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Umur (thn)
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="number" name="umurwali1" id="umurwali1" maxlength="3" min="1" max="999" class="form-control" placeholder="umurwali1" value="30" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idagamawali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Agama
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idagamawali1" id="idagamawali1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Agama --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idpendidikanwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pendidikan
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idpendidikanwali1" id="idpendidikanwali1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Pendidikan --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="warganegarawali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Warganegara
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="warganegarawali1" id="warganegarawali1" maxlength="50" class="form-control" placeholder="warganegara" value="{{ old('warganegarawali1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="pekerjaanwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pekerjaan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pekerjaanwali1" id="pekerjaanwali1" maxlength="50" class="form-control" placeholder="pekerjaan" value="{{ old('pekerjaanwali1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="penghasilanwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Penghasilan/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="penghasilanwali1" id="penghasilanwali1" class="form-control" placeholder="penghasilan1" value="0" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="pengeluaranwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pengeluaran/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="pengeluaranwali1" id="pengeluaranwali1" class="form-control" placeholder="pengeluaran1" value="0" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="alamatwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alamat
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="alamatwali1" id="alamatwali1" maxlength="50" class="form-control" placeholder="alamat" value="{{ old('alamatwali1') }}" >
                                            </div>
                                        </div>
                                        
                                        <style>
                                            #btn_caridesawali1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_caridesawali1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_caridesawali1:focus {
                                                /* Efek shadow biru langit saat fokus */
                                                box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                                border-color: #87cefa !important;
                                            }
                                        </style>
                                        <div class="row mb-1 align-items-center">
                                            <label for="iddesawali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Desa
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <select name="iddesawali1" id="iddesawali1" class="form-select">
                                                        <option value="" selected disabled>-- Pilih Desa --</option>
                                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                    </select>
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caridesawali1" name="btn_caridesawali1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="telpwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Telp.
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="telpwali1" id="telpwali1" maxlength="50" class="form-control" placeholder="telp." value="{{ old('telpwali1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="hidupwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Masih Hidup
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hidupwali1" id="hidupwali1xy" value="Y" checked>
                                                        <label class="form-check-label" for="hidupwali1xy">Y</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="hidupwali1" id="hidupwali1xn" value="N">
                                                        <label class="form-check-label" for="aktif1xn">N</label>
                                                    </div>
                                                    <input name="hidupwali1" id="hidupwali1" type="hidden" value="Y">
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglmeninggalwali1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tgl.Meninggal
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglmeninggalwali1" id="tglmeninggalwali1" maxlength="10" class="form-control" placeholder="tanggal" value="{{ old('tglmeninggalwali1') }}" >
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end wali-isi-tab-pesertadidik2 -->

                                    <!-- hobi-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="hobi-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="hobi-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="hobikesenian1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Kesenian
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="hobikesenian1" id="hobikesenian1" maxlength="50" class="form-control" placeholder="kesenian" value="{{ old('hobikesenian1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="hobiolahraga1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Olahraga
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="hobiolahraga1" id="hobiolahraga1" maxlength="50" class="form-control" placeholder="olahraga" value="{{ old('hobiolahraga1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="hobiorganisasi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Organisasi
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="hobiorganisasi1" id="hobiorganisasi1" maxlength="50" class="form-control" placeholder="organisasi1" value="{{ old('hobiorganisasi1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="hobilain1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Hobi Lainnya
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="hobilain1" id="hobilain1" maxlength="50" class="form-control" placeholder="lainnya" value="{{ old('hobilain1') }}" >
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end hobi-isi-tab-pesertadidik2 -->
                                   
                                    <!-- perkembangan-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="perkembangan-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="perkembangan-tab-pesertadidik2" tabindex="0">
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="idtpkeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                TP Keluar
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idtpkeluar1" id="idtpkeluar1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih TP --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="tglkeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Keluar
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglkeluar1" id="tglkeluar1" maxlength="10" class="form-control" placeholder="Tglkeluar" value="{{ old('tglkeluar1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="idalasankeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alasan Keluar
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idalasankeluar1" id="idalasankeluar1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Alasan Keluar --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="nomorijasahlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nomor Ijasah
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nomorijasahlulus1" id="nomorijasahlulus1" maxlength="50" class="form-control" placeholder="nomor ijasah" value="{{ old('nomorijasahlulus1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglijasahlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Ijasah
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglijasahlulus1" id="tglijasahlulus1" maxlength="10" class="form-control" placeholder="tanggal ijasah" value="{{ old('tglijasahlulus1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="nomorskhunlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nomor SKHUN
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nomorskhunlulus1" id="nomorskhunlulus1" maxlength="50" class="form-control" placeholder="nomor SKHUN" value="{{ old('nomorskhunlulus1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglskhunlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal SKHUN
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglskhunlulus1" id="tglskhunlulus1" maxlength="10" class="form-control" placeholder="tanggal SKHUN" value="{{ old('tglskhunlulus1') }}" >
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="keteranganlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Keterangan Lulus
                                            </label>
                                            <div class="col-sm-8">
                                                <textarea name="keteranganlulus1" id="keteranganlulus1" cols="" rows="5" style="width: 100%"></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="aktif1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Aktif
                                            </label>
                                            <div class="col-sm-8">
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aktif1" id="aktif1xy" value="Y" checked>
                                                        <label class="form-check-label" for="aktif1xy">Y</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="aktif1" id="aktif1xn" value="N">
                                                        <label class="form-check-label" for="aktif1xn">N</label>
                                                    </div>
                                                    <input name="aktif1" id="aktif1" type="hidden">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="btn_beasiswa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Beasiswa
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="button" name="btn_beasiswa1" id="btn_beasiswa1" class="form-control bg-info text-white" style="height: 36px" value="Beasiswa" >
                                            </div>
                                        </div>

                                    </div>
                                    <!-- end perkembangan-isi-tab-pesertadidik2 -->

                                    <!-- selesai-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="selesai-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="selesai-tab-pesertadidik2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="idalasansetelahkeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alasan Setelah Klr
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idalasansetelahkeluar1" id="idalasansetelahkeluar1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Alasan Setelah Keluar --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="sekolahlanjut1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Melanjutkan ke
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="sekolahlanjut1" id="sekolahlanjut1" maxlength="50" class="form-control" placeholder="melanjutka ke" value="{{ old('sekolahlanjut1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="jurusanlanjut1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jurusan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="jurusanlanjut1" id="jurusanlanjut1" maxlength="50" class="form-control" placeholder="jurusan" value="{{ old('jurusanlanjut1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="kerjadi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Bekerja di
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="kerjadi1" id="kerjadi1" maxlength="50" class="form-control" placeholder="bekerja di" value="{{ old('kerjadi1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglmulaikerja1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tgl.Mulai Kerja
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglmulaikerja1" id="tglmulaikerja1" maxlength="10" class="form-control" placeholder="Tanggal" value="{{ old('tglmulaikerja1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="namaperusahaan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama Perusahaan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="namaperusahaan1" id="namaperusahaan1" maxlength="50" class="form-control" placeholder="nama perusahaan" value="{{ old('namaperusahaan1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="penghasilankerja1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Penghasilan/bln
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="penghasilankerja1" id="penghasilankerja1" class="form-control" placeholder="penghasilan1" value="3.000.000" autofocus  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <!-- end selesai-isi-tab-pesertadidik2 -->

                                    <!-- images-isi-tab-pesertadidik2 -->
                                    <div class="tab-pane fade" id="images-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="images-tab-pesertadidik2" tabindex="0">
                                        
                                        <div class="row mb-0 align-items-start">
                                            <div class="col-sm-6">
                                                <label for="fotoawal1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                    Foto Awal
                                                </label>
                                                <!-- Input File -->
                                                <input type="file" name="fotoawal1" id="fotoawal1" 
                                                        class="form-control mb-2 @error('fotoawal1') is-invalid @enderror" 
                                                        accept="image/*">
                                                <!-- Error Handling Laravel -->
                                                @error('fotoawal1')
                                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                                @enderror
                                                <input type="hidden" name="fotoawal1x" id="fotoawal1x">
                                                <!-- Box Preview Image (Bootstrap 5 Flexbox) -->
                                                <div class="col-md-12">
                                                    <div class="card border" style="width: auto; height: 200px;">                                              
                                                        <div id="gambarfotoawal1" name="gambarfotoawal1" class="mb-1 w-100">                                                                         
                                                        </div> 
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-6">
                                                <label for="fotoakhir1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                    Foto Akhir
                                                </label>
                                                <!-- Input File -->
                                                <input type="file" name="fotoakhir1" id="fotoakhir1" 
                                                        class="form-control mb-2 @error('fotoakhir1') is-invalid @enderror" 
                                                        accept="image/*">
                                                <!-- Error Handling Laravel -->
                                                @error('fotoakhir1')
                                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                                @enderror
                                                <input type="hidden" name="fotoakhir1x" id="fotoakhir1x">
                                                <!-- Box Preview Image (Bootstrap 5 Flexbox) -->
                                                <div class="col-md-12">
                                                    <div class="card border" style="width: auto; height: 200px;">                                              
                                                        <div id="gambarfotoakhir1" name="gambarfotoakhir1" class="mb-1 w-100">                                                                         
                                                        </div> 
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row mb-0 align-items-start">
                                            <div class="col-sm-6">
                                                <label for="fotoktp1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                    Foto KTP
                                                </label>
                                                <!-- Input File -->
                                                <input type="file" name="fotoktp1" id="fotoktp1" 
                                                        class="form-control mb-2 @error('fotoktp1') is-invalid @enderror" 
                                                        accept="image/*">
                                                <!-- Error Handling Laravel -->
                                                @error('fotoktp1')
                                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                                @enderror
                                                <input type="hidden" name="fotoktp1x" id="fotoktp1x">
                                                <!-- Box Preview Image (Bootstrap 5 Flexbox) -->
                                                <div class="col-md-12">
                                                    <div class="card border" style="width: auto; height: 200px;">                                              
                                                        <div id="gambarfotoktp1" name="gambarfotoktp1" class="mb-1 w-100">                                                                         
                                                        </div> 
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                        
                                    </div>
                                    <!-- end images-isi-tab-pesertadidik2 -->

                                </div>
                                <!-- end tabcontent-tab-pesertadidik2 -->

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        

                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                            <div class="d-flex gap-2">
                                <button type="button" id="btn_baru" class="btn btn-outline-info">
                                    <i class="bi bi-plus-lg me-1"></i> Baru
                                </button>
                                <button type="button" id="btn_simpan" class="btn btn-outline-primary">
                                    <i class="bi bi-floppy me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- end Form -->

                </div>
            </div>
        </div>
        <!-- end ModalAdd -->

        <!-- ModalImport modal fade-->
        <div class="modal fade" id="ModalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-file-earmark-excel" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Import Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();" autocomplete="off">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">
                                
                            
                                <div class="d-flex justify-content-center align-items-center">
                                    <h5 class="py-4">File yang diimport : xls, xlsx</h5>
                                </div>

                                <style>
                                    #btn_download1 {
                                        /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                        border: 1px solid #ced4da !important; 
                                        color: #6c757d;
                                    }
                                    #btn_download1:hover {
                                        background-color: #d7d8d9;
                                        color: white;
                                    }
                                    #btn_download1:focus {
                                        /* Efek shadow biru langit saat fokus */
                                        box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                        border-color: #87cefa !important;
                                    }
                                    
                                </style>
                                
                                <div class="row mb-2">
                                    <div class="col-md-8 mt-1" align="right">
                                        <input style="widows: 100%; height: 40px;" name="fileimportx" id="fileimportx" type="file" class="form-control mb-1" accept=".xlsx, .xls, .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                    </div>
                                    <div class="col-md-4 mt-1 mb-1 px-0">                                
                                        <button style="widows: 100%; width: 93%; height: 40px; margin-right: 0px;" id="btn_download1" name="btn_download1" type="button" class="btn btn-outline-default"><i class="i bi-file-earmark-arrow-down" aria-hidden="true" style="font-size:18px"></i> Download Form</button>
                                    </div>
                                    {{-- <div class="col-md-4 mt-1 mb-1 px-0">                                
                                        <a href="{{ route('sips01.download.import-datasiswa-form') }}" style="widows: 100%; width: 93%; height: 40px; margin-right: 0px;" class="btn btn-outline-default">
                                            <i class="i bi-file-earmark-arrow-down" aria-hidden="true" style="font-size:18px"></i> Download Excel
                                        </a>
                                    </div> --}}
                                </div>
                                
                                <div class="row mb-1 align-items-center">
                                    <label for="tglditerimaimportx" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Tanggal Diterima
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="tglditerimaimportx" id="tglditerimaimportx" maxlength="50" class="form-control" placeholder="tanggal diterima">
                                    </div>
                                </div>

                                <style>
                                    #btn_carikompetensiimportx {
                                        /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                        border: 1px solid #ced4da !important; 
                                        color: #6c757d;
                                    }
                                    #btn_carikompetensiimportx:hover {
                                        background-color: #d7d8d9;
                                        color: white;
                                    }
                                    #btn_carikompetensiimportx:focus {
                                        /* Efek shadow biru langit saat fokus */
                                        box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                        border-color: #87cefa !important;
                                    }
                                    
                                </style>

                                <div class="row mb-1 align-items-center">
                                    <label for="idkompetensiimportx" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Kompetensi
                                    </label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <select name="idkompetensiimportx" id="idkompetensiimportx" class="form-select">
                                                <option value="" selected disabled>-- Pilih Kompetensi --</option>
                                                {{-- Option akan di-render via JS atau @foreach Blade --}}
                                            </select>
                                            <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_carikompetensiimportx" name="btn_carikompetensiimportx">
                                                <i class="bi bi-search" style="font-size: 16px;"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                            <div class="d-flex gap-2">
                                {{-- <button type="button" id="btn_upload1" name="btn_upload1" class="btn btn-outline-primary">
                                    <i class="i bi-file-earmark-arrow-up me-1"></i> Upload
                                </button> --}}
                                <button type="button" id="btn_upload1" class="btn btn-outline-primary"><i class="i bi-file-earmark-arrow-up me-1"></i> Upload Data</button>
                            </div>
                        </div>
                           
                       
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalImport -->

        <!-- ModalPrint modal fade-->
        <div class="modal fade" id="ModalPrint" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-printer-fill" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Print Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">
                                
                                <div class="row mb-1 align-items-center">
                                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold px-0">
                                        NIS
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="nisprint"></span>
                                    </label>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold px-0">
                                        NISN
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="nisnprint"></span>
                                    </label>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold px-0">
                                        Nama Lengkap
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="namaprint"></span>
                                    </label>
                                </div>

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                            <div class="d-flex gap-2">
                                {{-- <button type="button" id="btn_upload1" name="btn_upload1" class="btn btn-outline-primary">
                                    <i class="i bi-file-earmark-arrow-up me-1"></i> Upload
                                </button> --}}
                                <button type="button" id="btn_printdatainduk1x" class="btn btn-outline-primary"><i class="i bi-printer-fill me-1"></i> Print Data</button>
                            </div>
                        </div>

                       
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalPrint -->

        <!-- ModalKirim modal fade-->
        <div class="modal fade" id="ModalKirim" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-database-up" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Kirim Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();" autocomplete="off">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">

                                <div class="row mb-1 align-items-center">
                                    <label for="tpkirimx" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        TP
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="tpkirimx" id="tpkirimx" maxlength="10" class="form-control" placeholder="TP" readonly>
                                    </div>
                                </div>

                                <div class="row mb-1 align-items-center">
                                    <label for="idkelaskirimx" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Kelas
                                    </label>
                                    <div class="col-sm-8">
                                        <select name="idkelaskirimx" id="idkelaskirimx" class="form-select">
                                            <option value="" selected disabled>-- Pilih Kelas --</option>
                                            {{-- Option akan di-render via JS atau @foreach Blade --}}
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-1 align-items-center">
                                    <label for="keterangankirimx" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Keterangan
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="keterangankirimx" id="keterangankirimx" maxlength="50" class="form-control" placeholder="keterangan">
                                    </div>
                                </div>

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                            <div class="d-flex gap-2">
                                {{-- <button type="button" id="btn_upload1" name="btn_upload1" class="btn btn-outline-primary">
                                    <i class="i bi-file-earmark-arrow-up me-1"></i> Upload
                                </button> --}}
                                <button type="button" id="btn_kirim1" class="btn btn-outline-primary"><i class="i bi-file-earmark-arrow-up me-1"></i> Kirim Data</button>
                            </div>
                        </div>
                           
                       
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalKirim -->

        <!-- ModalCarikompetensi modal fade-->
        <div class="modal fade" id="ModalCarikompetensi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-search" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Cari Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1">
                                <div id="reloadCarikompetensi" class="table-responsive">
                                    <table id="carikompetensi1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:20px">Kode</th>							
                                                <th style="width:20px">Kode2</th>							
                                                <th style="width:200px">Kompetensi Keahlian</th>
                                                <th style="width:200px">Program Keeahlian</th>							
                                                <th style="width:200px">Bidang Keahlian</th>							
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footercarikompetensi1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_carikompetensi1">
                                            <!-- Data body via JS -->
                                        </tbody>
                                    </table>				
                                </div>


                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                           
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalCarikompetensi -->

        <!-- ModalCarikabupaten modal fade-->
        <div class="modal fade" id="ModalCarikabupaten" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-search" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Cari Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1">
                                <div id="reloadcarikabupaten" class="table-responsive">
                                    <table id="carikabupaten1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:30px">Kode</th>							
                                                <th style="width:150px">Kabupaten</th>
                                                <th style="width:150px">Propinsi</th>							
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footercarikabupaten1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_carikabupaten1">
                                            <!-- Data body via JS -->
                                        </tbody>
                                    </table>				
                                </div>

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                           
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalCarikabupaten -->

        <!-- ModalCaridesa modal fade-->
        <div class="modal fade" id="ModalCaridesa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-search" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Cari Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1">
                                <div id="reloadcaridesa" class="table-responsive">
                                    <table id="caridesa1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:30px">Kode</th>							
                                                <th style="width:150px">Desa</th>
                                                <th style="width:150px">Kecamatan</th>
                                                <th style="width:150px">Kabupaten</th>
                                                <th style="width:150px">Propinsi</th>							
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footercaridesa1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_caridesa1">
                                            <!-- Data body via JS -->
                                        </tbody>
                                    </table>				
                                </div>

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                           
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalCaridesa -->

        <!-- ModalBeasiswa modal fade-->
        <div class="modal fade" id="ModalBeasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-mortarboard" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Beasiswa</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1">
                                
                                <div class="row mb-0 mt-0 align-items-center" >
                                    <label class="col-sm-2 text-sm-end fw-semibold px-0">
                                        Nama
                                    </label>
                                    <label class="col-sm-1 text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-9 text-sm-start fw-semibold px-0">
                                        <span id="namabeasiswa"></span>
                                    </label>
                                </div>
                                <div class="row mb-0 mt-0 align-items-center" >
                                    <label class="col-sm-2 text-sm-end fw-semibold px-0">
                                        NIS
                                    </label>
                                    <label class="col-sm-1 text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-9 text-sm-start fw-semibold px-0">
                                        <span id="nisbeasiswa"></span>
                                    </label>
                                </div>
                                <div class="row mb-2 mt-0 align-items-center" >
                                    <label class="col-sm-2 text-sm-end fw-semibold px-0">
                                        NISN
                                    </label>
                                    <label class="col-sm-1 text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-9 text-sm-start fw-semibold px-0">
                                        <span id="nisnbeasiswa"></span>
                                    </label>
                                </div>

                                <div id="reloadBeasiswa" class="table-responsive">
                                    <table id="beasiswa1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:20px">TP</th>							
                                                <th style="width:20px">Kelas</th>							
                                                <th style="width:200px">Beasiswa</th>
                                                <th style="width:200px">Dari</th>							
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footerbeasiswa1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_beasiswa1">
                                            <!-- Data body via JS -->
                                        </tbody>
                                    </table>				
                                </div>


                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        <div class="modal-footer bg-light justify-content-between mt-0">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                                <i class="bi bi-x-circle me-1"></i> Tutup
                            </button>
                           
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalBeasiswa -->

    </div>

   
    <!-- khusus menyimpan data yang akan didestroy -->

    <input name="memkompetensi3" id="memkompetensi3"type="hidden">	
    <input name="memtempatlahir3" id="memtempatlahir3"type="hidden">	
    <input name="memdesa3" id="memdesa3"type="hidden">	

    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	

</div>

<script type="text/javascript">
    let identitas1Datatable;
    let datadiri1Datatable;
    let tempattinggal1Datatable;
    let kesehatan1Datatable;
    let pendidikan1Datatable;
    let ayahkandung1Datatable;
    let ibukandung1Datatable;
    let wali1Datatable;
    let hobi1Datatable;
    let perkembangan1Datatable;
    let selesai1Datatable;
    let images1Datatable;
    let beasiswa1Datatable;
    
    document.addEventListener("DOMContentLoaded", function() {
        
        function formatRupiah(angka, prefix,desimal){
			angka1=parseFloat(angka);			
			angka2=angka1.toFixed(10);
		    angka3=angka2.substr(0,(angka2.length)-11);			
			var number_string = angka3.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
		 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
					jmldesimal=parseFloat(desimal);					
					//a1 = parseFloat(angka);
					a1 = parseFloat(angka1);
					b1 = a1.toFixed(0);					
					b2 = a1.toFixed(parseFloat(jmldesimal));					
					pos1 = b2.indexOf(".");
					pos2 = b2.indexOf(",");					
					if (parseFloat(pos1)<0){
						pos1=0;
					}
					if (parseFloat(pos2)<0){
						pos2=0;
					}
					pos = parseFloat(pos1)+ parseFloat(pos2)+parseFloat(1);
					
					koma = ','+b2.substr(parseFloat(pos),parseFloat(jmldesimal));
					
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah + koma;
			return prefix == undefined ? rupiah : (rupiah ? ' ' + rupiah : '');
		}
		
		function formatAngka(angka, prefix){
			angka1=parseFloat(angka);			
			angka2=angka1.toFixed(10);
		    angka3=angka2.substr(0,(angka2.length)-11);			
			var number_string = angka3.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
		 
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
						
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
		}
		
		function cek_angka(angka){	
			var x='';
			var validasiAngka = /^[0-9]+$/;
			//cek validasi
			if(angka.match(validasiAngka)){
				x=parseFloat(angka);
			}else{
				x=parseFloat(1);
			}
			return x;			
        }

    function tgl_sekarang(){
        var x = new Date();
        var tgl = x.getDate();
        if(tgl<10){
            tgl='0'+tgl;
        }
        var bln = x.getMonth()+1;
        if(bln<10){
            bln='0'+bln;
        }
        var thn = x.getFullYear();

			return thn+'-'+bln+'-'+tgl;

	}
    
    

    //persiapan button dan modal
        const ModalAdd = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalAdd'));
        const ModalImport = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalImport'));
        const ModalPrint = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalPrint'));
        const ModalKirim = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalKirim'));
        const ModalCarikompetensi = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCarikompetensi'));
        const ModalBeasiswa = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalBeasiswa'));
        const ModalCarikabupaten = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCarikabupaten'));
        const ModalCaridesa = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCaridesa'));

        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        const btn_importexcel1x = document.getElementById('btn_importexcel1x');
        const btn_kirim1x = document.getElementById('btn_kirim1x');
        const btn_kirim1 = document.getElementById('btn_kirim1');
        const btn_printdatainduk1x = document.getElementById('btn_printdatainduk1x');
        const btn_download1 = document.getElementById('btn_download1');
        const btn_beasiswa1 = document.getElementById('btn_beasiswa1');
    
        const btn_carikompetensi1 = document.getElementById('btn_carikompetensi1');
        const btn_caritempatlahir1 = document.getElementById('btn_caritempatlahir1');
        const btn_caritempatlahirayah1 = document.getElementById('btn_caritempatlahirayah1');
        const btn_caritempatlahiribu1 = document.getElementById('btn_caritempatlahiribu1');
        const btn_caritempatlahirwali1 = document.getElementById('btn_caritempatlahirwali1');
        const btn_caridesa1 = document.getElementById('btn_caridesa1');
        const btn_caridesaayah1 = document.getElementById('btn_caridesaayah1');
        const btn_caridesaibu1 = document.getElementById('btn_caridesaibu1');
        const btn_caridesawali1 = document.getElementById('btn_caridesawali1');
        const aktif1xy = document.getElementById('aktif1xy');
        const aktif1xn = document.getElementById('aktif1xn');
        const hidupayah1xy = document.getElementById('hidupayah1xy');
        const hidupayah1xn = document.getElementById('hidupayah1xn');
        const hidupibu1xy = document.getElementById('hidupibu1xy');
        const hidupibu1xn = document.getElementById('hidupibu1xn');
        const hidupwali1xy = document.getElementById('hidupwali1xy');
        const hidupwali1xn = document.getElementById('hidupwali1xn');
        const tglditerimaimportx = document.getElementById('tglditerimaimportx');
        const idkompetensiimportx = document.getElementById('idkompetensiimportx');
        const btn_upload1 = document.getElementById('btn_upload1');        
        const idkelaskirimx = document.getElementById('idkelaskirimx');        
        
        //identitas1
        const cek1 = document.getElementById('cek1');
        const idtpmasuk1 = document.getElementById('idtpx1');
        const id1 = document.getElementById('id1');
        const namalengkap1 = document.getElementById('namalengkap1');
        const nis1 = document.getElementById('nis1');
        const nisn1 = document.getElementById('nisn1');
        const ecard1 = document.getElementById('ecard1');
        const tglditerima1 = document.getElementById('tglditerima1');
        const idstatussiswa1 = document.getElementById('idstatussiswa1');
        const idkompetensi1 = document.getElementById('idkompetensi1');
        //datadiri1
        const namapanggilan1 = document.getElementById('namapanggilan1');
        const idtempatlahir1 = document.getElementById('idtempatlahir1');
        const tgllahir1 = document.getElementById('tgllahir1');
        const idjk1 = document.getElementById('idjk1');
        const idagama1 = document.getElementById('idagama1');
        const warganegara1 = document.getElementById('warganegara1');
        const bahasa1 = document.getElementById('bahasa1');
        const idstatusanak1 = document.getElementById('idstatusanak1');
        const anakke1 = document.getElementById('anakke1');
        const jmlsdrkandung1 = document.getElementById('jmlsdrkandung1');
        const jmlsdrtiri1 = document.getElementById('jmlsdrtiri1');
        const jmlsdrangkat1 = document.getElementById('jmlsdrangkat1');
        //tempattinggal1
        const alamat1 = document.getElementById('alamat1');
        const iddesa1 = document.getElementById('iddesa1');
        const telp1 = document.getElementById('telp1');
        const email1 = document.getElementById('email1');
        const jarakkesekolah1 = document.getElementById('jarakkesekolah1');
        const idtinggal1 = document.getElementById('idtinggal1');
        //kesehatan1
        const penyakit1 = document.getElementById('penyakit1');
        const kelainan1 = document.getElementById('kelainan1');
        const idgd1 = document.getElementById('idgd1');
        const tinggibadan1 = document.getElementById('tinggibadan1');
        const beratbadan1 = document.getElementById('beratbadan1');
        //pendidikan1
        const asalsekolah1 = document.getElementById('asalsekolah1');
        const tglsttb1 = document.getElementById('tglsttb1');
        const nomorsttb1 = document.getElementById('nomorsttb1');
        const tglskhun1 = document.getElementById('tglskhun1');
        const nomorskhun1 = document.getElementById('nomorskhun1');
        const lamabelajar1 = document.getElementById('lamabelajar1');
        const pindah1 = document.getElementById('pindah1');
        const sekolahpindah1 = document.getElementById('sekolahpindah1');
        const alasanpindah1 = document.getElementById('alasanpindah1');
        //ayahkandung1
        const namaayah1 = document.getElementById('namaayah1');
        const idtempatlahirayah1 = document.getElementById('idtempatlahirayah1');
        const tgllahirayah1 = document.getElementById('tgllahirayah1');
        const umurayah1 = document.getElementById('umurayah1');
        const idagamaayah1 = document.getElementById('idagamaayah1');
        const idpendidikanayah1 = document.getElementById('idpendidikanayah1');
        const warganegaraayah1 = document.getElementById('warganegaraayah1');
        const pekerjaanayah1 = document.getElementById('pekerjaanayah1');
        const penghasilanayah1 = document.getElementById('penghasilanayah1');
        const pengeluaranayah1 = document.getElementById('pengeluaranayah1');
        const alamatayah1 = document.getElementById('alamatayah1');
        const iddesaayah1 = document.getElementById('iddesaayah1');
        const telpayah1 = document.getElementById('telpayah1');
        const hidupayah1 = document.getElementById('hidupayah1');
        const tglmeninggalayah1 = document.getElementById('tglmeninggalayah1');
        //ibukandung1
        const namaibu1 = document.getElementById('namaibu1');
        const idtempatlahiribu1 = document.getElementById('idtempatlahiribu1');
        const tgllahiribu1 = document.getElementById('tgllahiribu1');
        const umuribu1 = document.getElementById('umuribu1');
        const idagamaibu1 = document.getElementById('idagamaibu1');
        const idpendidikanibu1 = document.getElementById('idpendidikanibu1');
        const warganegaraibu1 = document.getElementById('warganegaraibu1');
        const pekerjaanibu1 = document.getElementById('pekerjaanibu1');
        const penghasilanibu1 = document.getElementById('penghasilanibu1');
        const pengeluaranibu1 = document.getElementById('pengeluaranibu1');
        const alamatibu1 = document.getElementById('alamatibu1');
        const iddesaibu1 = document.getElementById('iddesaibu1');
        const telpibu1 = document.getElementById('telpibu1');
        const hidupibu1 = document.getElementById('hidupibu1');
        const tglmeninggalibu1 = document.getElementById('tglmeninggalibu1');
        //wali1
        const namawali1 = document.getElementById('namawali1');
        const idtempatlahirwali1 = document.getElementById('idtempatlahirwali1');
        const tgllahirwali1 = document.getElementById('tgllahirwali1');
        const umurwali1 = document.getElementById('umurwali1');
        const idagamawali1 = document.getElementById('idagamawali1');
        const idpendidikanwali1 = document.getElementById('idpendidikanwali1');
        const warganegarawali1 = document.getElementById('warganegarawali1');
        const pekerjaanwali1 = document.getElementById('pekerjaanwali1');
        const penghasilanwali1 = document.getElementById('penghasilanwali1');
        const pengeluaranwali1 = document.getElementById('pengeluaranwali1');
        const alamatwali1 = document.getElementById('alamatwali1');
        const iddesawali1 = document.getElementById('iddesawali1');
        const telpwali1 = document.getElementById('telpwali1');
        const hidupwali1 = document.getElementById('hidupwali1');
        const tglmeninggalwali1 = document.getElementById('tglmeninggalwali1');
        //hobi1
        const hobikesenian1 = document.getElementById('hobikesenian1');
        const hobiolahraga1 = document.getElementById('hobiolahraga1');
        const hobiorganisasi1 = document.getElementById('hobiorganisasi1');
        const hobilain1 = document.getElementById('hobilain1');
        //perkembangan1
        const idtpkeluar1 = document.getElementById('idtpkeluar1');
        const tglkeluar1 = document.getElementById('tglkeluar1');
        const idalasankeluar1 = document.getElementById('idalasankeluar1');
        const nomorijasahlulus1 = document.getElementById('nomorijasahlulus1');
        const tglijasahlulus1 = document.getElementById('tglijasahlulus1');
        const nomorskhunlulus1 = document.getElementById('nomorskhunlulus1');
        const tglskhunlulus1 = document.getElementById('tglskhunlulus1');
        const keteranganlulus1 = document.getElementById('keteranganlulus1');
        const aktif1 = document.getElementById('aktif1');
        //selesai1
        const idalasansetelahkeluar1 = document.getElementById('idalasansetelahkeluar1');
        const sekolahlanjut1 = document.getElementById('sekolahlanjut1');
        const jurusanlanjut1 = document.getElementById('jurusanlanjut1');
        const kerjadi1 = document.getElementById('kerjadi1');
        const tglmulaikerja1 = document.getElementById('tglmulaikerja1');
        const namaperusahaan1 = document.getElementById('namaperusahaan1');
        const penghasilankerja1 = document.getElementById('penghasilankerja1');
        //images1
        const inputfotoawal1 = document.getElementById('fotoawal1');
        const inputfotoakhir1 = document.getElementById('fotoakhir1');
        const inputfotoktp1 = document.getElementById('fotoktp1');
        const gambarfotoawal1 = document.getElementById('gambarfotoawal1');
        const gambarfotoakhir1 = document.getElementById('gambarfotoakhir1');
        const gambarfotoktp1 = document.getElementById('gambarfotoktp1');

        //preview fotoawal1
        inputfotoawal1.addEventListener('change', function(){
            var gbrx="<img class='img-previewfotoawal1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoawal1' name='img-previewfotoawal1' style='width: 100%;'>";
            gambarfotoawal1.innerHTML=gbrx;
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-previewfotoawal1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        //preview fotoakhir1
        inputfotoakhir1.addEventListener('change', function(){
            var gbrx="<img class='img-previewfotoakhir1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoakhir1' name='img-previewfotoakhir1' style='width: 100%;'>";
            gambarfotoakhir1.innerHTML=gbrx;
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-previewfotoakhir1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
        //preview fotoktp1
        inputfotoktp1.addEventListener('change', function(){
            var gbrx="<img class='img-previewfotoktp1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoktp1' name='img-previewfotoktp1' style='width: 100%;'>";
            gambarfotoktp1.innerHTML=gbrx;
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-previewfotoktp1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        function btn_baru_click(){
            id1.value = '0';
            cek1.value = '0';
            bodyx.disabled = false;
            btn_simpan.style.display = 'block';
            btn_baru.style.display = 'none';
            warnax.classList.add('bg-primary');
            warnax.classList.remove('bg-success');
            iconx.classList.add('bi-plus-square');
            iconx.classList.remove('bi-pencil-square');
            judulx.innerHTML = 'Tambah Data';
            inputfotoawal1.value = '';
            const gbrx="<h5 class='mt-2 small' align='center'>Belum ada image yang diupload<h5>";                        
            gambarfotoawal1.innerHTML=gbrx;

            inputfotoakhir1.value = '';
            gambarfotoakhir1.innerHTML=gbrx;

            inputfotoktp1.value = '';
            gambarfotoktp1.innerHTML=gbrx;
        }
        
        function btn_simpan_click(){      
            bodyx.disabled = true;
            btn_simpan.style.display = 'none';
            btn_baru.style.display = 'block';
        }

        function btn_edit1_click(){      
            bodyx.disabled = false;
            warnax.classList.remove('bg-primary');
            warnax.classList.add('bg-success');
            iconx.classList.remove('bi-plus-square');
            iconx.classList.add('bi-pencil-square');
            judulx.innerHTML = 'Edit Data';
            btn_simpan.style.display = 'block';
            btn_baru.style.display = 'none';
        }

        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
            });
        });
        $('#ModalCarikompetensi').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalBeasiswa').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalCarikabupaten').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalCaridesa').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalImport').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalPrint').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalKirim').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
       
        //aktif
        aktif1xy.addEventListener('change', function(){
           aktif1.value = 'Y'; 
        })
        aktif1xn.addEventListener('change', function(){
           aktif1.value = 'N'; 
        })
        
        //hidupayah
        hidupayah1xy.addEventListener('change', function(){
           hidupayah1.value = 'Y'; 
        })
        hidupayah1xn.addEventListener('change', function(){
           hidupayah1.value = 'N'; 
        })

        //hidupibu
        hidupibu1xy.addEventListener('change', function(){
           hidupibu1.value = 'Y'; 
        })
        hidupibu1xn.addEventListener('change', function(){
           hidupibu1.value = 'N'; 
        })

        //hidupwali
        hidupwali1xy.addEventListener('change', function(){
           hidupwali1.value = 'Y'; 
        })
        hidupwali1xn.addEventListener('change', function(){
           hidupwali1.value = 'N'; 
        })

        const tglditerimaimportxx = new Datepicker(tglditerimaimportx, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tglditerimax = new Datepicker(tglditerima1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tgllahirx = new Datepicker(tgllahir1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tgllahirayahx = new Datepicker(tgllahirayah1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tgllahiribux = new Datepicker(tgllahiribu1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tgllahirwalix = new Datepicker(tgllahirwali1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tglmeninggalayahx = new Datepicker(tglmeninggalayah1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tglmeninggalibux = new Datepicker(tglmeninggalibu1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tglmeninggalwalix = new Datepicker(tglmeninggalwali1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tglsttbx = new Datepicker(tglsttb1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tglskhunx = new Datepicker(tglskhun1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tglijasahlulusx = new Datepicker(tglijasahlulus1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tglskhunlulusx = new Datepicker(tglskhunlulus1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tglkeluarx = new Datepicker(tglkeluar1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        
        const tglmulaikerjax = new Datepicker(tglmulaikerja1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        //pembuat 0 untuk penghasilan blank
        document.getElementById('ModalAdd').addEventListener('mousemove', function () {
             
            if (document.getElementById('penghasilanayah1').value==''){
                document.getElementById('penghasilanayah1').value = '0';
            }           
            if (document.getElementById('pengeluaranayah1').value==''){
                document.getElementById('pengeluaranayah1').value = '0';
            }           
            if (document.getElementById('penghasilanibu1').value==''){
                document.getElementById('penghasilanibu1').value = '0';
            }           
            if (document.getElementById('pengeluaranibu1').value==''){
                document.getElementById('pengeluaranibu1').value = '0';
            }           
            if (document.getElementById('penghasilanwali1').value==''){
                document.getElementById('penghasilanwali1').value = '0';
            }           
            if (document.getElementById('pengeluaranwali1').value==''){
                document.getElementById('pengeluaranwali1').value = '0';
            }           
            if (document.getElementById('penghasilankerja1').value==''){
                document.getElementById('penghasilankerja1').value = '0';
            }           
            if (document.getElementById('anakke1').value==''){
                document.getElementById('anakke1').value = '1';
            }           
            if (document.getElementById('jmlsdrkandung1').value==''){
                document.getElementById('jmlsdrkandung1').value = '0';
            }           
            if (document.getElementById('jmlsdrtiri1').value==''){
                document.getElementById('jmlsdrtiri1').value = '0';
            }           
            if (document.getElementById('jmlsdrangkat1').value==''){
                document.getElementById('jmlsdrangkat1').value = '0';
            }           
            if (document.getElementById('jarakkesekolah1').value==''){
                document.getElementById('jarakkesekolah1').value = '0';
            }           
            if (document.getElementById('tinggibadan1').value==''){
                document.getElementById('tinggibadan1').value = '0';
            }           
            if (document.getElementById('beratbadan1').value==''){
                document.getElementById('beratbadan1').value = '0';
            }           
            if (document.getElementById('lamabelajar1').value==''){
                document.getElementById('lamabelajar1').value = '0';
            }           
            if (document.getElementById('umurayah1').value==''){
                document.getElementById('umurayah1').value = '0';
            }           
            if (document.getElementById('umuribu1').value==''){
                document.getElementById('umuribu1').value = '0';
            }           
            if (document.getElementById('umurwali1').value==''){
                document.getElementById('umurwali1').value = '0';
            }           
                     
        });

        btn_baru.addEventListener('click', function () {
            btn_baru_click();            
        });
       
        btn_tambah1.addEventListener('click', function () {
            btn_baru_click();            
            ecard1.value = '';        
            nis1.value = '';        
            nisn1.value = '';        
            namalengkap1.value = '';        
            ModalAdd.show(); 
        });
        
         btn_beasiswa1.addEventListener('click', function () {
            document.getElementById('namabeasiswa').innerText = namalengkap1.value;
            document.getElementById('nisbeasiswa').innerText = nis1.value;
            document.getElementById('nisnbeasiswa').innerText = nisn1.value;
            const idx = id1.value;
            if(idx>'0'){
                ModalBeasiswa.show();
                kirim_iddatasiswa();            
            }
        });
        
        function kirim_iddatasiswa() {
            const id1 = document.getElementById('id1').value;
            let formData = new FormData();
            
            formData.append('id1', id1);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('sips01.master.datasiswa_kirimiddatasiswa') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                    // Catatan: Jangan menambahkan 'Content-Type': 'multipart/form-data' secara manual di sini.
                    // Browser akan otomatis mengaturnya lengkap dengan boundary yang benar karena kita menggunakan FormData.
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan pada server.');
                }
                return response.text(); // Mengubah respon menjadi text/JSON jika backend mengirimkan balasan
            })
            .then(data => {
                // Panggil fungsi refresh table jika sukses
                // setTimeout(() => {
                //     tampil_beasiswa1(); 
                // }, 1000);

                setTimeout(() => {
                    tampil_beasiswa1();
                    setTimeout(() => {
                        tampil_beasiswa1().ajax.url('{{route('sips01.master.datasiswa_showbeasiswa')}}').load();                
                        tampil_beasiswa1().draw(null, false); 
                    }, 100);
                }, 100);

                
            })
            .catch(error => {
                console.error('Error:', error);
                // Anda bisa menambahkan penanganan error di sini jika diperlukan
            });
        }

        function tampil_beasiswa1(){
            let i = 1;
            return $('#beasiswa1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                // `{{ url('/sips01/master/datasiswaedit') }}/${id1}`;
                ajax: `{{ route('sips01.master.datasiswa_showbeasiswa') }}`,
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'tp.tp', name: 'tp.tp', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true },
                    { data: 'beasiswa', name: 'beasiswa', orderable: true, searchable: true },
                    { data: 'dari', name: 'dari', orderable: true, searchable: true },
                ]
            });
        }

        btn_kirim1x.addEventListener('click', function () {
            const tp = idtpx1.options[idtpx1.selectedIndex].text;
            document.getElementById('tpkirimx').value = tp;
            ModalKirim.show(); 
        });

        btn_kirim1.addEventListener('click', function () {
            modal_kirim() 
        });
        function modal_kirim(){
            var kelas = idkelaskirimx.options[idkelaskirimx.selectedIndex].text;
            Swal.fire({
            title: 'Are you sure send?',
            text: 'to '+kelas,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, send !",
            cancelButtonText: "No, cancel !",
            }).then((result) => {
                if (result.isConfirmed) {
                    data_kirim();            
                }
            })
        }

        function data_kirim(){            
            const idtp1 = document.getElementById('idtpx1').value;
            const idkelas1 = document.getElementById('idkelaskirimx').value;
            const keterangan1 = document.getElementById('keterangankirimx').value;
            const kelas = idkelaskirimx.options[idkelaskirimx.selectedIndex].text;
            
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('keterangan1', keterangan1);
                
                fetch("{{ route('sips01.master.datasiswa_kirim') }}", {
                    method: 'POST',
                    body: formData, // Otomatis mengatur enctype 'multipart/form-data' dan processData: false
                    headers: {
                        // Mengambil token CSRF langsung dari tag meta tanpa jQuery
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        // Jika status HTTP bukan 200-299, lempar ke blok catch (error)
                        throw new Error('Jaringan bermasalah atau server error');
                    }
                    return response.json(); // Atau .text() jika backend Anda tidak mengembalikan JSON
                })
                .then(data => {
                    // === BLOK SUCCESS ===
                    ModalKirim.hide(); 
                    tampil_dataTable();
                    swalsukseskirim(kelas);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagalkirim(kelas);
                });    
        }

        
        
        setTimeout(() => {
            identitas1Datatable = tampil_identitas1();    
        }, 1000);
        function tampil_identitas1(){
            let i = 1;
            return $('#identitas1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'tpmasuk', name: 'tpmasuk', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'tglditerima', name: 'tglditerima', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'statussiswa', name: 'statussiswa.statussiswa', orderable: false, searchable: false },
                    { data: 'kompetensi', name: 'kompetensi', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            datadiri1Datatable = tampil_datadiri1();    
        }, 1000);
        function tampil_datadiri1(){
            let i = 1;
            return $('#datadiri1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'namapanggilan', name: 'namapanggilan', orderable: true, searchable: true },
                    { data: 'tempatlahir', name: 'tempatlahir.kabupaten', orderable: false, searchable: false },
                    { data: 'jk', name: 'jk.jk', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'agama', name: 'agama.agama', orderable: false, searchable: false },
                    { data: 'warganegara', name: 'warganegara', orderable: false, searchable: false },
                    { data: 'bahasa', name: 'bahasa', orderable: false, searchable: false },
                    { data: 'statusanak', name: 'statusanak.statusanak', orderable: false, searchable: false },
                    { data: 'anakke', name: 'anakke', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'jmlsdr', name: 'jmlsdr', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            tempattinggal1Datatable = tampil_tempattinggal1();    
        }, 1000);
        function tampil_tempattinggal1(){
            let i = 1;
            return $('#tempattinggal1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },

                    { data: 'alamat', name: 'alamat', orderable: false, searchable: false },
                    { data: 'desa', name: 'desa', orderable: false, searchable: false },
                    { data: 'telp', name: 'telp', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'email', name: 'email', orderable: false, searchable: false },
                    { data: 'jarakkesekolah', name: 'jarakkesekolah', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'tinggal', name: 'tinggal', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            kesehatan1Datatable = tampil_kesehatan1();    
        }, 1000);
        function tampil_kesehatan1(){
            let i = 1;
            return $('#kesehatan1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'penyakit', name: 'penyakit', orderable: false, searchable: false },
                    { data: 'kelainan', name: 'kelainan', orderable: false, searchable: false },
                    { data: 'gd', name: 'gd', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'tinggibadan', name: 'tinggibadan', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'beratbadan', name: 'beratbadan', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            pendidikan1Datatable = tampil_pendidikan1();    
        }, 1000);
        function tampil_pendidikan1(){
            let i = 1;
            return $('#pendidikan1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'asalsekolah', name: 'asalsekolah', orderable: false, searchable: false },
                    { data: 'tglsttb', name: 'tglsttb', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'nomorsttb', name: 'nomorsttb', orderable: false, searchable: false },
                    { data: 'tglskhun', name: 'tglskhun', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'nomorskhun', name: 'nomorskhun', orderable: false, searchable: false },
                    { data: 'lamabelajar', name: 'lamabelajar', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'pindah', name: 'pindah', orderable: false, searchable: false },
                    { data: 'sekolahpindah', name: 'sekolahpindah', orderable: false, searchable: false },
                    { data: 'alasanpindah', name: 'alasanpindah', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }
        
        setTimeout(() => {
            ayahkandung1Datatable = tampil_ayahkandung1();    
        }, 1000);
        function tampil_ayahkandung1(){
            let i = 1;
            return $('#ayahkandung1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'namaayah', name: 'namaayah', orderable: false, searchable: false },
                    { data: 'tempatlahirayah', name: 'tempatlahirayah', orderable: false, searchable: false },
                    { data: 'pekerjaanayah', name: 'pekerjaanayah', orderable: false, searchable: false },
                    { data: 'alamatayah', name: 'alamatayah', orderable: false, searchable: false },
                    { data: 'desaayah', name: 'desaayah', orderable: false, searchable: false },
                    { data: 'telpayah', name: 'telpayah', orderable: false, searchable: false },
                    { data: 'hidupayah', name: 'hidupayah', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            ibukandung1Datatable = tampil_ibukandung1();    
        }, 1000);
        function tampil_ibukandung1(){
            let i = 1;
            return $('#ibukandung1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'namaibu', name: 'namaibu', orderable: false, searchable: false },
                    { data: 'tempatlahiribu', name: 'tempatlahiribu', orderable: false, searchable: false },
                    { data: 'pekerjaanibu', name: 'pekerjaanibu', orderable: false, searchable: false },
                    { data: 'alamatibu', name: 'alamatibu', orderable: false, searchable: false },
                    { data: 'desaibu', name: 'desaibu', orderable: false, searchable: false },
                    { data: 'telpibu', name: 'telpibu', orderable: false, searchable: false },
                    { data: 'hidupibu', name: 'hidupibu', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            wali1Datatable = tampil_wali1();    
        }, 1000);
        function tampil_wali1(){
            let i = 1;
            return $('#wali1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'namawali', name: 'namawali', orderable: false, searchable: false },
                    { data: 'tempatlahirwali', name: 'tempatlahirwali', orderable: false, searchable: false },
                    { data: 'pekerjaanwali', name: 'pekerjaanwali', orderable: false, searchable: false },
                    { data: 'alamatwali', name: 'alamatwali', orderable: false, searchable: false },
                    { data: 'desawali', name: 'desawali', orderable: false, searchable: false },
                    { data: 'telpwali', name: 'telpibu', orderable: false, searchable: false },
                    { data: 'hidupwali', name: 'hidupwali', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }
        
        setTimeout(() => {
            hobi1Datatable = tampil_hobi1();    
        }, 1000);
        function tampil_hobi1(){
            let i = 1;
            return $('#hobi1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },

                    { data: 'hobikesenian', name: 'hobikesenian', orderable: false, searchable: false },
                    { data: 'hobiolahraga', name: 'hobiolahraga', orderable: false, searchable: false },
                    { data: 'hobiorganisasi', name: 'hobiorganisasi', orderable: false, searchable: false },
                    { data: 'hobilain', name: 'hobilain', orderable: false, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }
        
        setTimeout(() => {
            perkembangan1Datatable = tampil_perkembangan1();    
        }, 1000);
        function tampil_perkembangan1(){
            let i = 1;
           
            return new DataTable('#perkembangan1', {
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                
                // Konfigurasi AJAX versi Vanilla JS bawaan DataTables
                ajax: {
                    url: "{{ route('sips01.master.datasiswa_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },

                    { data: 'beasiswa', name: 'beasiswa', orderable: false, searchable: false, className: 'dt-center' }, 
                    { data: 'tpkeluar', name: 'tpkeluar', orderable: false, searchable: false },
                    { data: 'tglkeluar', name: 'tglkeluar', orderable: false, searchable: false },
                    { data: 'alasankeluar', name: 'alasankeluar', orderable: false, searchable: false },
                    { data: 'tglijasahlulus', name: 'tglijasahlulus', orderable: false, searchable: false },
                    { data: 'nomorijasahlulus', name: 'nomorijasahlulus', orderable: false, searchable: false },
                    { data: 'tglskhunlulus', name: 'tglskhunlulus', orderable: false, searchable: false },
                    { data: 'nomorskhunlulus', name: 'nomorskhunlulus', orderable: false, searchable: false },
                    { data: 'keteranganlulus', name: 'keteranganlulus', orderable: false, searchable: false },
                    { data: 'aktif', name: 'aktif', orderable: false, searchable: false, className: 'dt-center' },

                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            selesai1Datatable = tampil_selesai1();    
        }, 1000);
        function tampil_selesai1(){
            let i = 1;
            return $('#selesai1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'alasansetelahkeluar', name: 'alasansetelahkeluar', orderable: false, searchable: false },
                    { data: 'sekolahlanjut', name: 'sekolahlanjut', orderable: false, searchable: false },
                    { data: 'jurusanlanjut', name: 'jurusanlanjut', orderable: false, searchable: false },
                    { data: 'kerjadi', name: 'kerjadi', orderable: false, searchable: false },
                    { data: 'tglmulaikerja', name: 'tglmulaikerja', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'namaperusahaan', name: 'namaperusahaan', orderable: false, searchable: false },
                    { data: 'penghasilankerja', name: 'penghasilankerja', orderable: false, searchable: false },

                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        setTimeout(() => {
            images1Datatable = tampil_images1();    
        }, 1000);
        function tampil_images1(){
            let i = 1;
            return $('#images1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                buttons : [ 
                    {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                    {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                    {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                    {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                    {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                            "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                            "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nis', name: 'nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nisn', name: 'nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namalengkap', name: 'namalengkap', orderable: true, searchable: true },
                    { data: 'fotoawal', name: 'fotoawal', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'fotoakhir', name: 'fotoakhir', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'fotoktp', name: 'fotoktp', orderable: false, searchable: false, className: 'dt-right' },

                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }

                ],
                rowCallback: function(row, data, index) {
                    if (data?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }
        
        btn_carikompetensi1.addEventListener('click', function () {
            ModalCarikompetensi.show();
            document.getElementById('memkompetensi3').value = 'tambah';            
        });
        
        btn_carikompetensiimportx.addEventListener('click', function () {
            ModalCarikompetensi.show();
            document.getElementById('memkompetensi3').value = 'import';            
        });
        
        tampil_carikompetensi1()
        function tampil_carikompetensi1(){
            let i = 1;
            return $('#carikompetensi1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,                
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_showkompetensi') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'kode', name: 'kode', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kode2', name: 'kode2', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kompetensi', name: 'kompetensi', orderable: true, searchable: true },
                    { data: 'program', name: 'program.program', orderable: true, searchable: false },
                    { data: 'bidang', name: 'program.bidang.bidang', orderable: true, searchable: false },
                ]
            });
        }

        document.getElementById('show_carikompetensi1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikode');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                if(document.getElementById('memkompetensi3').value=='tambah'){
                    idkompetensi1.value = id1;
                }
                if(document.getElementById('memkompetensi3').value=='import'){
                    idkompetensiimportx.value = id1;
                }
                ModalCarikompetensi.hide();
            }
        });

        document.getElementById('show_carikompetensi1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikode2');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                if(document.getElementById('memkompetensi3').value=='tambah'){
                    idkompetensi1.value = id1;
                }
                if(document.getElementById('memkompetensi3').value=='import'){
                    idkompetensiimportx.value = id1;
                }
                ModalCarikompetensi.hide();
            }
        });

        document.getElementById('show_carikompetensi1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikompetensi');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                if(document.getElementById('memkompetensi3').value=='tambah'){
                    idkompetensi1.value = id1;
                }
                if(document.getElementById('memkompetensi3').value=='import'){
                    idkompetensiimportx.value = id1;
                }
                ModalCarikompetensi.hide();
            }
        });

        document.getElementById('show_carikompetensi1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_cariprogram');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                if(document.getElementById('memkompetensi3').value=='tambah'){
                    idkompetensi1.value = id1;
                }
                if(document.getElementById('memkompetensi3').value=='import'){
                    idkompetensiimportx.value = id1;
                }
                ModalCarikompetensi.hide();
            }
        });

        document.getElementById('show_carikompetensi1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_caribidang');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                if(document.getElementById('memkompetensi3').value=='tambah'){
                    idkompetensi1.value = id1;
                }
                if(document.getElementById('memkompetensi3').value=='import'){
                    idkompetensiimportx.value = id1;
                }
                ModalCarikompetensi.hide();
            }
        });

        btn_caritempatlahir1.addEventListener('click', function () {
            ModalCarikabupaten.show();
            document.getElementById('memtempatlahir3').value = 'sendiri';
        });
        btn_caritempatlahirayah1.addEventListener('click', function () {
            ModalCarikabupaten.show();
            document.getElementById('memtempatlahir3').value = 'ayah';
        });
        btn_caritempatlahiribu1.addEventListener('click', function () {
            ModalCarikabupaten.show();
            document.getElementById('memtempatlahir3').value = 'ibu';
        });
        btn_caritempatlahirwali1.addEventListener('click', function () {
            ModalCarikabupaten.show();
            document.getElementById('memtempatlahir3').value = 'wali';
        });

        tampil_carikabupaten1()
        function tampil_carikabupaten1(){
            let i = 1;
            return $('#carikabupaten1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_showkabupaten') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'kode', name: 'kode', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kabupaten', name: 'kabupaten', orderable: true, searchable: true },
                    { data: 'propinsi', name: 'propinsi', orderable: true, searchable: true },
                ]
            });
        }

        document.getElementById('show_carikabupaten1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikode');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var lahir1 = document.getElementById('memtempatlahir3').value;
                if(lahir1=='sendiri'){
                    idtempatlahir1.value = id1; 
                }
                if(lahir1=='ayah'){
                    idtempatlahirayah1.value = id1; 
                }
                if(lahir1=='ibu'){
                    idtempatlahiribu1.value = id1; 
                }
                if(lahir1=='wali'){
                    idtempatlahirwali1.value = id1; 
                }

                ModalCarikabupaten.hide();
            }
        });

        document.getElementById('show_carikabupaten1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikabupaten');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var lahir1 = document.getElementById('memtempatlahir3').value;
                if(lahir1=='sendiri'){
                    idtempatlahir1.value = id1; 
                }
                if(lahir1=='ayah'){
                    idtempatlahirayah1.value = id1; 
                }
                if(lahir1=='ibu'){
                    idtempatlahiribu1.value = id1; 
                }
                if(lahir1=='wali'){
                    idtempatlahirwali1.value = id1; 
                }

                ModalCarikabupaten.hide();
            }
        });

        document.getElementById('show_carikabupaten1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_caripropinsi');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var lahir1 = document.getElementById('memtempatlahir3').value;
                if(lahir1=='sendiri'){
                    idtempatlahir1.value = id1; 
                }
                if(lahir1=='ayah'){
                    idtempatlahirayah1.value = id1; 
                }
                if(lahir1=='ibu'){
                    idtempatlahiribu1.value = id1; 
                }
                if(lahir1=='wali'){
                    idtempatlahirwali1.value = id1; 
                }

                ModalCarikabupaten.hide();
            }
        });

        btn_caridesa1.addEventListener('click', function () {
            ModalCaridesa.show();
            document.getElementById('memdesa3').value = 'sendiri';
        });
        btn_caridesaayah1.addEventListener('click', function () {
            ModalCaridesa.show();
            document.getElementById('memdesa3').value = 'ayah';
        });
        btn_caridesaibu1.addEventListener('click', function () {
            ModalCaridesa.show();
            document.getElementById('memdesa3').value = 'ibu';
        });
        btn_caridesawali1.addEventListener('click', function () {
            ModalCaridesa.show();
            document.getElementById('memdesa3').value = 'wali';
        });

        tampil_caridesa1()
        function tampil_caridesa1(){
            let i = 1;
            return $('#caridesa1').DataTable({
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: "{{ route('sips01.master.datasiswa_showdesa') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'kode', name: 'kode', orderable: true, searchable: false, className: 'dt-center' },
                    { data: 'desa', name: 'desa', orderable: true, searchable: true },
                    { data: 'kecamatan', name: 'kecamatan.kecamatan', orderable: false, searchable: false },
                    { data: 'kabupaten', name: 'kecamatan.kabupaten.kabupaten', orderable: false, searchable: false },
                    { data: 'propinsi', name: 'kecamatan.kabupaten.propinsi.propinsi', orderable: false, searchable: false },
                ]
            });
        }
        
        document.getElementById('show_caridesa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikode');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var kode1 = targetButton.getAttribute('data2');
                var desa1 = targetButton.getAttribute('data3');
                var kecamatan1 = targetButton.getAttribute('data4');
                var kabupaten1 = targetButton.getAttribute('data5');
                var propinsi1 = targetButton.getAttribute('data6');
                var ket1 = document.getElementById('memdesa3').value;
                var html = '';

                html += '<option value="' + id1 + '">' + desa1 +' - ' + kecamatan1 + ' - ' + kabupaten1 +' - ' + propinsi1 + '</option>';
            
                if(ket1=='sendiri'){
                    document.getElementById("iddesa1").innerHTML = html;
                }
                if(ket1=='ayah'){
                    document.getElementById("iddesaayah1").innerHTML = html; 
                }
                if(ket1=='ibu'){
                    document.getElementById("iddesaibu1").innerHTML = html; 
                }
                if(ket1=='wali'){
                    document.getElementById("iddesawali1").innerHTML = html; 
                }
                
                ModalCaridesa.hide();
            }
        });

        document.getElementById('show_caridesa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_caridesa');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var kode1 = targetButton.getAttribute('data2');
                var desa1 = targetButton.getAttribute('data3');
                var kecamatan1 = targetButton.getAttribute('data4');
                var kabupaten1 = targetButton.getAttribute('data5');
                var propinsi1 = targetButton.getAttribute('data6');
                var ket1 = document.getElementById('memdesa3').value;
                var html = '';

                html += '<option value="' + id1 + '">' + desa1 +' - ' + kecamatan1 + ' - ' + kabupaten1 +' - ' + propinsi1 + '</option>';
            
                if(ket1=='sendiri'){
                    document.getElementById("iddesa1").innerHTML = html;
                }
                if(ket1=='ayah'){
                    document.getElementById("iddesaayah1").innerHTML = html; 
                }
                if(ket1=='ibu'){
                    document.getElementById("iddesaibu1").innerHTML = html; 
                }
                if(ket1=='wali'){
                    document.getElementById("iddesawali1").innerHTML = html; 
                }
                
                ModalCaridesa.hide();
            }
        });

        document.getElementById('show_caridesa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikecamatan');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var kode1 = targetButton.getAttribute('data2');
                var desa1 = targetButton.getAttribute('data3');
                var kecamatan1 = targetButton.getAttribute('data4');
                var kabupaten1 = targetButton.getAttribute('data5');
                var propinsi1 = targetButton.getAttribute('data6');
                var ket1 = document.getElementById('memdesa3').value;
                var html = '';

                html += '<option value="' + id1 + '">' + desa1 +' - ' + kecamatan1 + ' - ' + kabupaten1 +' - ' + propinsi1 + '</option>';
            
                if(ket1=='sendiri'){
                    document.getElementById("iddesa1").innerHTML = html;
                }
                if(ket1=='ayah'){
                    document.getElementById("iddesaayah1").innerHTML = html; 
                }
                if(ket1=='ibu'){
                    document.getElementById("iddesaibu1").innerHTML = html; 
                }
                if(ket1=='wali'){
                    document.getElementById("iddesawali1").innerHTML = html; 
                }
                
                ModalCaridesa.hide();
            }
        });

        document.getElementById('show_caridesa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikabupaten');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var kode1 = targetButton.getAttribute('data2');
                var desa1 = targetButton.getAttribute('data3');
                var kecamatan1 = targetButton.getAttribute('data4');
                var kabupaten1 = targetButton.getAttribute('data5');
                var propinsi1 = targetButton.getAttribute('data6');
                var ket1 = document.getElementById('memdesa3').value;
                var html = '';

                html += '<option value="' + id1 + '">' + desa1 +' - ' + kecamatan1 + ' - ' + kabupaten1 +' - ' + propinsi1 + '</option>';
            
                if(ket1=='sendiri'){
                    document.getElementById("iddesa1").innerHTML = html;
                }
                if(ket1=='ayah'){
                    document.getElementById("iddesaayah1").innerHTML = html; 
                }
                if(ket1=='ibu'){
                    document.getElementById("iddesaibu1").innerHTML = html; 
                }
                if(ket1=='wali'){
                    document.getElementById("iddesawali1").innerHTML = html; 
                }
                
                ModalCaridesa.hide();
            }
        });

        document.getElementById('show_caridesa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_caripropinsi');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var kode1 = targetButton.getAttribute('data2');
                var desa1 = targetButton.getAttribute('data3');
                var kecamatan1 = targetButton.getAttribute('data4');
                var kabupaten1 = targetButton.getAttribute('data5');
                var propinsi1 = targetButton.getAttribute('data6');
                var ket1 = document.getElementById('memdesa3').value;
                var html = '';

                html += '<option value="' + id1 + '">' + desa1 +' - ' + kecamatan1 + ' - ' + kabupaten1 +' - ' + propinsi1 + '</option>';
            
                if(ket1=='sendiri'){
                    document.getElementById("iddesa1").innerHTML = html;
                }
                if(ket1=='ayah'){
                    document.getElementById("iddesaayah1").innerHTML = html; 
                }
                if(ket1=='ibu'){
                    document.getElementById("iddesaibu1").innerHTML = html; 
                }
                if(ket1=='wali'){
                    document.getElementById("iddesawali1").innerHTML = html; 
                }
                
                ModalCaridesa.hide();
            }
        });


        setTimeout(() => {
            tampil_listtinggal();
        }, 1000);
        //menampilkan combo tinggal
        function tampil_listtinggal(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listtinggal')}}',
                
                success: function(data){				    
                    $("#idtinggal1").html(data);                
                }
            })                    
        }

        setTimeout(() => {
            tampil_listgd();
        }, 1000);
        //menampilkan combo gd
        function tampil_listgd(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listgd')}}',
                
                success: function(data){				    
                    $("#idgd1").html(data);                
                }
            })                    
        }

        //menampilkan combo tpx
        tampil_listtpx()
        function tampil_listtpx() {
            fetch('{{ route('sips01.master.datasiswa_listtpmasuk') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idtpx1) {
                    idtpx1.innerHTML = data;
                    idtpx1.value = '{{ $idtp }}';
                    idtpkeluar1.innerHTML = data;
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }

        //menampilkan combo tempatlahir
        tampil_listtempatlahir();
        function tampil_listtempatlahir(){
            fetch('{{ route('sips01.master.datasiswa_listtempatlahir') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idtempatlahir1) {
                    idtempatlahir1.innerHTML = data;
                }
                if (idtempatlahirayah1) {
                    idtempatlahirayah1.innerHTML = data;
                }
                if (idtempatlahiribu1) {
                    idtempatlahiribu1.innerHTML = data;
                }
                if (idtempatlahirwali1) {
                    idtempatlahirwali1.innerHTML = data;
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }

        //menampilkan combo desa
        // tampil_listdesa();
        // function tampil_listdesa(){
        //     fetch('{{ route('sips01.master.datasiswa_listdesa') }}', {
        //         method: 'GET'
        //     })
        //     .then(response => {
        //         if (!response.ok) {
        //             throw new Error('Gagal mengambil data');
        //         }
        //         return response.text(); 
        //     })
        //     .then(data => {
        //         if (iddesa1) {
        //             iddesa1.innerHTML = data;
        //         }
        //         if (iddesaayah1) {
        //             iddesaayah1.innerHTML = data;
        //         }
        //         if (iddesaibu1) {
        //             iddesaibu1.innerHTML = data;
        //         }
        //         if (iddesawali1) {
        //             iddesawali1.innerHTML = data;
        //         }
        //     })
        //     .catch(error => {
        //         console.error('Terjadi kesalahan:', error);
        //     });
        // }
       
        // function tampil_listdesa(){				
        //     $.ajax({
        //         type: 'get',
        //         url   : '{{route("sips01.master.datasiswa_listdesa")}}',
        //         dataType: 'html', // Memastikan format yang diterima adalah teks HTML
        //         success: function(data){				    
        //             // Mengisi semua elemen secara efisien dalam satu waktu
        //             if (data) {
        //                 $('#iddesa1, #iddesaayah1, #iddesaibu1, #iddesawali1').html(data);
        //             }
        //         },
        //         error: function(xhr, status, error) {
        //             console.error("Gagal memuat data desa:", error);
        //         }
        //     });                    
        // }

        setTimeout(() => {
        tampil_listdesa();
    }, 1000);
    //menampilkan combo desa
    function tampil_listdesa(){				
        $.ajax({
            type: 'get',
            url   : '{{route('sips01.master.datasiswa_listdesa')}}',
            
            success: function(data){
                // $("#iddesa1").html(data);                
                // $('#iddesa1').attr('disabled', '');  
                // $("#iddesaayah1").html(data);                
                // $("#iddesaibu1").html(data);                
                // $("#iddesawali1").html(data);                
            }
        })                    
    }
        tampil_liststatussiswa();
        //menampilkan combo statussiswa
        function tampil_liststatussiswa(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_liststatussiswa')}}',
                
                success: function(data){				    
                    $("#idstatussiswa1").html(data);                
                }
            })                    
        }

        tampil_liststatusanak();
        //menampilkan combo statusanak
        function tampil_liststatusanak(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_liststatusanak')}}',
                
                success: function(data){				    
                    $("#idstatusanak1").html(data);                
                }
            })                    
        }

        tampil_listpendidikan();
        //menampilkan combo pendidikan
        function tampil_listpendidikan(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listpendidikan')}}',
                
                success: function(data){				    
                    $("#idpendidikanayah1").html(data);                
                    $("#idpendidikanibu1").html(data);                
                    $("#idpendidikanwali1").html(data);                
                }
            })                    
        }
        tampil_listjk();
        //menampilkan combo jk
        function tampil_listjk(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listjk')}}',
                
                success: function(data){				    
                    $("#idjk1").html(data);                
                }
            })                    
        }

        tampil_listagama();
        //menampilkan combo agama
        function tampil_listagama(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listagama')}}',
                
                success: function(data){				    
                    $("#idagama1").html(data);
                    $("#idagamaayah1").html(data);                
                    $("#idagamaibu1").html(data);                
                    $("#idagamawali1").html(data);                
                }
            })                    
        }

        tampil_listkompetensi();
        //menampilkan combo kompetensi
        function tampil_listkompetensi(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listkompetensi')}}',
                
                success: function(data){				    
                    $("#idkompetensi1").html(data);                
                    $("#idkompetensiimportx").html(data);                
                }
            })                    
        }

        setTimeout(() => {
            tampil_listalasankeluar();
        }, 1000);
        //menampilkan combo alasankeluar
        function tampil_listalasankeluar(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listalasankeluar')}}',
                
                success: function(data){				    
                    $("#idalasankeluar1").html(data);                
                }
            })                    
        }

        setTimeout(() => {
            tampil_listalasansetelahkeluar();
        }, 1000);
        //menampilkan combo alasansetelahkeluar
        function tampil_listalasansetelahkeluar(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listalasansetelahkeluar')}}',
                
                success: function(data){				    
                    $("#idalasansetelahkeluar1").html(data);                
                }
            })                    
        }

        tampil_listkelas();
        //menampilkan combo kelas
        function tampil_listkelas(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.datasiswa_listkelas')}}',
                
                success: function(data){				    
                    $("#idkelaskirimx").html(data);                
                }
            })                    
        }

        function tampil_dataTable(){   
            identitas1Datatable.ajax.reload(null, false);
            datadiri1Datatable.ajax.reload(null, false);
            tempattinggal1Datatable.ajax.reload(null, false);
            kesehatan1Datatable.ajax.reload(null, false);
            pendidikan1Datatable.ajax.reload(null, false);
            ayahkandung1Datatable.ajax.reload(null, false);
            ibukandung1Datatable.ajax.reload(null, false);
            wali1Datatable.ajax.reload(null, false);
            hobi1Datatable.ajax.reload(null, false);
            perkembangan1Datatable.ajax.reload(null, false);
            selesai1Datatable.ajax.reload(null, false);
            images1Datatable.ajax.reload(null, false);
        }

        idtpx1.addEventListener('change', function () {
            setTimeout(() => {
                kirim_syarat();
            }, 500); 
                    
        });

        function kirim_syarat() {
            const idtp1 = document.getElementById('idtpx1').value;
            
            let formData = new FormData();
            formData.append('idtp1', idtp1);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('sips01.master.datasiswa_kirimsyarat') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                    // Catatan: Jangan menambahkan 'Content-Type': 'multipart/form-data' secara manual di sini.
                    // Browser akan otomatis mengaturnya lengkap dengan boundary yang benar karena kita menggunakan FormData.
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan pada server.');
                }
                return response.text(); // Mengubah respon menjadi text/JSON jika backend mengirimkan balasan
            })
            .then(data => {
                // Panggil fungsi refresh table jika sukses
                tampil_dataTable(); 
            })
            .catch(error => {
                console.error('Error:', error);
                // Anda bisa menambahkan penanganan error di sini jika diperlukan
            });
        }

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });

        function data_simpan(){            
            //identitas1
            const id1 = document.getElementById('id1').value;
            const idtpmasuk1 = document.getElementById('idtpx1').value;
            const namalengkap1 = document.getElementById('namalengkap1').value;
            const nis1 = document.getElementById('nis1').value;
            const nisn1 = document.getElementById('nisn1').value;
            const ecard1 = document.getElementById('ecard1').value;
            const tglditerima1 = document.getElementById('tglditerima1').value;
            const idstatussiswa1 = document.getElementById('idstatussiswa1').value;
            const idkompetensi1 = document.getElementById('idkompetensi1').value;
            //datadiri1
            const namapanggilan1 = document.getElementById('namapanggilan1').value;
            const idtempatlahir1 = document.getElementById('idtempatlahir1').value;
            const tgllahir1 = document.getElementById('tgllahir1').value;
            const idjk1 = document.getElementById('idjk1').value;
            const idagama1 = document.getElementById('idagama1').value;
            const warganegara1 = document.getElementById('warganegara1').value;
            const bahasa1 = document.getElementById('bahasa1').value;
            const idstatusanak1 = document.getElementById('idstatusanak1').value;
            const anakke1 = document.getElementById('anakke1').value;
            const jmlsdrkandung1 = document.getElementById('jmlsdrkandung1').value;
            const jmlsdrtiri1 = document.getElementById('jmlsdrtiri1').value;
            const jmlsdrangkat1 = document.getElementById('jmlsdrangkat1').value;
            //tempattinggal1
            const alamat1 = document.getElementById('alamat1').value;
            const iddesa1 = document.getElementById('iddesa1').value;
            const telp1 = document.getElementById('telp1').value;
            const email1 = document.getElementById('email1').value;
            const jarakkesekolah1 = document.getElementById('jarakkesekolah1').value;
            const idtinggal1 = document.getElementById('idtinggal1').value;
            //kesehatan1
            const penyakit1 = document.getElementById('penyakit1').value;
            const kelainan1 = document.getElementById('kelainan1').value;
            const idgd1 = document.getElementById('idgd1').value;
            const tinggibadan1 = document.getElementById('tinggibadan1').value;
            const beratbadan1 = document.getElementById('beratbadan1').value;
            //pendidikan1
            const asalsekolah1 = document.getElementById('asalsekolah1').value;
            const tglsttb1 = document.getElementById('tglsttb1').value;
            const nomorsttb1 = document.getElementById('nomorsttb1').value;
            const tglskhun1 = document.getElementById('tglskhun1').value;
            const nomorskhun1 = document.getElementById('nomorskhun1').value;
            const lamabelajar1 = document.getElementById('lamabelajar1').value;
            const pindah1 = document.getElementById('pindah1').value;
            const sekolahpindah1 = document.getElementById('sekolahpindah1').value;
            const alasanpindah1 = document.getElementById('alasanpindah1').value;
            //ayahkandung1
            const namaayah1 = document.getElementById('namaayah1').value;
            const idtempatlahirayah1 = document.getElementById('idtempatlahirayah1').value;
            const tgllahirayah1 = document.getElementById('tgllahirayah1').value;
            const umurayah1 = document.getElementById('umurayah1').value;
            const idagamaayah1 = document.getElementById('idagamaayah1').value;
            const idpendidikanayah1 = document.getElementById('idpendidikanayah1').value;
            const warganegaraayah1 = document.getElementById('warganegaraayah1').value;
            const pekerjaanayah1 = document.getElementById('pekerjaanayah1').value;
            const penghasilanayah1 = document.getElementById('penghasilanayah1').value.replace(/[^,\d]/g, '').toString();
            const pengeluaranayah1 = document.getElementById('pengeluaranayah1').value.replace(/[^,\d]/g, '').toString();
            const alamatayah1 = document.getElementById('alamatayah1').value;
            const iddesaayah1 = document.getElementById('iddesaayah1').value;
            const telpayah1 = document.getElementById('telpayah1').value;
            const hidupayah1 = document.getElementById('hidupayah1').value;
            const tglmeninggalayah1 = document.getElementById('tglmeninggalayah1').value;
            //ibukandung1
            const namaibu1 = document.getElementById('namaibu1').value;
            const idtempatlahiribu1 = document.getElementById('idtempatlahiribu1').value;
            const tgllahiribu1 = document.getElementById('tgllahiribu1').value;
            const umuribu1 = document.getElementById('umuribu1').value;
            const idagamaibu1 = document.getElementById('idagamaibu1').value;
            const idpendidikanibu1 = document.getElementById('idpendidikanibu1').value;
            const warganegaraibu1 = document.getElementById('warganegaraibu1').value;
            const pekerjaanibu1 = document.getElementById('pekerjaanibu1').value;
            const penghasilanibu1 = document.getElementById('penghasilanibu1').value.replace(/[^,\d]/g, '').toString();
            const pengeluaranibu1 = document.getElementById('pengeluaranibu1').value.replace(/[^,\d]/g, '').toString();
            const alamatibu1 = document.getElementById('alamatibu1').value;
            const iddesaibu1 = document.getElementById('iddesaibu1').value;
            const telpibu1 = document.getElementById('telpibu1').value;
            const hidupibu1 = document.getElementById('hidupibu1').value;
            const tglmeninggalibu1 = document.getElementById('tglmeninggalibu1').value;
            //wali1
            const namawali1 = document.getElementById('namawali1').value;
            const idtempatlahirwali1 = document.getElementById('idtempatlahirwali1').value;
            const tgllahirwali1 = document.getElementById('tgllahirwali1').value;
            const umurwali1 = document.getElementById('umurwali1').value;
            const idagamawali1 = document.getElementById('idagamawali1').value;
            const idpendidikanwali1 = document.getElementById('idpendidikanwali1').value;
            const warganegarawali1 = document.getElementById('warganegarawali1').value;
            const pekerjaanwali1 = document.getElementById('pekerjaanwali1').value;
            const penghasilanwali1 = document.getElementById('penghasilanwali1').value.replace(/[^,\d]/g, '').toString();
            const pengeluaranwali1 = document.getElementById('pengeluaranwali1').value.replace(/[^,\d]/g, '').toString();
            const alamatwali1 = document.getElementById('alamatwali1').value;
            const iddesawali1 = document.getElementById('iddesawali1').value;
            const telpwali1 = document.getElementById('telpwali1').value;
            const hidupwali1 = document.getElementById('hidupwali1').value;
            const tglmeninggalwali1 = document.getElementById('tglmeninggalwali1').value;
            //hobi1
            const hobikesenian1 = document.getElementById('hobikesenian1').value;
            const hobiolahraga1 = document.getElementById('hobiolahraga1').value;
            const hobiorganisasi1 = document.getElementById('hobiorganisasi1').value;
            const hobilain1 = document.getElementById('hobilain1').value;
            //perkembangan1
            const idtpkeluar1 = document.getElementById('idtpkeluar1').value;
            const tglkeluar1 = document.getElementById('tglkeluar1').value;
            const idalasankeluar1 = document.getElementById('idalasankeluar1').value;
            const nomorijasahlulus1 = document.getElementById('nomorijasahlulus1').value;
            const tglijasahlulus1 = document.getElementById('tglijasahlulus1').value;
            const nomorskhunlulus1 = document.getElementById('nomorskhunlulus1').value;
            const tglskhunlulus1 = document.getElementById('tglskhunlulus1').value;
            const keteranganlulus1 = document.getElementById('keteranganlulus1').value;
            const aktif1 = document.getElementById('aktif1').value;
            //selesai1
            const idalasansetelahkeluar1 = document.getElementById('idalasansetelahkeluar1').value;
            const sekolahlanjut1 = document.getElementById('sekolahlanjut1').value;
            const jurusanlanjut1 = document.getElementById('jurusanlanjut1').value;
            const kerjadi1 = document.getElementById('kerjadi1').value;
            const tglmulaikerja1 = document.getElementById('tglmulaikerja1').value;
            const namaperusahaan1 = document.getElementById('namaperusahaan1').value;
            const penghasilankerja1 = document.getElementById('penghasilankerja1').value.replace(/[^,\d]/g, '').toString();
            //images1
            const fotoawal1 = document.getElementById('fotoawal1').files[0];
            const fotoakhir1 = document.getElementById('fotoakhir1').files[0];
            const fotoktp1 = document.getElementById('fotoktp1').files[0];
            
            let formData = new FormData();
            
                //identitas 
                formData.append('id1', id1); 
                formData.append('idtpmasuk1', idtpmasuk1);
                formData.append('namalengkap1', namalengkap1);
                formData.append('nis1', nis1);
                formData.append('nisn1', nisn1);
                formData.append('ecard1', ecard1);
                formData.append('tglditerima1', tglditerima1);
                formData.append('idstatussiswa1', idstatussiswa1);
                formData.append('idkompetensi1', idkompetensi1);
                //datadiri1
                formData.append('namapanggilan1', namapanggilan1);
                formData.append('idtempatlahir1', idtempatlahir1);
                formData.append('tgllahir1', tgllahir1);
                formData.append('idjk1', idjk1);
                formData.append('idagama1', idagama1);
                formData.append('warganegara1', warganegara1);
                formData.append('bahasa1', bahasa1);
                formData.append('idstatusanak1', idstatusanak1);
                formData.append('anakke1', anakke1);
                formData.append('jmlsdrkandung1', jmlsdrkandung1);
                formData.append('jmlsdrtiri1', jmlsdrtiri1);
                formData.append('jmlsdrangkat1', jmlsdrangkat1);
                //tempattinggal1
                formData.append('alamat1', alamat1);
                formData.append('iddesa1', iddesa1);
                formData.append('telp1', telp1);
                formData.append('email1', email1);
                formData.append('jarakkesekolah1', jarakkesekolah1);
                formData.append('idtinggal1', idtinggal1);
                //kesehatan1
                formData.append('penyakit1', penyakit1);
                formData.append('kelainan1', kelainan1);
                formData.append('idgd1', idgd1);
                formData.append('tinggibadan1', tinggibadan1);
                formData.append('beratbadan1', beratbadan1);
                //pendidikan1
                formData.append('asalsekolah1', asalsekolah1);
                formData.append('tglsttb1', tglsttb1);
                formData.append('nomorsttb1', nomorsttb1);
                formData.append('tglskhun1', tglskhun1);
                formData.append('nomorskhun1', nomorskhun1);
                formData.append('lamabelajar1', lamabelajar1);
                formData.append('pindah1', pindah1);
                formData.append('sekolahpindah1', sekolahpindah1);
                formData.append('alasanpindah1', alasanpindah1);
                //ayahkandung1
                formData.append('namaayah1', namaayah1);
                formData.append('idtempatlahirayah1', idtempatlahirayah1);
                formData.append('tgllahirayah1', tgllahirayah1);
                formData.append('umurayah1', umurayah1);
                formData.append('idagamaayah1', idagamaayah1);
                formData.append('idpendidikanayah1', idpendidikanayah1);
                formData.append('warganegaraayah1', warganegaraayah1);
                formData.append('pekerjaanayah1', pekerjaanayah1);
                formData.append('penghasilanayah1', penghasilanayah1);
                formData.append('pengeluaranayah1', pengeluaranayah1);
                formData.append('alamatayah1', alamatayah1);
                formData.append('iddesaayah1', iddesaayah1);
                formData.append('telpayah1', telpayah1);
                formData.append('hidupayah1', hidupayah1);
                formData.append('tglmeninggalayah1', tglmeninggalayah1);
                //ibukandung1
                formData.append('namaibu1', namaibu1);
                formData.append('idtempatlahiribu1', idtempatlahiribu1);
                formData.append('tgllahiribu1', tgllahiribu1);
                formData.append('umuribu1', umuribu1);
                formData.append('idagamaibu1', idagamaibu1);
                formData.append('idpendidikanibu1', idpendidikanibu1);
                formData.append('warganegaraibu1', warganegaraibu1);
                formData.append('pekerjaanibu1', pekerjaanibu1);
                formData.append('penghasilanibu1', penghasilanibu1);
                formData.append('pengeluaranibu1', pengeluaranibu1);
                formData.append('alamatibu1', alamatibu1);
                formData.append('iddesaibu1', iddesaibu1);
                formData.append('telpibu1', telpibu1);
                formData.append('hidupibu1', hidupibu1);
                formData.append('tglmeninggalibu1', tglmeninggalibu1);
                //wali1
                formData.append('namawali1', namawali1);
                formData.append('idtempatlahirwali1', idtempatlahirwali1);
                formData.append('tgllahirwali1', tgllahirwali1);
                formData.append('umurwali1', umurwali1);
                formData.append('idagamawali1', idagamawali1);
                formData.append('idpendidikanwali1', idpendidikanwali1);
                formData.append('warganegarawali1', warganegarawali1);
                formData.append('pekerjaanwali1', pekerjaanwali1);
                formData.append('penghasilanwali1', penghasilanwali1);
                formData.append('pengeluaranwali1', pengeluaranwali1);
                formData.append('alamatwali1', alamatwali1);
                formData.append('iddesawali1', iddesawali1);
                formData.append('telpwali1', telpwali1);
                formData.append('hidupwali1', hidupwali1);
                formData.append('tglmeninggalwali1', tglmeninggalwali1);
                //hobi1
                formData.append('hobikesenian1', hobikesenian1);
                formData.append('hobiolahraga1', hobiolahraga1);
                formData.append('hobiorganisasi1', hobiorganisasi1);
                formData.append('hobilain1', hobilain1);
                //perkembangan1
                formData.append('idtpkeluar1', idtpkeluar1);
                formData.append('tglkeluar1', tglkeluar1);
                formData.append('idalasankeluar1', idalasankeluar1);
                formData.append('nomorijasahlulus1', nomorijasahlulus1);
                formData.append('tglijasahlulus1', tglijasahlulus1);
                formData.append('nomorskhunlulus1', nomorskhunlulus1);
                formData.append('tglskhunlulus1', tglskhunlulus1);
                formData.append('keteranganlulus1', keteranganlulus1);
                formData.append('aktif1', aktif1);
                //selesai1
                formData.append('idalasansetelahkeluar1', idalasansetelahkeluar1);
                formData.append('sekolahlanjut1', sekolahlanjut1);
                formData.append('jurusanlanjut1', jurusanlanjut1);
                formData.append('kerjadi1', kerjadi1);
                formData.append('tglmulaikerja1', tglmulaikerja1);
                formData.append('namaperusahaan1', namaperusahaan1);
                formData.append('penghasilankerja1', penghasilankerja1);
                //images1
                formData.append('fotoawal1', fotoawal1);
                formData.append('fotoakhir1', fotoakhir1);
                formData.append('fotoktp1', fotoktp1);
                
                fetch("{{ route('sips01.master.datasiswa_create') }}", {
                    method: 'POST',
                    body: formData, // Otomatis mengatur enctype 'multipart/form-data' dan processData: false
                    headers: {
                        // Mengambil token CSRF langsung dari tag meta tanpa jQuery
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        // Jika status HTTP bukan 200-299, lempar ke blok catch (error)
                        throw new Error('Jaringan bermasalah atau server error');
                    }
                    return response.json(); // Atau .text() jika backend Anda tidak mengembalikan JSON
                })
                .then(data => {
                    // === BLOK SUCCESS ===
                    tampil_dataTable();
                    btn_simpan_click();
                    if (id1 > 0) {
                        // Bootstrap 5 menutup modal (menggunakan objek instans modal Anda)
                        ModalAdd.hide(); 
                    }
                    swalsuksestambah(namalengkap1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(namalengkap1);
                });    
        }

        // function download(fileUrl, fileName) {
        //     var a = document.createElement("a");
        //     a.href = fileUrl;
        //     a.setAttribute("download", fileName);
        //     document.body.appendChild(a); // Praktik terbaik: masukkan ke DOM sebelum di-klik
        //     a.click();
        //     document.body.removeChild(a); // Hapus kembali setelah selesai
        // }

        // btn_download1.addEventListener('click', function () {
        //     // Gabungkan path langsung di dalam helper Laravel agar URL terbentuk sempurna
        //     var url3 = "{{ asset('storage/excel-files/import-datasiswa-form.xlsx') }}";
        //     var file3 = 'import-datasiswa-form.xlsx';
        //     download(url3, file3);    
        // });

        btn_download1.addEventListener('click', function () {
            // Ambil URL Route Laravel secara langsung
            var url3 = "{{ route('sips01.download.import-datasiswa-form') }}";
            // Alihkan halaman ke route tersebut untuk memicu unduhan otomatis aman
            window.location.href = url3;
        });


        btn_importexcel1x.addEventListener('click', function () {
            ModalImport.show(); 
        });

        btn_upload1.addEventListener('click', function (e) {
            e.preventDefault();
            data_import(); 
            
        });

        function data_import(){
            const idtpmasukx1 = document.getElementById('idtpx1').value;
            const tglditerimax = document.getElementById('tglditerimaimportx').value;
            const idkompetensix = document.getElementById('idkompetensiimportx').value;
            const file1x = document.getElementById('fileimportx').files[0];
            if (!idtpmasukx1) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'Tahun pelajaran belum dipilih', 'error');
                return;
            }
            if (!file1x) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'File excel belum dipilih', 'error');
                return;
            }
            if (!tglditerimax) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'Tanggal diterima belum diisi', 'error');
                return;
            }
            if (!idkompetensix) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'Kompetensi keahlian belum dipilih', 'error');
                return;
            }
            swalsedangproses();
            ModalImport.hide();
            
            let formData = new FormData();
                formData.append('idtpmasukx1', idtpmasukx1); 
                formData.append('tglditerimax1', tglditerimax);
                formData.append('idkompetensi1x', idkompetensix);
                formData.append('file1x', file1x);            
            
            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.master.datasiswa_import')}}',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },				 				
                success : function(formData){                                         
                        setTimeout(() => {
                            tampil_dataTable();
                            ModalImport.hide();
                            Swal.close();
                            swalsuksesimport('Data Siswa'); 
                        }, 500);
                    },
                error : function(formData){ 
                        Swal.close();                   
                        swalgagalimport('Data Siswa');                 
                    }
            });        
        }
        
        //.item_lihat
        document.querySelectorAll([
            '#show_identitas1', 
            '#show_datadiri1', 
            '#show_tempattinggal1', 
            '#show_kesehatan1', 
            '#show_pendidikan1', 
            '#show_ayahkandung1', 
            '#show_ibukandung1', 
            '#show_ibukandung1', 
            '#show_wali1', 
            '#show_hobi1', 
            '#show_perkembangan1', 
            '#show_selesai1', 
            '#show_images1'
            ]).forEach(element => {
            element.addEventListener('click', async function(e) {
                const targetButton = e.target.closest('.item_lihat') || e.currentTarget;
                var ket = targetButton.getAttribute('data0');
                if (targetButton) {
                    targetButton.blur();
                    var id1 = targetButton.getAttribute('data1');
                    document.getElementById('id1').value = id1;
                    
                    document.getElementById('namabeasiswa').innerText = targetButton.getAttribute('data2');
                    document.getElementById('nisbeasiswa').innerText = targetButton.getAttribute('data3');
                    document.getElementById('nisnbeasiswa').innerText = targetButton.getAttribute('data4');

                    
                    if(ket=='lihat'){
                        ModalBeasiswa.show();
                        kirim_iddatasiswa();
                    }
                    
                }
            });
        });

        //.item_edit
        document.querySelectorAll([
            '#show_identitas1', 
            '#show_datadiri1', 
            '#show_tempattinggal1', 
            '#show_kesehatan1', 
            '#show_pendidikan1', 
            '#show_ayahkandung1', 
            '#show_ibukandung1', 
            '#show_ibukandung1', 
            '#show_wali1', 
            '#show_hobi1', 
            '#show_perkembangan1', 
            '#show_selesai1', 
            '#show_images1'
            ]).forEach(element => {
            element.addEventListener('click', async function(e) {
                const targetButton = e.target.closest('.item_edit') || e.currentTarget;
                var ket = targetButton.getAttribute('data0');
                if (targetButton) {
                    targetButton.blur();
                    var id1 = targetButton.getAttribute('data1');
                    if(ket=='edit'){
                        btn_edit1_click();
                        await data_edit(id1);
                        ModalAdd.show();
                    }
                }
            });
        });

        //.item_print
        document.querySelectorAll([
            '#show_identitas1', 
            '#show_datadiri1', 
            '#show_tempattinggal1', 
            '#show_kesehatan1', 
            '#show_pendidikan1', 
            '#show_ayahkandung1', 
            '#show_ibukandung1', 
            '#show_ibukandung1', 
            '#show_wali1', 
            '#show_hobi1', 
            '#show_perkembangan1', 
            '#show_selesai1', 
            '#show_images1'
            ]).forEach(element => {
            element.addEventListener('click', async function(e) {
                const targetButton = e.target.closest('.item_print') || e.currentTarget;
                var ket = targetButton.getAttribute('data0');
                if (targetButton) {
                    targetButton.blur();
                    var id1 = targetButton.getAttribute('data1');
                    var nama1 = targetButton.getAttribute('data2');
                    var nis1 = targetButton.getAttribute('data3');
                    var nisn1 = targetButton.getAttribute('data4');
                    if(ket=='print'){
                        document.getElementById('id3').value = id1
                        document.getElementById('namaprint').innerText = nama1;
                        document.getElementById('nisprint').innerText = nis1;
                        document.getElementById('nisnprint').innerText = nisn1;
                        kirim_id(id1, nisn1);
                        // await data_edit(id1);
                        ModalPrint.show();
                    }
                }
            });
        });

        btn_printdatainduk1x.addEventListener('click', function (e) {
            e.preventDefault();
            var id3 = document.getElementById('id3').value;
            window.open('{{ route('sips01.master.datasiswa_printdatainduk') }}');
            ModalPrint.hide();
        });

        function kirim_id(id, nisn) {
            const iddatasiswa1 = id;
            const nisn1 = nisn;

            let formData = new FormData();
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('nisn1', nisn1);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('sips01.master.datasiswa_kirimid') }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                    // Catatan: Jangan menambahkan 'Content-Type': 'multipart/form-data' secara manual di sini.
                    // Browser akan otomatis mengaturnya lengkap dengan boundary yang benar karena kita menggunakan FormData.
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan pada server.');
                }
                return response.text(); // Mengubah respon menjadi text/JSON jika backend mengirimkan balasan
            })
            .then(data => {
                // Panggil fungsi refresh table jika sukses
                // tampil_dataTable(); 
            })
            .catch(error => {
                console.error('Error:', error);
                // Anda bisa menambahkan penanganan error di sini jika diperlukan
            });
        }
        async function data_edit(id1) {
            swalsedangproses();
            const url = `{{ url('/sips01/master/datasiswaedit') }}/${id1}`;
            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    throw new Error('Gagal mengambil data dari server');
                }

                const data = await response.json();
                const resultData = data.data;

                var desa1;
                var kecamatan1;
                var kabupaten1;
                var propinsi1;
                var html1;
                // Loop data
                for (let i = 0; i < resultData.length; i++) {
                    
                    document.getElementById('namabeasiswa').innerText = resultData[i].namalengkap;
                    document.getElementById('nisbeasiswa').innerText = resultData[i].nis;
                    document.getElementById('nisnbeasiswa').innerText = resultData[i].nisn;

                    //identitas1
                    document.getElementById('id1').value = resultData[i].id;
                    document.getElementById('ecard1').value = resultData[i].ecard;
                    document.getElementById('nis1').value = resultData[i].nis;
                    document.getElementById('nisn1').value = resultData[i].nisn;
                    document.getElementById('namalengkap1').value = resultData[i].namalengkap;
                    document.getElementById('tglditerima1').value = resultData[i].tglditerima;
                    document.getElementById('idstatussiswa1').value = resultData[i].idstatussiswa;
                    document.getElementById('idkompetensi1').value = resultData[i].idkompetensi;
                    //datadiri1
                    document.getElementById('namapanggilan1').value = resultData[i].namapanggilan;
                    document.getElementById('idtempatlahir1').value = resultData[i].idtempatlahir;
                    document.getElementById('tgllahir1').value = resultData[i].tgllahir;
                    document.getElementById('idjk1').value = resultData[i].idjk;
                    document.getElementById('idagama1').value = resultData[i].idagama;
                    document.getElementById('warganegara1').value = resultData[i].warganegara;
                    document.getElementById('bahasa1').value = resultData[i].bahasa;
                    document.getElementById('idstatusanak1').value = resultData[i].idstatusanak;
                    document.getElementById('anakke1').value = resultData[i].anakke;
                    document.getElementById('jmlsdrkandung1').value = resultData[i].jmlsdrkandung;
                    document.getElementById('jmlsdrtiri1').value = resultData[i].jmlsdrtiri;
                    document.getElementById('jmlsdrangkat1').value = resultData[i].jmlsdrangkat;
                    //tempattinggal1
                    html = '<option value="' + resultData[i].iddesa + '">' + resultData[i].desa.desa +'</option>';
                    document.getElementById("iddesa1").innerHTML = html;
                    document.getElementById('alamat1').value = resultData[i].alamat;
                    document.getElementById('iddesa1').value = resultData[i].iddesa;
                    document.getElementById('telp1').value = resultData[i].telp;
                    document.getElementById('email1').value = resultData[i].email;
                    document.getElementById('jarakkesekolah1').value = resultData[i].jarakkesekolah;
                    document.getElementById('idtinggal1').value = resultData[i].idtinggal;
                    //kesehatan1
                    document.getElementById('penyakit1').value = resultData[i].penyakit;
                    document.getElementById('kelainan1').value = resultData[i].kelainan;
                    document.getElementById('idgd1').value = resultData[i].idgd;
                    document.getElementById('tinggibadan1').value = resultData[i].tinggibadan;
                    document.getElementById('beratbadan1').value = resultData[i].beratbadan;
                    //pendidikan1
                    document.getElementById('asalsekolah1').value = resultData[i].asalsekolah;
                    document.getElementById('tglsttb1').value = resultData[i].tglsttb;
                    document.getElementById('nomorsttb1').value = resultData[i].nomorsttb;
                    document.getElementById('tglskhun1').value = resultData[i].tglskhun;
                    document.getElementById('nomorskhun1').value = resultData[i].nomorskhun;
                    document.getElementById('lamabelajar1').value = resultData[i].lamabelajar;
                    document.getElementById('pindah1').value = resultData[i].pindah;
                    document.getElementById('sekolahpindah1').value = resultData[i].sekolahpindah;
                    document.getElementById('alasanpindah1').value = resultData[i].alasanpindah;
                    //ayahkandung1
                    html = '<option value="' + resultData[i].iddesaayah + '">' + resultData[i].desaayah.desa +'</option>';
                    document.getElementById("iddesaayah1").innerHTML = html;
                    document.getElementById('namaayah1').value = resultData[i].namaayah;
                    document.getElementById('idtempatlahirayah1').value = resultData[i].idtempatlahirayah;
                    document.getElementById('tgllahirayah1').value = resultData[i].tgllahirayah;
                    document.getElementById('umurayah1').value = resultData[i].umurayah;
                    document.getElementById('idagamaayah1').value = resultData[i].idagamaayah;
                    document.getElementById('idpendidikanayah1').value = resultData[i].idpendidikanayah;
                    document.getElementById('warganegaraayah1').value = resultData[i].warganegaraayah;
                    document.getElementById('pekerjaanayah1').value = resultData[i].pekerjaanayah;
                    document.getElementById('penghasilanayah1').value = formatAngka(resultData[i].penghasilanayah,'');
                    document.getElementById('pengeluaranayah1').value = formatAngka(resultData[i].pengeluaranayah,'');
                    document.getElementById('alamatayah1').value = resultData[i].alamatayah;
                    document.getElementById('iddesaayah1').value = resultData[i].iddesaayah;
                    document.getElementById('telpayah1').value = resultData[i].telpayah;
                    document.getElementById('hidupayah1').value = resultData[i].hidupayah;
                    document.getElementById('tglmeninggalayah1').value = resultData[i].tglmeninggalayah;
                    const hidupayahValue = document.getElementById('hidupayah1').value;
                    if (hidupayahValue === 'Y') {
                        document.getElementById("hidupayah1xy").checked = true;
                    } else {
                        document.getElementById("hidupayah1xn").checked = true;
                    }
                    //ibukandung1
                    html = '<option value="' + resultData[i].iddesaibu + '">' + resultData[i].desaibu.desa +'</option>';
                    document.getElementById("iddesaibu1").innerHTML = html;
                    document.getElementById('namaibu1').value = resultData[i].namaibu;
                    document.getElementById('idtempatlahiribu1').value = resultData[i].idtempatlahiribu;
                    document.getElementById('tgllahiribu1').value = resultData[i].tgllahiribu;
                    document.getElementById('umuribu1').value = resultData[i].umuribu;
                    document.getElementById('idagamaibu1').value = resultData[i].idagamaibu;
                    document.getElementById('idpendidikanibu1').value = resultData[i].idpendidikanibu;
                    document.getElementById('warganegaraibu1').value = resultData[i].warganegaraibu;
                    document.getElementById('pekerjaanibu1').value = resultData[i].pekerjaanibu;
                    document.getElementById('penghasilanibu1').value = formatAngka(resultData[i].penghasilanibu,'');
                    document.getElementById('pengeluaranibu1').value = formatAngka(resultData[i].pengeluaranibu,'');
                    document.getElementById('alamatibu1').value = resultData[i].alamatibu;
                    document.getElementById('iddesaibu1').value = resultData[i].iddesaibu;
                    document.getElementById('telpibu1').value = resultData[i].telpibu;
                    document.getElementById('hidupibu1').value = resultData[i].hidupibu;
                    document.getElementById('tglmeninggalibu1').value = resultData[i].tglmeninggalibu;
                    const hidupibuValue = document.getElementById('hidupibu1').value;
                    if (hidupibuValue === 'Y') {
                        document.getElementById("hidupibu1xy").checked = true;
                    } else {
                        document.getElementById("hidupibu1xn").checked = true;
                    }
                    //wali
                    html = '<option value="' + resultData[i].iddesawali + '">' + resultData[i].desawali.desa +'</option>';
                    document.getElementById("iddesawali1").innerHTML = html;
                    document.getElementById('namawali1').value = resultData[i].namawali;
                    document.getElementById('idtempatlahirwali1').value = resultData[i].idtempatlahirwali;
                    document.getElementById('tgllahirwali1').value = resultData[i].tgllahirwali;
                    document.getElementById('umurwali1').value = resultData[i].umurwali;
                    document.getElementById('idagamawali1').value = resultData[i].idagamawali;
                    document.getElementById('idpendidikanwali1').value = resultData[i].idpendidikanwali;
                    document.getElementById('warganegarawali1').value = resultData[i].warganegarawali;
                    document.getElementById('pekerjaanwali1').value = resultData[i].pekerjaanwali;
                    document.getElementById('penghasilanwali1').value = formatAngka(resultData[i].penghasilanwali,'');
                    document.getElementById('pengeluaranwali1').value = formatAngka(resultData[i].pengeluaranwali,'');
                    document.getElementById('alamatwali1').value = resultData[i].alamatwali;
                    document.getElementById('iddesawali1').value = resultData[i].iddesawali;
                    document.getElementById('telpwali1').value = resultData[i].telpwali;
                    document.getElementById('hidupwali1').value = resultData[i].hidupwali;
                    document.getElementById('tglmeninggalwali1').value = resultData[i].tglmeninggalwali;
                    const hidupwaliValue = document.getElementById('hidupwali1').value;
                    if (hidupwaliValue === 'Y') {
                        document.getElementById("hidupwali1xy").checked = true;
                    } else {
                        document.getElementById("hidupwali1xn").checked = true;
                    }
                    //hobi1
                    document.getElementById('hobikesenian1').value = resultData[i].hobikesenian;
                    document.getElementById('hobiolahraga1').value = resultData[i].hobiolahraga;
                    document.getElementById('hobiorganisasi1').value = resultData[i].hobiorganisasi;
                    document.getElementById('hobilain1').value = resultData[i].hobilain;
                    //perkembangan1
                    $('#tglkeluar1').val(resultData[i].tglkeluar);
                    $('#idkeluar1').val(resultData[i].idkeluar1);
                    $('#idalasankeluar1').val(resultData[i].idalasankeluar);
                    $('#nomorijasahlulus1').val(resultData[i].nomorijasahlulus);
                    $('#tglijasahlulus1').val(resultData[i].tglijasahlulus);
                    $('#nomorskhunlulus1').val(resultData[i].nomorskhunlulus);
                    $('#tglskhunlulus1').val(resultData[i].tglskhunlulus);
                    $('#keteranganlulus1').val(resultData[i].keteranganlulus);
                    /*
                    document.getElementById('tglkeluar1').value = resultData[i].tglkeluar;
                    document.getElementById('idkeluar1').value = resultData[i].idkeluar;
                    document.getElementById('idalasankeluar1').value = resultData[i].idalasankeluar;
                    document.getElementById('nomorijasahlulus1').value = resultData[i].nomorijasahlulus;
                    document.getElementById('tglijasahlulus1').value = resultData[i].tglijasahlulus;
                    document.getElementById('nomorskhunlulus1').value = resultData[i].nomorskhunlulus;
                    document.getElementById('tglskhunlulus1').value = resultData[i].tglskhunlulus;
                    */
                    document.getElementById('aktif1').value = resultData[i].aktif;
                    const aktifValue = document.getElementById('aktif1').value;
                    if (aktifValue === 'Y') {
                        document.getElementById("aktif1xy").checked = true;
                    } else {
                        document.getElementById("aktif1xn").checked = true;
                    }
                    //selesai1
                    document.getElementById('idalasansetelahkeluar1').value = resultData[i].idalasansetelahkeluar;
                    document.getElementById('sekolahlanjut1').value = resultData[i].sekolahlanjut;
                    document.getElementById('jurusanlanjut1').value = resultData[i].jurusanlanjut;
                    document.getElementById('kerjadi1').value = resultData[i].kerjadi;
                    document.getElementById('tglmulaikerja1').value = resultData[i].tglmulaikerja;
                    document.getElementById('namaperusahaan1').value = resultData[i].namaperusahaan;
                    document.getElementById('penghasilankerja1').value = formatAngka(resultData[i].penghasilankerja,'');
                    //images1
                    
                    document.getElementById('fotoawal1').value = '';
                    document.getElementById('fotoawal1x').value = resultData[i].fotoawal;
                    var gbr2 = document.getElementById('fotoawal1x').value;
                    var gbrx = "";
                    if(gbr2){                        
                        var url2="{{ asset('storage/') }}/"+gbr2;
                        gbrx="<img src='"+url2+"' class='img-previewfotoawal1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoawal1' name='img-previewfotoawal1' style='width: 100%;'>";
                    }else{
                        gbrx="<h5 class='mt-2 small' align='center'>Belum ada image yang diupload<h5>";
                    }
                    document.getElementById("gambarfotoawal1").innerHTML=gbrx;
                    
                    document.getElementById('fotoakhir1').value = '';
                    document.getElementById('fotoakhir1x').value = resultData[i].fotoakhir;
                    var gbr2 = document.getElementById('fotoakhir1x').value;
                    var gbrx = "";
                    if(gbr2){                        
                        var url2="{{ asset('storage/') }}/"+gbr2;
                        gbrx="<img src='"+url2+"' class='img-previewfotoakhir1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoakhir1' name='img-previewfotoakhir1' style='width: 100%;'>";
                    }else{
                        gbrx="<h5 class='mt-2 small' align='center'>Belum ada image yang diupload<h5>";
                    }
                    document.getElementById("gambarfotoakhir1").innerHTML=gbrx;
                    
                    document.getElementById('fotoktp1').value = '';
                    document.getElementById('fotoktp1x').value = resultData[i].fotoktp;
                    var gbr2 = document.getElementById('fotoktp1x').value;
                    var gbrx = "";
                    if(gbr2){                        
                        var url2="{{ asset('storage/') }}/"+gbr2;
                        gbrx="<img src='"+url2+"' class='img-previewfotoktp1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoktp1' name='img-previewfotoktp1' style='width: 100%;'>";
                    }else{
                        gbrx="<h5 class='mt-2 small' align='center'>Belum ada image yang diupload<h5>";
                    }
                    document.getElementById("gambarfotoktp1").innerHTML=gbrx;
                       
                    Swal.close();
                }

            } catch (error) {
                Swal.close();
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    // swalgagaltambah('Gagal memuat data pengguna.');
                }
            }
        }

        async function show_pilih1(targetButton) {
            if (!targetButton) return;
            
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            
            var id3 = targetButton.getAttribute('data1');
            var data3a = targetButton.getAttribute('data2');
            var data3b = targetButton.getAttribute('data3');
            var data3c = targetButton.getAttribute('data4');

            document.getElementById('id3').value = id3;
            document.getElementById('data3a').value = data3a;
            document.getElementById('data3b').value = data3b;
            document.getElementById('data3c').value = data3c;

            await swal_destroy(data3a);
        }

        //.item_destroy
        document.querySelectorAll([
            '#show_identitas1', 
            '#show_datadiri1', 
            '#show_tempattinggal1', 
            '#show_kesehatan1', 
            '#show_pendidikan1', 
            '#show_ayahkandung1', 
            '#show_ibukandung1', 
            '#show_ibukandung1', 
            '#show_wali1', 
            '#show_hobi1', 
            '#show_perkembangan1', 
            '#show_selesai1', 
            '#show_images1'
            ]).forEach(element => {
            element.addEventListener('click', async function(e) {
                const targetButton = e.target.closest('.item_destroy') || e.currentTarget;
                var ket = targetButton.getAttribute('data0');
                if (targetButton) { 
                    if(ket=='destroy'){
                        await show_pilih1(targetButton);
                    }
                }
            });
        });


        /*
        document.getElementById('show_identitas1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            if (targetButton) {
                await show_pilih1(targetButton);
            }
        });
        document.getElementById('show_datadiri1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            if (targetButton) {
                await show_pilih1(targetButton);
            }
        });
        document.getElementById('show_tempattinggal1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            if (targetButton) {
                await show_pilih1(targetButton);
            }
        });
        document.getElementById('show_kesehatan1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            if (targetButton) {
                await show_pilih1(targetButton);
            }
        });
        */
       function swal_destroy(x){
            Swal.fire({
            title: 'Are you sure delete?',
            text: x,
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, delete !",
            cancelButtonText: "No, cancel !",
            }).then((result) => {
                if (result.isConfirmed) {
                    data_destroy();            
                }
            })
        } 

        function data_destroy(){			
            var id3 = document.getElementById('id3').value;       
            var data3a = document.getElementById('data3a').value;      
            
            $.ajax({
                type  : 'POST',
                url   : '{{url('/sips01/master/datasiswadestroy')}}/'+id3,
                async : false,
                dataType : 'json',
                data: {
                    _method: 'DELETE', // Spoofing metode menjadi DELETE untuk Laravel
                    _token: '{{ csrf_token() }}' // Wajib mengirimkan CSRF Token Laravel
                },						
                success : function(data){
                    tampil_dataTable();
                    swalsuksesdestroy(data3a); 
                },
                error : function(data){
                    swalgagaldestroy(data3a);
                }
            }); 
        }

        function swalsuksestambah(x){
            Swal.fire({
                icon: 'success',
                title: 'Save successfully',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalgagaltambah(x){
            Swal.fire({
                icon: 'error',
                title: 'Oops...failed to add/update record',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalsuksesupdate(x){
            Swal.fire({
                icon: 'success',
                title: 'Update successfully',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalgagalupdate(x){
            Swal.fire({
                icon: 'error',
                title: 'Oops...failed to update',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalsuksesdestroy(x){
            Swal.fire({
                icon: 'success',
                title: 'Delete successfully',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalgagaldestroy(x){
            Swal.fire({
                icon: 'error',
                title: 'Oops...failed to delete',
                text: x,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }
        function swalsuksesimport(x){
            Swal.fire({
                icon: 'success',
                title: 'Import successfully',
                text: x,
                timer:2000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalgagalimport(x){
            Swal.fire({
                icon: 'error',
                title: 'Oops...failed to import',
                text: x,
                timer: 2000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalsukseskirim(x){
            Swal.fire({
                icon: 'success',
                title: 'Send successfully',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalgagalkirim(x){
            Swal.fire({
                icon: 'error',
                title: 'Oops...failed to send record',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalsedangproses(){
            Swal.fire({
            title: 'Sedang Proses',
            text: 'Mohon tunggu .......',
            showConfirmButton: false, // Menghilangkan tombol OK/Konfirmasi
            allowOutsideClick: false,  // Mencegah closed saat klik di luar alert
            allowEscapeKey: false,     // Mencegah closed saat menekan tombol Escape
            didOpen: () => {
                Swal.showLoading();      // Menampilkan animasi icon proses (loading)
            }
            });
        }

        
    });
</script>

@endsection