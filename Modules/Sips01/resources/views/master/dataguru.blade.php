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
                <div class="row mb-2 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label mb-md-0 small fw-bold"></label>
                    </div>
                    <div class="col-md-7">
                        {{-- Tempatkan Form Input/Select 1 di sini --}}
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
                    
                </div> 
            </div>
        </div>
        
    </div>

    <div class="card-body px-0 py-0" id="headerjudul" style="display: block;">

        <!-- tab-pegawai1 -->
        <ul class="nav nav-tabs" id="tab-pegawai1" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="identitas-tab-pegawai1" data-bs-toggle="pill" data-bs-target="#identitas-isi-tab-pegawai1" type="button" role="tab" aria-controls="#identitas-isi-tab-pegawai1" aria-selected="true">Identitas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="datadiri-tab-pegawai1" data-bs-toggle="pill" data-bs-target="#datadiri-isi-tab-pegawai1" type="button" role="tab" aria-controls="datadiri--isi-tab-pegawai1" aria-selected="false">Data Diri</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="sosmed-tab-pegawai1" data-bs-toggle="pill" data-bs-target="#sosmed-isi-tab-pegawai1" type="button" role="tab" aria-controls="sosmed-isi-tab-pegawai1" aria-selected="false">Sosial Media</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lain-tab-pegawai1" data-bs-toggle="pill" data-bs-target="#lain-isi-tab-pegawai1" type="button" role="tab" aria-controls="lain-isi-tab-pegawai1" aria-selected="false">Lain-lain</button>
            </li>
        </ul>
        <!-- end-tab-pegawai1 -->

        <!-- tabcontent-tab-pegawai1 -->
        <div class="tab-content p-3 border border-top-0" id="tabcontent-tab-pegawai1">            
            <!-- identitas-isi-tab-pegawai1 -->
            <div class="tab-pane fade show active" id="identitas-isi-tab-pegawai1" role="tabpanel" aria-labelledby="identitas-tab-pegawai1" tabindex="0">
                <div id="reload-identitas1" class="table-responsive">
                    <table id="identitas1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>                            
                                <th style="width:50px">Ecard</th>							
                                <th style="width:50px">NIP</th>
                                <th style="width:50px">NUPTK</th>
                                <th style="width:200px">Nama</th>							
                                <th style="width:50px">Pangkat</th>							
                                <th style="width:50px">Status Profesi</th>							
                                <th style="width:50px">Jabatan Utama</th>							
                                <th style="width:50px">Jabatan Lain</th>							
                                <th style="width:50px">Status Pegawai</th>
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
            <!-- end identitas-isi-tab-pegawai1 -->
            
            <!-- datadiri-isi-tab-pegawai1 -->
            <div class="tab-pane fade" id="datadiri-isi-tab-pegawai1" role="tabpanel" aria-labelledby="datadiri-tab-pegawai1" tabindex="0">
                <div id="reload-datadiri1" class="table-responsive">
                    <table id="datadiri1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>                            
                                <th style="width:50px">Ecard</th>							
                                <th style="width:50px">NIP</th>
                                <th style="width:50px">NUPTK</th>
                                <th style="width:200px">Nama</th>							
                                <th style="width:50px">Pend.</th>							
                                <th style="width:50px">Jurusan</th>							
                                <th style="width:50px">L/P</th>							
                                <th style="width:50px">Agama</th>							
                                <th style="width:50px">Tempat Lahir</th>							
                                <th style="width:50px">Tgl Lahir</th>							
                                <th style="width:200px">Alamat</th>							
                                <th style="width:50px">Telp</th>							
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
            <!-- end datadiri-isi-tab-pegawai1 -->

            <!-- sosmed-isi-tab-pegawai1 -->
            <div class="tab-pane fade" id="sosmed-isi-tab-pegawai1" role="tabpanel" aria-labelledby="sosmed-tab-pegawai1" tabindex="0">
                <div id="reload-sosmed1" class="table-responsive">
                    <table id="sosmed1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIP</th>
                                <th style="width:50px">NUPTK</th>
                                <th style="width:200px">Nama</th>							
                                <th style="width:80">Email</th>							
                                <th style="width:80">Whatsapp</th>							
                                <th style="width:80">Twitter</th>							
                                <th style="width:80">Facebook</th>							
                                <th style="width:80">Instagram</th>							
                                <th style="width:80">Line</th>							
                                <th style="width:80">Blog</th>							
                                <th style="width:80">Web</th>							
                                <th style="width:50px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_sosmed1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_sosmed1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end sosmed-isi-tab-pegawai1 -->
            
            <!-- lain-isi-tab-pegawai1 -->
            <div class="tab-pane fade" id="lain-isi-tab-pegawai1" role="tabpanel" aria-labelledby="lain-tab-pegawai1" tabindex="0">
                <div id="reload-lain1" class="table-responsive">
                    <table id="lain1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:50px">Ecard</th>
                                <th style="width:50px">NIP</th>
                                <th style="width:50px">NUPTK</th>
                                <th style="width:200px">Nama</th>							
                                <th style="width:50px">Tgl Masuk</th>							
                                <th style="width:50px">Tgl Keluar</th>							
                                <th style="width:50px">Aktif</th>							
                                <th style="width:50px">Foto</th>							
                                <th style="width:50px">Keterangan</th>							
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_lain1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_lain1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end lain-isi-tab-pegawai1 -->
        </div>
        <!-- end tabcontent-tab-pegawai1 -->

        <!-- ModalAdd modal fade-->
        <div class="modal fade" id="ModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                    
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
                            
                                <!-- tab-pegawai2 -->
                                <ul class="nav nav-tabs" id="tab-pegawai2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="identitas-tab-pegawai2" data-bs-toggle="pill" data-bs-target="#identitas-isi-tab-pegawai2" type="button" role="tab" aria-controls="#identitas-isi-tab-pegawai2" aria-selected="true">Identitas</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="datadiri-tab-pegawai2" data-bs-toggle="pill" data-bs-target="#datadiri-isi-tab-pegawai2" type="button" role="tab" aria-controls="datadiri--isi-tab-pegawai2" aria-selected="false">Data Diri</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="sosmed-tab-pegawai2" data-bs-toggle="pill" data-bs-target="#sosmed-isi-tab-pegawai2" type="button" role="tab" aria-controls="sosmed-isi-tab-pegawai2" aria-selected="false">Sosial Media</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="lain-tab-pegawai2" data-bs-toggle="pill" data-bs-target="#lain-isi-tab-pegawai2" type="button" role="tab" aria-controls="lain-isi-tab-pegawai2" aria-selected="false">Lain-lain</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="images-tab-pegawai2" data-bs-toggle="pill" data-bs-target="#images-isi-tab-pegawai2" type="button" role="tab" aria-controls="images-isi-tab-pegawai2" aria-selected="false">Images</button>
                                    </li>
                                </ul>
                                <!-- end-tab-pegawai2 -->

                                <!-- tabcontent-tab-pegawai2 -->
                                <div class="tab-content p-3 border border-top-0" id="tabcontent-tab-pegawai2">            
                                    <!-- identitas-isi-tab-pegawai2 -->
                                    <div class="tab-pane fade show active" id="identitas-isi-tab-pegawai2" role="tabpanel" aria-labelledby="identitas-tab-pegawai2" tabindex="0">
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="nama1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Nama<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nama1" id="nama1" maxlength="100" class="form-control" placeholder="Nama" value="{{ old('nama1') }}"  required autofocus>
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="ecard1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Ecard<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="ecard1" id="ecard1" maxlength="30" class="form-control" placeholder="Ecard" value="{{ old('ecard1') }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row mb-1 align-items-center">
                                            <label for="nip1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                NIP<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nip1" id="nip1" maxlength="30" class="form-control" placeholder="NIP" value="{{ old('nip1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="nuptk1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                NUPTK<span class="text-danger">*</span>
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="nuptk1" id="nuptk1" maxlength="30" class="form-control" placeholder="NUPTK" value="{{ old('nuptk1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idpangkat1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pangkat
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idpangkat1" id="idpangkat1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Pangkat --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idstatusprofesi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Status Profesi
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idstatusprofesi1" id="idstatusprofesi1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Status Profesi --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="jabatan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jabatan Utama
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="jabatan1" id="jabatan1" maxlength="50" class="form-control" placeholder="Jabatan Utama" value="{{ old('jabatan1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="jabatan21" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jabatan Lain
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="jabatan21" id="jabatan21" maxlength="50" class="form-control" placeholder="Jabatan Lain" value="{{ old('jabatan21') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="idstatuspegawai1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Status Pegawai
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idstatuspegawai1" id="idstatuspegawai1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Status Pegawai --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <!-- end identitas-isi-tab-pegawai2 -->
                                    
                                    <!-- datadiri-isi-tab-pegawai2 -->
                                    <div class="tab-pane fade" id="datadiri-isi-tab-pegawai2" role="tabpanel" aria-labelledby="datadiri-tab-pegawai2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="idpendidikan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Pendidikan
                                            </label>
                                            <div class="col-sm-8">
                                                <select name="idpendidikan1" id="idpendidikan1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Pendidikan --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="jurusan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Jurusan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="jurusan1" id="jurusan1" maxlength="50" class="form-control" placeholder="Jurusan" value="{{ old('jurusan1') }}" >
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

                                        <style>
                                            #btn_cari1 {
                                                /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                                border: 1px solid #ced4da !important; 
                                                color: #6c757d;
                                            }
                                            #btn_cari1:hover {
                                                background-color: #f8f9fa;
                                                color: #495057;
                                            }
                                            #btn_cari1:focus {
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
                                                    <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_cari1" name="btn_cari1">
                                                        <i class="bi bi-search" style="font-size: 16px;"></i>
                                                    </button>
                                                </div>
                                                <!--
                                                <select name="idtempatlahir1" id="idtempatlahir1" class="form-select">
                                                    <option value="" selected disabled>-- Pilih Tempat Lahir --</option>
                                                    {{-- Option akan di-render via JS atau @foreach Blade --}}
                                                </select>
                                            -->
                                            </div>
                                        </div>
                                        <!--
                                        <div class="row align-items-center mb-3">
                                            <div class="col-md-4 text-end">
                                                <h6 class="mt-2 mb-0">Tempat Lahir</h6>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <select name="idtempatlahir1" id="idtempatlahir1" class="form-control rounded-0 border-0 shadow-none"></select>
                                                    <button class="btn btn-outline-secondary rounded-0 border-0" type="button" id="btn_cari1" name="btn_cari1">
                                                        <i class="fas fa-search" style="font-size: 20px;"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    -->
                                        <div class="row mb-1 align-items-center">
                                            <label for="tgllahir1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Lahir
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tgllahir1" id="tgllahir1" maxlength="10" class="form-control" placeholder="Tanggal Lahir" value="{{ old('tgllahir1') }}" >
                                            </div>
                                        </div>

                                        <div class="row mb-1 align-items-center">
                                            <label for="alamat1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Alamat
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="alamat1" id="alamat1" maxlength="50" class="form-control" placeholder="Alamat" value="{{ old('alamat1') }}" >
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

                                    </div>
                                    <!-- end datadiri-isi-tab-pegawai2 -->

                                    <!-- sosmed-isi-tab-pegawai2 -->
                                    <div class="tab-pane fade" id="sosmed-isi-tab-pegawai2" role="tabpanel" aria-labelledby="sosmed-tab-pegawai2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="email1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Email
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="email" name="email1" id="email1" maxlength="30" class="form-control" placeholder="Email" value="{{ old('email1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="wa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Whatsapp
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="wa1" id="wa1" maxlength="30" class="form-control" placeholder="Whatsapp" value="{{ old('wa1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="twitter1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Twitter
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="twitter1" id="twitter1" maxlength="30" class="form-control" placeholder="Twitter" value="{{ old('twitter1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="facebook1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Facebook
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="facebook1" id="facebook1" maxlength="30" class="form-control" placeholder="Facebook" value="{{ old('facebook1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="ig1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Instagram
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="ig1" id="ig1" maxlength="30" class="form-control" placeholder="Instagram" value="{{ old('ig1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="line1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Line
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="line1" id="line1" maxlength="30" class="form-control" placeholder="Line" value="{{ old('line1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="web1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Web
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="web1" id="web1" maxlength="30" class="form-control" placeholder="Web" value="{{ old('web1') }}" >
                                            </div>
                                        </div>
                                        <div class="row mb-1 align-items-center">
                                            <label for="blog1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Blog
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="blog1" id="blog1" maxlength="30" class="form-control" placeholder="Blog" value="{{ old('blog1') }}" >
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end sosmed-isi-tab-pegawai2 -->
                                    
                                    <!-- lain-isi-tab-pegawai2 -->
                                    <div class="tab-pane fade" id="lain-isi-tab-pegawai2" role="tabpanel" aria-labelledby="lain-tab-pegawai2" tabindex="0">
                                        <div class="row mb-1 align-items-center">
                                            <label for="tglmasuk1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Tanggal Masuk
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="tglmasuk1" id="tglmasuk1" maxlength="10" class="form-control" placeholder="Tglmasuk" value="{{ old('tglmasuk1') }}" >
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
                                            <label for="keterangan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Keterangan
                                            </label>
                                            <div class="col-sm-8">
                                                <input type="search" name="keterangan1" id="keterangan1" maxlength="30" class="form-control" placeholder="Keterangan" value="{{ old('keterangan1') }}" >
                                            </div>
                                        </div>                                        
                                        
                                    </div>
                                    <!-- end lain-isi-tab-pegawai2 -->
                                    
                                    <!-- images-isi-tab-pegawai2 -->
                                    <div class="tab-pane fade" id="images-isi-tab-pegawai2" role="tabpanel" aria-labelledby="images-tab-pegawai2" tabindex="0">
                                        <div class="row mb-0 align-items-start">
                                            <label for="foto1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                                Foto <br><small class="text-muted fw-normal">(Maks. 2048 KB)</small>
                                            </label>
                                            <div class="col-sm-8">
                                                <!-- Input File -->
                                                <input type="file" name="foto1" id="foto1" 
                                                        class="form-control mb-2 @error('foto1') is-invalid @enderror" 
                                                        accept="image/*">
                                                <!-- Error Handling Laravel -->
                                                @error('foto1')
                                                    <div class="invalid-feedback mb-2">{{ $message }}</div>
                                                @enderror
                                                <input type="hidden" name="foto1x" id="foto1x">
                                                <!-- Box Preview Image (Bootstrap 5 Flexbox) -->
                                                <div class="col-md-7">
                                                    <div class="card border" style="min-height: 200px; height: auto;">                                              
                                                        <div id="gambarfoto1" name="gambarfoto1" class="mb-1 w-100">                                                                         
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end images-isi-tab-pegawai2 -->
                                </div>
                                <!-- end tabcontent-tab-pegawai2 -->

                            </div>
                        </fieldset>

                        <!-- Modal Footer -->
                        <div class="row mb-0 mt-0 py-0 align-items-center">
                            <div class="col-sm-1">
                                
                                {{--  --}}
                            </div>
                            <label class="col-sm-11 col-form-label text-sm-first fw-semibold">
                                <small class="text-muted"><span class="text-danger">*</span> Wajib diisi.</small>
                            </label>
                        </div>

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

        <!-- ModalCari modal fade-->
        <div class="modal fade" id="ModalCari" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <div id="reloadCari" class="table-responsive">
                                    <table id="cari1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:30px">Kode</th>							
                                                <th style="width:150px">Kabupaten</th>
                                                <th style="width:150px">Propinsi</th>							
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footercari1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_cari1">
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
        <!-- end ModalCari -->

        




    </div>

   
    <!-- khusus menyimpan data yang akan didestroy -->
    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	



</div>

<script type="text/javascript">
    let identitas1Datatable;
    let datadiri1Datatable;
    let sosmed1Datatable;
    let lain1Datatable;
    
    document.addEventListener("DOMContentLoaded", function() {
        
        //persiapan button dan modal
        const ModalAdd = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalAdd'));
        const ModalCari = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCari'));
        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        const btn_cari1 = document.getElementById('btn_cari1');
        
        //identitas
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const ecard1 = document.getElementById('ecard1');        
        const nip1 = document.getElementById('nip1');        
        const nuptk1 = document.getElementById('nuptk1');        
        const nama1 = document.getElementById('nama1');    
        const idpangkat1 = document.getElementById('idpangkat1');
        const idstatusprofesi1 = document.getElementById('idstatusprofesi1');
        const jabatan1 = document.getElementById('jabatan1');
        const jabatan21 = document.getElementById('jabatan21');
        const idstatuspegawai1 = document.getElementById('idstatuspegawai1');
        //datadiri
        const idpendidikan1 = document.getElementById('idpendidikan1');
        const jurusan1 = document.getElementById('jurusan1');
        const idjk1 = document.getElementById('idjk1');
        const idagama1 = document.getElementById('idagama1');
        const idtempatlahir1 = document.getElementById('idtempatlahir1');
        const tgllahir1 = document.getElementById('tgllahir1');
        const alamat1 = document.getElementById('alamat1');
        const telp1 = document.getElementById('telp1');
        //sosialmedia
        const email1 = document.getElementById('email1');
        const wa1 = document.getElementById('wa1');
        const twitter1 = document.getElementById('twitter1');
        const facebook1 = document.getElementById('facebook1');
        const ig1 = document.getElementById('ig1');
        const line1 = document.getElementById('line1');
        const web1 = document.getElementById('web1');
        const blog1 = document.getElementById('blog1');
        //lain-lain
        const tglmasuk1 = document.getElementById('tglmasuk1');
        const tglkeluar1 = document.getElementById('tglkeluar1');
        const aktif1 = document.getElementById('aktif1');
        const keterangan1 = document.getElementById('keterangan1');
        //images
        const inputfoto1 = document.getElementById('foto1');
        const gambarfoto1 = document.getElementById('gambarfoto1');
        
        //preview foto1
        inputfoto1.addEventListener('change', function(){
            var gbrx="<img class='img-previewfoto1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfoto1' name='img-previewfoto1' style='width: 100%;'>";
            gambarfoto1.innerHTML=gbrx;
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.img-previewfoto1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        function btn_baru_click(){
            bodyx.disabled = false;
            btn_simpan.style.display = 'block';
            btn_baru.style.display = 'none';
            warnax.classList.add('bg-primary');
            warnax.classList.remove('bg-success');
            iconx.classList.add('bi-plus-square');
            iconx.classList.remove('bi-pencil-square');
            judulx.innerHTML = 'Tambah Data';
            inputfoto1.value = '';
            const gbrx="<h5 class='mt-2 small' align='center'>Belum ada image yang diupload<h5>";                        
            gambarfoto1.innerHTML=gbrx;
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

        //aktif
        aktif1xy.addEventListener('change', function(){
           aktif1.value = 'Y'; 
        })
        aktif1xn.addEventListener('change', function(){
           aktif1.value = 'N'; 
        })
        
        const tgllahirx = new Datepicker(tgllahir1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        const tglmasukx = new Datepicker(tglmasuk1, {
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

        btn_baru.addEventListener('click', function () {
            btn_baru_click();            
        });
       
        btn_tambah1.addEventListener('click', function () {
            btn_baru_click();
            id1.value = '0';
            cek1.value = '0';
            ecard1.value = '';        
            nip1.value = '';        
            nuptk1.value = '';        
            nama1.value = '';        
            ModalAdd.show();            
        });

        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
            });
        });
        $('#ModalCari').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
            });
        });

        
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
                ajax: "{{ route('sips01.master.dataguru_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nip', name: 'nip', orderable: true, searchable: true },
                    { data: 'nuptk', name: 'nuptk', orderable: true, searchable: true },
                    { data: 'nama', name: 'nama', orderable: true, searchable: true },
                    { data: 'pangkat.pangkat', name: 'pangkat.pangkat', orderable: true, searchable: true },
                    { data: 'statusprofesi.statusprofesi', name: 'statusprofesi.statusprofesi', orderable: true, searchable: true },
                    { data: 'jabatan', name: 'jabatan', orderable: true, searchable: true },
                    { data: 'jabatan2', name: 'jabatan2', orderable: true, searchable: true },
                    { data: 'statuspegawai.statuspegawai', name: 'statuspegawai.statuspegawai', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
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
                ajax: "{{ route('sips01.master.dataguru_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nip', name: 'nip', orderable: true, searchable: true },
                    { data: 'nuptk', name: 'nuptk', orderable: true, searchable: true },
                    { data: 'nama', name: 'nama', orderable: true, searchable: true },
                    { data: 'pendidikan.pendidikan', name: 'pendidikan.pendidikan', orderable: true, searchable: true },
                    { data: 'jurusan', name: 'jurusan', orderable: true, searchable: true },
                    { data: 'jk.jk', name: 'jk.jk', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'agama.agama', name: 'agama.agama', orderable: true, searchable: true },
                    { data: 'tempatlahir.kabupaten', name: 'tempatlahir.kabupaten', orderable: true, searchable: true },
                    { data: 'tgllahir', name: 'tgllahir', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'alamat', name: 'alamat', orderable: true, searchable: true },
                    { data: 'telp', name: 'telp', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }

        setTimeout(() => {
            sosmed1Datatable = tampil_sosmed1();    
        }, 1000);
        
        function tampil_sosmed1(){
            let i = 1;
            return $('#sosmed1').DataTable({
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
                ajax: "{{ route('sips01.master.dataguru_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nip', name: 'nip', orderable: true, searchable: true },
                    { data: 'nuptk', name: 'nuptk', orderable: true, searchable: true },
                    { data: 'nama', name: 'nama', orderable: true, searchable: true },
                    { data: 'email', name: 'email', orderable: true, searchable: true },
                    { data: 'wa', name: 'wa', orderable: true, searchable: true },
                    { data: 'twitter', name: 'twitter', orderable: true, searchable: true },
                    { data: 'facebook', name: 'facebook', orderable: true, searchable: true },
                    { data: 'ig', name: 'ig', orderable: true, searchable: true },
                    { data: 'line', name: 'line', orderable: true, searchable: true },
                    { data: 'blog', name: 'blog', orderable: true, searchable: true },
                    { data: 'web', name: 'web', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }

        setTimeout(() => {
            lain1Datatable = tampil_lain1();    
        }, 1000);
        
        function tampil_lain1(){
            let i = 1;
            return $('#lain1').DataTable({
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
                ajax: "{{ route('sips01.master.dataguru_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'ecard', name: 'ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nip', name: 'nip', orderable: true, searchable: true },
                    { data: 'nuptk', name: 'nuptk', orderable: true, searchable: true },
                    { data: 'nama', name: 'nama', orderable: true, searchable: true },
                    { data: 'tglmasuk', name: 'tglmasuk', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tglkeluar', name: 'tglkeluar', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'aktif', name: 'aktif', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'foto', name: 'foto', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'keterangan', name: 'keterangan', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }

        tampil_listpangkat();
        //menampilkan combo pangkat
        function tampil_listpangkat(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.dataguru_listpangkat')}}',
                
                success: function(data){				    
                    $("#idpangkat1").html(data);                
                }
            })                    
        }

        btn_cari1.addEventListener('click', function () {
            ModalCari.show();            
        });

        tampil_cari1()
        function tampil_cari1(){
            let i = 1;
            return $('#cari1').DataTable({
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
                ajax: "{{ route('sips01.master.dataguru_showkabupaten') }}",
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

        tampil_liststatusprofesi();
        //menampilkan combo statusprofesi
        function tampil_liststatusprofesi(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.dataguru_liststatusprofesi')}}',
                
                success: function(data){				    
                    $("#idstatusprofesi1").html(data);                
                }
            })                    
        }

        tampil_liststatuspegawai();
        //menampilkan combo statuspegawai
        function tampil_liststatuspegawai(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.dataguru_liststatuspegawai')}}',
                
                success: function(data){				    
                    $("#idstatuspegawai1").html(data);                
                }
            })                    
        }

        tampil_listpendidikan();
        //menampilkan combo pendidikan
        function tampil_listpendidikan(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.dataguru_listpendidikan')}}',
                
                success: function(data){				    
                    $("#idpendidikan1").html(data);                
                }
            })                    
        }
        tampil_listjk();
        //menampilkan combo jk
        function tampil_listjk(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.dataguru_listjk')}}',
                
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
                url   : '{{route('sips01.master.dataguru_listagama')}}',
                
                success: function(data){				    
                    $("#idagama1").html(data);                
                }
            })                    
        }

        tampil_listtempatlahir();
        //menampilkan combo tempatlahir
        function tampil_listtempatlahir(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.dataguru_listtempatlahir')}}',
                
                success: function(data){				    
                    $("#idtempatlahir1").html(data);                
                }
            })                    
        }

        function tampil_dataTable(){   
            identitas1Datatable.ajax.reload(null, false);
            datadiri1Datatable.ajax.reload(null, false);
            sosmed1Datatable.ajax.reload(null, false);
            lain1Datatable.ajax.reload(null, false);
        }

        document.getElementById('show_cari1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikode');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                idtempatlahir1.value = id1;
                ModalCari.hide();
            }
        });
        document.getElementById('show_cari1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_carikabupaten');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                idtempatlahir1.value = id1;
                ModalCari.hide();
            }
        });

        document.getElementById('show_cari1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_caripropinsi');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                idtempatlahir1.value = id1;
                ModalCari.hide();
            }
        });

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });

        function data_simpan(){            
            //identitas
            const id1 = document.getElementById('id1').value;			
            const nama1 = document.getElementById('nama1').value;
            const ecard1 = document.getElementById('ecard1').value;
            const nip1 = document.getElementById('nip1').value;
            const nuptk1 = document.getElementById('nuptk1').value;
            const idpangkat1 = document.getElementById('idpangkat1').value;
            const idstatusprofesi1 = document.getElementById('idstatusprofesi1').value;
            const jabatan1 = document.getElementById('jabatan1').value;
            const jabatan21 = document.getElementById('jabatan21').value;
            const idstatuspegawai1 = document.getElementById('idstatuspegawai1').value;
            //datadiri
            const idpendidikan1 = document.getElementById('idpendidikan1').value;
            const jurusan1 = document.getElementById('jurusan1').value;
            const idjk1 = document.getElementById('idjk1').value;
            const idagama1 = document.getElementById('idagama1').value;
            const idtempatlahir1 = document.getElementById('idtempatlahir1').value;
            const tgllahir1 = document.getElementById('tgllahir1').value;
            const alamat1 = document.getElementById('alamat1').value;
            const telp1 = document.getElementById('telp1').value;
            //sosialmedia
            const email1 = document.getElementById('email1').value;
            const wa1 = document.getElementById('wa1').value;
            const twitter1 = document.getElementById('twitter1').value;
            const facebook1 = document.getElementById('facebook1').value;
            const ig1 = document.getElementById('ig1').value;
            const line1 = document.getElementById('line1').value;
            const web1 = document.getElementById('web1').value;
            const blog1 = document.getElementById('blog1').value;
            //lain-lain
            const tglmasuk1 = document.getElementById('tglmasuk1').value;
            const tglkeluar1 = document.getElementById('tglkeluar1').value;
            const aktif1 = document.getElementById('aktif1').value;
            const keterangan1 = document.getElementById('keterangan1').value;
            //image
            const foto1 =  document.getElementById('foto1').files[0];
            
            let formData = new FormData();
                //identutas
                formData.append('id1', id1);
                formData.append('nama1', nama1);
                formData.append('ecard1', ecard1);
                formData.append('nip1', nip1);
                formData.append('nuptk1', nuptk1);
                formData.append('ecard1', ecard1);
                formData.append('idpangkat1', idpangkat1);
                formData.append('idstatusprofesi1', idstatusprofesi1);
                formData.append('jabatan1', jabatan1);
                formData.append('jabatan21', jabatan21);
                formData.append('idstatuspegawai1', idstatuspegawai1);
                //datadiri
                formData.append('idpendidikan1', idpendidikan1);
                formData.append('jurusan1', jurusan1);
                formData.append('idjk1', idjk1);
                formData.append('idagama1', idagama1);
                formData.append('idtempatlahir1', idtempatlahir1);
                formData.append('tgllahir1', tgllahir1);
                formData.append('alamat1', alamat1);
                formData.append('telp1', telp1);
                //sosmed
                formData.append('email1', email1);
                formData.append('wa1', wa1);
                formData.append('twitter1', twitter1);
                formData.append('facebook1', facebook1);
                formData.append('ig1', ig1);
                formData.append('line1', line1);
                formData.append('web1', web1);
                formData.append('blog1', blog1);
                //lain-lain
                formData.append('tglmasuk1', tglmasuk1);
                formData.append('tglkeluar1', tglkeluar1);
                formData.append('aktif1', aktif1);
                formData.append('keterangan1', keterangan1);
                //image
                formData.append('foto1', foto1);

                fetch("{{ route('sips01.master.dataguru_create') }}", {
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
                    swalsuksestambah(nip1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(nip1);
                });    
        }

        document.getElementById('show_identitas1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });

        document.getElementById('show_datadiri1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });
        
        document.getElementById('show_sosmed1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });
        
        document.getElementById('show_lain1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });
        
        async function data_edit(id1) {
            const url = `{{ url('/sips01/master/dataguruedit') }}/${id1}`;
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

                // Loop data
                for (let i = 0; i < resultData.length; i++) {
                    //identitas
                    document.getElementById('id1').value = resultData[i].id;
                    document.getElementById('ecard1').value = resultData[i].ecard;
                    document.getElementById('nip1').value = resultData[i].nip;
                    document.getElementById('nuptk1').value = resultData[i].nuptk;
                    document.getElementById('nama1').value = resultData[i].nama;
                    document.getElementById('idpangkat1').value = resultData[i].idpangkat;
                    document.getElementById('idstatusprofesi1').value = resultData[i].idstatusprofesi;
                    document.getElementById('jabatan1').value = resultData[i].jabatan;
                    document.getElementById('jabatan21').value = resultData[i].jabatan2;
                    document.getElementById('idstatuspegawai1').value = resultData[i].idstatuspegawai;
                    //datadiri
                    document.getElementById('idpendidikan1').value = resultData[i].idpendidikan;
                    document.getElementById('jurusan1').value = resultData[i].jurusan;
                    document.getElementById('idjk1').value = resultData[i].idjk;
                    document.getElementById('idagama1').value = resultData[i].idagama;
                    document.getElementById('idtempatlahir1').value = resultData[i].idtempatlahir;
                    document.getElementById('tgllahir1').value = resultData[i].tgllahir;
                    document.getElementById('alamat1').value = resultData[i].alamat;
                    document.getElementById('telp1').value = resultData[i].telp;
                    //sosialmedia
                    document.getElementById('email1').value = resultData[i].email;
                    document.getElementById('wa1').value = resultData[i].wa;
                    document.getElementById('twitter1').value = resultData[i].twitter;
                    document.getElementById('facebook1').value = resultData[i].facebook;
                    document.getElementById('ig1').value = resultData[i].ig;
                    document.getElementById('line1').value = resultData[i].line;
                    document.getElementById('web1').value = resultData[i].web;
                    document.getElementById('blog1').value = resultData[i].blog;
                    //lain-lain
                    document.getElementById('tglmasuk1').value = resultData[i].tglmasuk;
                    document.getElementById('tglkeluar1').value = resultData[i].tglkeluar;
                    document.getElementById('aktif1').value = resultData[i].aktif;
                    const aktifValue = document.getElementById('aktif1').value;
                    if (aktifValue === 'Y') {
                        document.getElementById("aktif1xy").checked = true;
                    } else {
                        document.getElementById("aktif1xn").checked = true;
                    }
                    document.getElementById('keterangan1').value = resultData[i].keterangan;
                    //image
                    document.getElementById('foto1').value = '';
                    document.getElementById('foto1x').value = resultData[i].foto;
                    const gbr2 = document.getElementById('foto1x').value;
                    let gbrx = "";
                    if(gbr2){                        
                        var url2="{{ asset('storage/') }}/"+gbr2;
                        gbrx="<img src='"+url2+"' class='img-previewfoto1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfoto1' name='img-previewfoto1' style='width: 100%;'>";
                    }else{
                        gbrx="<h5 class='mt-2 small' align='center'>Belum ada image yang diupload<h5>";
                    }
                    document.getElementById("gambarfoto1").innerHTML=gbrx;
                            
                }

            } catch (error) {
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
        document.getElementById('show_sosmed1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            if (targetButton) {
                await show_pilih1(targetButton);
            }
        });
        document.getElementById('show_lain1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            if (targetButton) {
                await show_pilih1(targetButton);
            }
        });

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
                url   : '{{url('/sips01/master/datagurudestroy')}}/'+id3,
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

        
    });
</script>

@endsection