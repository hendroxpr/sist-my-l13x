@extends('admin.layouts.main')

@section('contents')

@php
    $idtp = session('idtp');    
    $idkelas = session('idkelas');    
@endphp 

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


    <div class="card-header border-0 mb-0 bg-transparent px-0">  
        <div class="row g-3 align-items-center">
            
            <!-- Kolom Kiri: Area Filter Input/Select -->
            <div class="col-md-6">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <label for="idtpx1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Tahun Pelajaran
                    </label>
                    <div class="col-sm-7">
                        <select name="idtpx1" id="idtpx1" value="{{ $idtp }}" class="form-select">
                            <option value="" selected disabled>-- Pilih TP --</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-1 align-items-center">
                    <label for="idkelasx1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Kelas
                    </label>
                    <div class="col-sm-7">
                        <select name="idkelasx1" id="idkelasx1" value="{{ $idkelas }}" class="form-select">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-1 align-items-center">
                    <label for="idkecamatanx1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Wali Kelas
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="walikelasx1" id="walikelasx1" class="form-control" placeholder="Wali Kelas" readonly>
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

        <!--awal tabel-->        
        <div class="card-body" id="headerjudul" style="display: block;">
            <div id="reload" class="table-responsive">
                <table id="data1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                    <thead class="table-light">
                        <tr>
                            <th style="width:10px;">#</th>
                            <th style="width:20px">NIS</th>
                            <th style="width:20px">NISN</th>
                            <th style="width:100px">Nama Siswa</th>
                            <th style="width:100px">DUDI</th>
                            <th style="width:20px">Tgl Mulai</th>
                            <th style="width:20px">Tgl Akhir</th>
                            <th style="width:20px">Lama Magang</th>
                            <th style="width:30px">Keterangan</th>
                            <th style="width:10px">Action</th>
                        </tr>
                    </thead>
                    <tfoot id="show_footer1">
                        <!-- Data footer via JS -->
                    </footer>
                    <tbody id="show_data1">
                        <!-- Data body via JS -->
                    </tbody>
                </table>				
            </div>
        </div> 
        <!--akhir tabel-->

    </div>
    <!-- ModalAdd modal fade-->
    <div class="modal fade" id="ModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                        <i id="iconx"></i>
                        {{-- <i id="iconx" class="bi bi-person-plus-fill"></i> --}}
                        <span id="judulx" class="fw-bold">Tambah Data</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    <fieldset id="bodyx">
                        <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">
                            <!-- ID & Hidden Fields -->
                            <input type="hidden" name="id1" id="id1">
                            <input type="hidden" name="cek1" id="cek1">
                            {{-- <input type="hidden" name="iddatasiswa1" id="iddatasiswa1"> --}}

                            <div class="row mb-1 align-items-center">
                                <style>
                                    #btn_caridatasiswa1 {
                                        /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                        border: 1px solid #ced4da !important; 
                                        color: #6c757d;
                                    }
                                    #btn_caridatasiswa1:hover {
                                        background-color: #f8f9fa;
                                        color: #495057;
                                    }
                                    #btn_caridatasiswa1:focus {
                                        /* Efek shadow biru langit saat fokus */
                                        box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                        border-color: #87cefa !important;
                                    }
                                </style>
                                
                                <label for="iddatasiswa1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Nama Siswa
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="iddatasiswa1" id="iddatasiswa1" class="form-select">
                                            <option value="" selected disabled>-- Pilih Siswa --</option>
                                            {{-- Option akan di-render via JS atau @foreach Blade --}}
                                        </select>
                                        <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caridatasiswa1" name="btn_caridatasiswa1">
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

                            <div class="row mb-1 align-items-center">
                                <label for="ecard1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    ECard
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="ecard1" id="ecard1" class="form-control" placeholder="Ecard" value="{{ old('ecard1') }}" readonly>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="nis1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    NIS
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="nis1" id="nis1" class="form-control" placeholder="NIS" value="{{ old('nis1') }}" readonly>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="nisn1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    NISN
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="nisn1" id="nisn1" class="form-control" placeholder="NISN" value="{{ old('nisn1') }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                
                                <style>
                                    #btn_caridudi1 {
                                        /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                                        border: 1px solid #ced4da !important; 
                                        color: #6c757d;
                                    }
                                    #btn_caridudi1:hover {
                                        background-color: #f8f9fa;
                                        color: #495057;
                                    }
                                    #btn_caridudi1:focus {
                                        /* Efek shadow biru langit saat fokus */
                                        box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                                        border-color: #87cefa !important;
                                    }
                                </style>
                                
                                <label for="iddudi1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    DUDI
                                </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <select name="iddudi1" id="iddudi1" class="form-select">
                                            <option value="" selected disabled>-- Pilih DUDI --</option>
                                            {{-- Option akan di-render via JS atau @foreach Blade --}}
                                        </select>
                                        <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_caridudi1" name="btn_caridudi1">
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

                            <div class="row mb-1 align-items-center">
                                <label for="alamat1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Alamat
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="alamat1" id="alamat1" class="form-control" placeholder="Alamat" value="{{ old('alamat1') }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="kegiatan1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Kegiatan
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="kegiatan1" id="kegiatan1" class="form-control" placeholder="Kegiatan" value="{{ old('kegiatan1') }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="tglmulai1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Tgl Mulai
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="tglmulai1" id="tglmulai1" maxlength="10" class="form-control" placeholder="tgl akhir" value="{{ old('tglmulai1') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="tglakhir1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Tgl Akhir
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="tglakhir1" id="tglakhir1" maxlength="10" class="form-control" placeholder="tgl akhir" value="{{ old('tglakhir1') }}" autocomplete="off">
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="lama1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Lama Magang
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="lama1" id="lama1" maxlength="50" class="form-control" placeholder="lama magang" value="{{ old('lama1') }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="keterangan1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                    Keterangan
                                </label>
                                <div class="col-sm-9">
                                    <input type="search" name="keterangan1" id="keterangan1" maxlength="50" class="form-control" placeholder="keterangan" value="{{ old('keterangan1') }}" autocomplete="off">
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
                            <button type="button" id="btn_baru" class="btn btn-outline-info">
                                <i class="bi bi-plus-lg me-1"></i> Baru
                            </button>
                            <button type="button" id="btn_simpan" class="btn btn-outline-primary">
                                <i class="bi bi-floppy me-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- end ModalAdd -->

    <!-- ModalCaridatasiswa modal fade-->
        <div class="modal fade" id="ModalCaridatasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <div id="reloadCaridatasiswa" class="table-responsive">
                                    <table id="caridatasiswa1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:20px">ECard</th>							
                                                <th style="width:20px">NIS</th>							
                                                <th style="width:20px">NISN</th>							
                                                <th style="width:200px">Nama Siswa</th>
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footercaridatasiswa1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_caridatasiswa1">
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
    <!-- end ModalCaridatasiswa -->

    <!-- ModalCaridudi modal fade-->
        <div class="modal fade" id="ModalCaridudi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
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
                                <div id="reloadCaridudi" class="table-responsive">
                                    <table id="caridudi1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                                        <thead class="table-light">
                                            <tr>
                                                <th style="width:10px;">#</th>                            
                                                <th style="width:200px">DUDI</th>							
                                                <th style="width:200px">Alamat</th>							
                                                <th style="width:200px">Kegiatan</th>							
                                            </tr>
                                        </thead>
                                        <tfoot id="show_footercaridudi1">
                                            <!-- Data footer via JS -->
                                        </footer>
                                        <tbody id="show_caridudi1">
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
    <!-- end ModalCaridudi -->

    <!-- khusus menyimpan data yang akan didestroy -->
    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	
    

</div>

<script type="text/javascript">
    
    let data1Datatable;
    let caridatasiswa1Datatable;
    let caridudi1Datatable;
    let listkelasx1Datatable;
    let listkelas1Datatable;

    document.addEventListener("DOMContentLoaded", function() {
        
        //persiapan button dan modal
        const ModalAdd = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalAdd'));
        const ModalCaridatasiswa = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCaridatasiswa'));
        const ModalCaridudi = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCaridudi'));
        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        const btn_caridatasiswa1 = document.getElementById('btn_caridatasiswa1');
        const btn_caridudi1 = document.getElementById('btn_caridudi1');
        
        //persiapan data
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const iddatasiswa1 = document.getElementById('iddatasiswa1');        
        const idtpx1 = document.getElementById('idtpx1');        
        const idkelasx1 = document.getElementById('idkelasx1');        
        const ecard1 = document.getElementById('ecard1');        
        const nis1 = document.getElementById('nis1');        
        const nisn1 = document.getElementById('nisn1');        
        const keterangan1 = document.getElementById('keterangan1');                        
        const iddudi1 = document.getElementById('iddudi1');                        
        const alamat1 = document.getElementById('alamat1');                        
        const lama1 = document.getElementById('lama1');                        
        const tglmulai1 = document.getElementById('tglmulai1');        
        const tglakhir1 = document.getElementById('tglakhir1');                        
        const kegiatan1 = document.getElementById('kegiatan1');                        

        function btn_baru_click(){
            bodyx.disabled = false;
            btn_simpan.style.display = 'block';
            btn_baru.style.display = 'none';
            warnax.classList.add('bg-primary');
            warnax.classList.remove('bg-success');
            iconx.classList.add('bi-plus-square');
            iconx.classList.remove('bi-pencil-square');
            judulx.innerHTML = 'Tambah Data';
        }

        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalCaridatasiswa').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        $('#ModalCaridudi').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
        });
        
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

        btn_baru.addEventListener('click', function () {
            btn_baru_click();            
        });
       
        btn_tambah1.addEventListener('click', function () {
            btn_baru_click();
            id1.value = '0';
            cek1.value = '';
            ecard1.value = '';        
            nis1.value = '';        
            tglmulai1.value = '';        
            tglakhir1.value = '';        
            nisn1.value = '';        
            keterangan1.value = '';        
            iddudi1.value = '';        
            iddatasiswa1.value = '';        
            alamat1.value = '';        
            kegiatan1.value = '';        
            lama1.value = '';        
            ModalAdd.show();            
        });

        const tglmulai1x = new Datepicker(tglmulai1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        const tglakhir1x = new Datepicker(tglakhir1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        btn_caridatasiswa1.addEventListener('click', function () {
            ModalCaridatasiswa.show();            
        });
        btn_caridudi1.addEventListener('click', function () {
            ModalCaridudi.show();            
        });

        
        setTimeout(() => {
            data1Datatable = tampil_data1();    
            caridatasiswa1Datatable = tampil_caridatasiswa1();    
            caridudi1Datatable = tampil_caridudi1();    
        }, 1000);
        
        function tampil_data1(){
            let i = 1;
            return new DataTable('#data1', {
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
                ajax: {
                    url: "{{ route('sips01.transaksi.magang_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex', orderable: false, searchable: false,className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'dudi.dudi', name: 'dudi.dudi', orderable: true, searchable: true },
                    { data: 'tglmulai', name: 'tglmulai', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tglakhir', name: 'tglakhir', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'lama', name: 'lama', orderable: true, searchable: true },
                    { data: 'keterangan', name: 'keterangan', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }

        function tampil_caridatasiswa1(){
            let i = 1;
            return new DataTable('#caridatasiswa1', {
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                // buttons : [ 
                //     {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                //     {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                //     {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                //     {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                //     {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                //     {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                // dom: "<'row mb-3 align-items-center'" +
                //             "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                //             "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                //             "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                //         ">" +
                //         "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                //         "<'row mt-3 align-items-center'" +
                //             "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                //             "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                //         ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,                
                // Konfigurasi AJAX versi Vanilla JS bawaan DataTables
                ajax: {
                    url: "{{ route('sips01.transaksi.magang_showdatasiswa') }}",
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
                ]
            });
        }

        function tampil_caridudi1(){
            let i = 1;
            return new DataTable('#caridudi1', {
                responsive : true,
                // destroy: true,
                retrieve: true,
                autoWidth : true,
                stateSave: true,
                // buttons : [ 
                //     {extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                //     {extend: 'copy', className: 'btn btn-sm btn-secondary'}, 
                //     {extend: 'csv', className: 'btn btn-sm btn-secondary'},
                //     {extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title:'{{ $caption }}', className: 'btn btn-sm btn-warning'},
                //     {extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success'}, 
                //     {extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info'}, ],  
                // dom: "<'row mb-3 align-items-center'" +
                //             "<'col-12 col-md-3'l>" +     // l = Entries per page (Kiri)
                //             "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + // B = Buttons (Tengah)
                //             "<'col-12 col-md-3 text-md-end'f>" + // f = Search (Kanan)
                //         ">" +
                //         "<'row'<'col-sm-12'tr>>" + // t = Table, r = Processing info
                //         "<'row mt-3 align-items-center'" +
                //             "<'col-sm-12 col-md-5'i>" + // i = Table information (Kiri bawah)
                //             "<'col-sm-12 col-md-7'p>" + // p = Pagination (Kanan bawah)
                //         ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('sips01.transaksi.magang_showdudi') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'dudi', name: 'dudi', orderable: true, searchable: true },
                    { data: 'alamat', name: 'alamat', orderable: true, searchable: true },
                    { data: 'kegiatan', name: 'kegiatan', orderable: true, searchable: true },
                ]
            });
        }

        document.getElementById('show_caridatasiswa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_cariecard, .item_carinis, .item_carinisn, .item_carinamalengkap');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var ecard1 = targetButton.getAttribute('data2');
                var nis1 = targetButton.getAttribute('data3');
                var nisn1 = targetButton.getAttribute('data4');
                var namalengkap1 = targetButton.getAttribute('data5');
                var html = '';
                html += '<option value="' + id1 + '">' + namalengkap1 + '</option>';
                document.getElementById("iddatasiswa1").innerHTML = html;
                document.getElementById("ecard1").value = ecard1;
                document.getElementById("nis1").value = nis1;
                document.getElementById("nisn1").value = nisn1;
                
                ModalCaridatasiswa.hide();
            }
        });

        document.getElementById('show_caridudi1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_caridudi, .item_carialamat, .item_carikegiatan');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var dudi1 = targetButton.getAttribute('data2');
                var alamat1 = targetButton.getAttribute('data3');
                var kegiatan1 = targetButton.getAttribute('data4');
                var html = '';
                html += '<option value="' + id1 + '">' + dudi1 + '</option>';
                document.getElementById("iddudi1").innerHTML = html;
                document.getElementById("alamat1").value = alamat1;
                document.getElementById("kegiatan1").value = kegiatan1;
                ModalCaridudi.hide();
            }
        });
        
        //menampilkan combo tpx1
        function tampil_listtpx1(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.transaksi.magang_listtp')}}',
                
                success: function(data){		    
                    idtpx1.innerHTML = data;
                    idtpx1.value = {{ $idtp }};
                }
            })
        }
        //menampilkan combo kelasx1
        function tampil_listkelasx1(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.transaksi.magang_listkelas')}}',
                
                success: function(data){		    
                    idkelasx1.innerHTML = data;
                    idkelasx1.value = {{ $idkelas }};
                    
                }
            })
        }
       
        tampil_listtpx1();
        setInterval(() => {
            idtpx1.change();
            kirim_syarat();
        }, 500);

        tampil_listkelasx1();
        setInterval(() => {
            idkelasx1.change();
            kirim_syarat();
        }, 500);
        
        setTimeout(() => {
            load_walikelas();
        }, 2000);

        idtpx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    load_walikelas();
                }, 100);
            }, 100);
        });

        idkelasx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    load_walikelas();
                    
                }, 100);
            }, 100);
        });

        async function load_walikelas() {
            document.getElementById('walikelasx1').value = '';
            const url = `{{ url('/sips01/transaksi/magangshowwali') }}`;
            
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
                    document.getElementById('walikelasx1').value = resultData[i].dataguru.nama;
                   
                }
            } catch (error) {
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    // swalgagaltambah('Gagal memuat data pengguna.');
                }
            }
        }
        
        function kirim_syarat(){
            const idtp1= document.getElementById('idtpx1').value;
            const idkelas1= document.getElementById('idkelasx1').value;
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);

            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.transaksi.magang_kirimsyarat')}}',
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },				 				
                success : function(formData){
                    tampil_dataTable();                   
                    },
                    
                error : function(formData){
                    },
            });

           
        }

        function tampil_dataTable(){   
            data1Datatable.ajax.reload(null, false);
            caridatasiswa1Datatable.ajax.reload(null, false);
            caridudi1Datatable.ajax.reload(null, false);
        }

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });

        function data_simpan(){            
            const id1= document.getElementById('id1').value;			
            const iddatasiswa1= document.getElementById('iddatasiswa1').value;	
            const iddudi1= document.getElementById('iddudi1').value;	
            const tglmulai1= document.getElementById('tglmulai1').value;
            const tglakhir1= document.getElementById('tglakhir1').value;
            const lama1= document.getElementById('lama1').value;
            const keterangan1= document.getElementById('keterangan1').value;
            const nama1 = document.getElementById('iddatasiswa1').options[document.getElementById('iddatasiswa1').selectedIndex].text;
            if(iddatasiswa1==''){
                swalgagaltambah('data siswa belum diisi')
                return;
            }
            if(iddudi1==''){
                swalgagaltambah('data dudi belum diisi')
                return;
            }
            
            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('iddudi1', iddudi1);
                formData.append('tglmulai1', tglmulai1);
                formData.append('tglakhir1', tglakhir1);
                formData.append('lama1', lama1);
                formData.append('keterangan1', keterangan1);
            
                fetch("{{ route('sips01.transaksi.magang_create') }}", {
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
                    swalsuksestambah(nama1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(nama1);
                });    
        }

        document.getElementById('show_data1').addEventListener('click', async function(e) {
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
            const url = `{{ url('/sips01/transaksi/magangedit') }}/${id1}`;
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
                var html1;
                var html2;
                // Loop data
                for (let i = 0; i < resultData.length; i++) {
                    // 1. Mengisi Nilai Input Text & Hidden (Menggantikan .val())
                    document.getElementById('id1').value = resultData[i].id;
                    document.getElementById('iddatasiswa1').value = resultData[i].iddatasiswa;
                    document.getElementById('ecard1').value = resultData[i].datasiswa.ecard;
                    document.getElementById('nis1').value = resultData[i].datasiswa.nis;
                    document.getElementById('nisn1').value = resultData[i].datasiswa.nisn;
                    document.getElementById('iddudi1').value = resultData[i].iddudi;
                    document.getElementById('alamat1').value = resultData[i].dudi.alamat;
                    document.getElementById('kegiatan1').value = resultData[i].dudi.kegiatan;
                    document.getElementById('tglmulai1').value = resultData[i].tglmulai;
                    document.getElementById('tglakhir1').value = resultData[i].tglakhir;
                    document.getElementById('lama1').value = resultData[i].lama;
                    document.getElementById('keterangan1').value = resultData[i].keterangan;

                    html1 = '<option value="' + resultData[i].iddatasiswa + '">' + resultData[i].datasiswa.namalengkap + '</option>';
                    document.getElementById("iddatasiswa1").innerHTML = html1;
                    html2 = '<option value="' + resultData[i].iddudi + '">' + resultData[i].dudi.dudi + '</option>';
                    document.getElementById("iddudi1").innerHTML = html2;
                    
                }

            } catch (error) {
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    swalgagaltambah('Gagal memuat data pengguna.');
                }
            }
        }

        document.getElementById('show_data1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_destroy');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
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
                url   : '{{url('/sips01/transaksi/magangdestroy')}}/'+id3,
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
                timer:1000,
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

        
    });
</script>

@endsection