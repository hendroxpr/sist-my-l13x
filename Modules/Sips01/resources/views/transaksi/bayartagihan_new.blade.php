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

<style>
    tr.sudah-app td {
        background-color: rgb(255, 126, 126) !important;
        color: #000000 !important;
        --bs-table-bg: rgb(255, 126, 126) !important; /* Untuk kompatibilitas penuh dengan Bootstrap 5 */
    }
    tr.sudah-lapor td {
        background-color: rgb(141, 255, 141) !important;
        color: #000000 !important;
        --bs-table-bg: rgb(141, 255, 141) !important; /* Untuk kompatibilitas penuh dengan Bootstrap 5 */
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


    <div class="card-header border-0 mb-0 bg-transparent px-0">  
        <div class="row g-3 align-items-center">
            
            <!-- Kolom Kiri: Area Filter Input/Select -->
            <div class="col-md-4">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <label for="idtpx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        Tahun Pelajaran
                    </label>
                    <div class="col-sm-7">
                        <select name="idtpx1" id="idtpx1" value="{{ $idtp }}" class="form-select">
                            <option value="" selected disabled>-- Pilih TP --</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-1 align-items-center">
                    <label for="idkelasx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        Kelas
                    </label>
                    <div class="col-sm-7">
                        <select name="idkelasx1" id="idkelasx1" value="{{ $idkelas }}" class="form-select">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-1 align-items-center">
                    <label for="idkecamatanx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        Wali Kelas
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="walikelasx1" id="walikelasx1" class="form-control" placeholder="Wali Kelas" readonly>
                    </div>
                </div>

                <style>
                    #btn_carix1 {
                        /* Warna garis pinggir abu-abu bawaan Bootstrap (gray-400) */
                        border: 1px solid #ced4da !important; 
                        color: #6c757d;
                    }
                    #btn_carix1:hover {
                        background-color: #f8f9fa;
                        color: #495057;
                    }
                    #btn_carix1:focus {
                        /* Efek shadow biru langit saat fokus */
                        box-shadow: 0 0 0 0.25rem rgba(135, 206, 250, 0.5) !important;
                        border-color: #87cefa !important;
                    }
                </style>

                <div class="row mb-1 align-items-center">
                    <label for="cariidx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        ID
                    </label>
                    <div class="col-sm-7">
                        <div class="input-group">
                            <input type="search" name="cariidx1" id="cariidx1" class="form-control" placeholder="id">
                            <button class="btn btn-outline-secondary rounded-1 btn-border-1 shadow-none" type="button" id="btn_cariidx1" name="btn_cariidx1">
                                <i class="bi bi-search" style="font-size: 16px;"></i>
                            </button>
                        </div>
                        
                    </div>
                </div>

            </div>

            <div class="col-md-4 mt-0">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <input type="hidden" name="iddatasiswax1" id="iddatasiswax1">
                    <label for="ecardx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        ECard
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="ecardx1" id="ecardx1" class="form-control" placeholder="ecard" readonly>
                    </div>
                </div>

                <div class="row mb-1 align-items-center">
                    <label for="nisx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        NIS
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="nisx1" id="nisx1" class="form-control" placeholder="nis" readonly>
                    </div>
                </div>
                
                <div class="row mb-1 align-items-center">
                    <label for="nisnx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        NISN
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="nisnx1" id="nisnx1" class="form-control" placeholder="nisn" readonly>
                    </div>
                </div>
                <div class="row mb-1 align-items-center">
                    <label for="namalengkapx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        Nama Lengkap
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="namalengkapx1" id="namalengkapx1" class="form-control" placeholder="nama lengkap" readonly>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Area Tombol Aksi Mandiri -->
            <div class="col-md-4 mt-0">
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
                    <button id="btn_print1" name="btn_print1" type="button" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i class="bi bi-printer-fill fs-6 fw-bold"></i> Print
                    </button>
                    <button id="btn_import1" name="btn_import1" type="button" class="btn btn-warning d-inline-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-arrow-down-fill fs-6 fw-bold"></i> Import
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
                            <th style="width:20px">Kelas</th>
                            <th style="width:20px">TP</th>
                            <th style="width:20px">Tgl Transaksi</th>
                            <th style="width:200px">Jenis Tagihan</th>
                            <th style="width:100px">Nomor Bukti</th>
                            <th style="width:50px">Target Bayar</th>
                            <th style="width:50px">Sudah Bayar</th>
                            <th style="width:50px">Bayar</th>
                            <th style="width:20px">Kurang Bayar</th>
                            {{-- <th style="width:20px">Untuk Bulan</th> --}}
                            <th style="width:100px">Keterangan</th>
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
                            
                            <div class="row mb-1 align-items-center">
                                <label for="tgltransaksi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Tanggal Transaksi
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="tgltransaksi1" id="tgltransaksi1" class="form-control" placeholder="tgl transaksi" value="{{ old('tgltransaksi1') }}">
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="idjenistagihan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Jenis Tagihan
                                </label>
                                <div class="col-sm-8">
                                    <select name="idjenistagihan1" id="idjenistagihan1"class="form-select">
                                        <option value="" selected disabled>-- Pilih Jenis Tagihan --</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="iddataguru1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Bendahara Penerima
                                </label>
                                <div class="col-sm-8">
                                    <select name="iddataguru1" id="iddataguru1"class="form-select">
                                        <option value="" selected disabled>-- Pilih Bendahara --</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="nomorbukti1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nomor Bukti
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="nomorbukti1" id="nomorbukti1" class="form-control" placeholder="nomorbukti" value="{{ old('nomorbukti1') }}" readonly>
                                    <input name="nomorb11" id="nomorb11" type="hidden">
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="targetbayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Target Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="targetbayar1" id="targetbayar1" class="form-control" placeholder="target bayar" value="{{ old('targetbayar1') }}">
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="sudahbayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Sudah Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="sudahbayar1" id="sudahbayar1" class="form-control" placeholder="sudah bayar" value="{{ old('sudahbayar1') }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="bayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="bayar1" id="bayar1" class="form-control" placeholder="bayar" value="{{ old('bayar1') }}"  autofocus>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="kurangbayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Kurang Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="kurangbayar1" id="kurangbayar1" class="form-control" placeholder="kurang bayar" value="{{ old('kurangbayar1') }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="idbulan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Untuk Bulan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="idbulan1" id="idbulan1" class="form-control" placeholder="kurang bayar" value="{{ old('idbulan1') }}" readonly>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="keterangan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Keterangan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="keterangan1" id="keterangan1" maxlength="50" class="form-control" placeholder="keterangan" value="{{ old('keterangan1') }}">
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

    <!-- ModalImport modal fade-->
        <div class="modal fade" id="ModalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-warning text-white">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-database-down" style="font-size: 20px;"></i>
                            <span class="fw-bold"> Import Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();" autocomplete="off">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">
                                <div class="row mb-1 align-items-center">
                                    <label for="tpimport1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        TP
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="tpimport1" id="tpimport1" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label for="kelasimport1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Kelas
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="kelasimport1" id="kelasimport1" class="form-control" disabled>
                                    </div>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label for="keteranganimport1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Keterangan
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="keteranganimport1" id="keteranganimport1" maxlength="50" placeholder="keterangan" class="form-control" autofocus>
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
                                <button type="button" id="btn_import11" class="btn btn-outline-primary"><i class="i bi-file-earmark-arrow-down me-1"></i> Import Data</button>
                            </div>
                        </div>
                           
                       
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalImport -->

    <!-- khusus menyimpan data yang akan didestroy -->
    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	
    

</div>

<script type="text/javascript">
    
    let data1Datatable;
    let listkelasx1Datatable;
    let listkelas1Datatable;

    document.addEventListener("DOMContentLoaded", function() {
        
        //persiapan button dan modal
        const ModalAdd = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalAdd'));
        const ModalImport = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalImport'));
        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        const btn_import1 = document.getElementById('btn_import1');
        const btn_import11 = document.getElementById('btn_import11');
        const btn_print1 = document.getElementById('btn_print1');
        
        //persiapan data
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const iddatasiswa1 = document.getElementById('iddatasiswa1');        
        const idtpx1 = document.getElementById('idtpx1');        
        const idkelasx1 = document.getElementById('idkelasx1');        
        const idkelas1 = document.getElementById('idkelas1');        
        const ecard1 = document.getElementById('ecard1');        
        const nis1 = document.getElementById('nis1');        
        const nisn1 = document.getElementById('nisn1');        
        const namalengkap1 = document.getElementById('namalengkap1');        
        const keterangan1 = document.getElementById('keterangan1');        
        const tpimport1 = document.getElementById('tpimport1');        
        const kelasimport1 = document.getElementById('kelasimport1');        
        const keteranganimport1 = document.getElementById('keteranganimport1');        

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
        $('#ModalImport').on('shown.bs.modal', function () {
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
            cek1.value = '0';
            ecard1.value = '';        
            nis1.value = '';        
            namalengkap1.value = '';        
            nisn1.value = '';        
            keterangan1.value = '';        
            ModalAdd.show();            
        });

        btn_print1.addEventListener('click', function (e) {
            e.preventDefault();
            window.open('{{ route('sips01.master.siswakelas_print') }}');
        });

        btn_import1.addEventListener('click', function () {
            ModalImport.show(); 
        });

        btn_import11.addEventListener('click', function () {
            data_import();  
        });

        function data_import(){            
            const idtp1= document.getElementById('idtpx1').value;	
            const idkelas1= document.getElementById('idkelasx1').value;	
            const keterangan1= document.getElementById('keteranganimport1').value;
            const kelas1 = idkelasx1.options[idkelasx1.selectedIndex].text;
            
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('keterangan1', keterangan1);
            
                fetch("{{ route('sips01.master.siswakelas_import') }}", {
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
                    ModalImport.hide(); 
                    swalsuksesimport(kelas1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagalimport(kelas1);
                });    
        }

        function data_importx(){            
            const idtp1= document.getElementById('idtpx1').value;	
            const idkelas1= document.getElementById('idkelasx1').value;	
            const keterangan1= document.getElementById('keteranganimport1').value;
            const kelas1 = idkelasx1.options[idkelasx1.selectedIndex].text;

            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('keterangan1', keterangan1);
            
                fetch("{{ route('sips01.master.siswakelas_import') }}", {
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
                    ModalImport.hide();
                    swalsuksesimport(kelas1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagalimport(kelas1);
                });    
        }
        
        setTimeout(() => {
            data1Datatable = tampil_data1();    
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
                    url: "{{ route('sips01.transaksi.bayartagihan_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap' },
                    { data: 'kelas', name: 'kelas', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'tp.tp', name: 'tp.tp', orderable: true, searchable: true },
                    { data: 'tgltransaksi', name: 'tgltransaksi', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'jenistagihan.jenistagihan', name: 'jenistagihan.jenistagihan', orderable: true, searchable: true },
                    { data: 'nomorbukti1', name: 'nomorbukti1', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'targetbayar', name: 'targetbayar', orderable: false, searchable: false, className: 'dt-right' },
                    { data: 'sudahbayar', name: 'sudahbayar', orderable: false, searchable: false, className: 'dt-right' },
                    { data: 'bayar', name: 'bayar', orderable: false, searchable: false, className: 'dt-right' },
                    { data: 'kurangbayar', name: 'kurangbayar', orderable: false, searchable: false, className: 'dt-right' },
                    { data: 'keterangan', name: 'keterangan', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }
        
        //menampilkan combo tpx1
        function tampil_listtpx1(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.siswakelas_listtp')}}',
                
                success: function(data){		    
                    idtpx1.innerHTML = data;
                    idtpx1.value = {{ $idtp }};
                    tpimport1.value = idtpx1.options[idtpx1.selectedIndex].text;
                }
            })
        }
        //menampilkan combo kelasx1
        function tampil_listkelasx1(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.siswakelas_listkelas')}}',
                
                success: function(data){		    
                    idkelasx1.innerHTML = data;
                    idkelasx1.value = {{ $idkelas }};
                    idkelas1.innerHTML = data;
                    idkelas1.value = {{ $idkelas }};
                    kelasimport1.value = idkelasx1.options[idkelasx1.selectedIndex].text;
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
                    tpimport1.value = idtpx1.options[idtpx1.selectedIndex].text;
                }, 100);
            }, 100);
        });

        idkelasx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    load_walikelas();
                    document.getElementById('idkelas1').value = document.getElementById('idkelasx1').value;
                    kelasimport1.value = idkelasx1.options[idkelasx1.selectedIndex].text;
                }, 100);
            }, 100);
        });

        async function load_walikelas() {
            document.getElementById('walikelasx1').value = '';
            const url = `{{ url('/sips01/master/siswakelasshowwali') }}`;
            
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
                url    : '{{route('sips01.master.siswakelas_kirimsyarat')}}',
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
        }

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });

        function data_simpan(){            
            const id1= document.getElementById('id1').value;			
            const idtp1= document.getElementById('idtpx1').value;	
            const idkelas1= document.getElementById('idkelas1').value;	
            const iddatasiswa1= document.getElementById('iddatasiswa1').value;	
            const namalengkap1= document.getElementById('namalengkap1').value;
            const keterangan1= document.getElementById('keterangan1').value;

            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('keterangan1', keterangan1);
            
                fetch("{{ route('sips01.master.siswakelas_create') }}", {
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
            const url = `{{ url('/sips01/master/siswakelasedit') }}/${id1}`;
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
                    // 1. Mengisi Nilai Input Text & Hidden (Menggantikan .val())
                    document.getElementById('id1').value = resultData[i].id;
                    document.getElementById('idkelas1').value = resultData[i].idkelas;
                    document.getElementById('iddatasiswa1').value = resultData[i].iddatasiswa;
                    document.getElementById('ecard1').value = resultData[i].datasiswa.ecard;
                    document.getElementById('nis1').value = resultData[i].datasiswa.nis;
                    document.getElementById('nisn1').value = resultData[i].datasiswa.nisn;
                    document.getElementById('namalengkap1').value = resultData[i].datasiswa.namalengkap;
                    document.getElementById('keterangan1').value = resultData[i].keterangan;
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
                url   : '{{url('/sips01/master/siswakelasdestroy')}}/'+id3,
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