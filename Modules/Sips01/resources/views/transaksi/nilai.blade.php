@extends('admin.layouts.main')

@section('contents')

@php
    $idtp = session('idtp');    
    $idkelas = session('idkelas');    
    $idmapel = session('idmapel');    
    $semester = session('semester');    
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


    <div class="card-header border-0 mb-0 bg-transparent px-0">  
        <div class="row g-3 align-items-end">
            
            <!-- Kolom Kiri: Area Filter Input/Select -->
            <div class="col-md-3">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <label for="idtpx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        TP
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
                    <label for="walikelasx1" class="col-sm-5 col-form-label text-sm-end fw-semibold">
                        Wali Kelas
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="walikelasx1" id="walikelasx1" class="form-control" placeholder="Wali Kelas" readonly>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <label for="idmapelx1" class="col-sm-2 col-form-label text-sm-end fw-semibold">
                        Mapel
                    </label>
                    <div class="col-sm-10">
                        <select name="idmapelx1" id="idmapelx1" value="{{ $idmapel }}" class="form-select">
                            <option value="" selected disabled>-- Pilih Mapel --</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-1 align-items-center">
                    <label for="semesterx1" class="col-sm-2 col-form-label text-sm-end fw-semibold">
                        Semester
                    </label>
                    <div class="col-sm-10">
                        <select name="semesterx1" id="semesterx1" value="{{ $semester }}" class="form-select">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="21">Nilai Ujian Sekolah</option>
                            <option value="22">Nilai Sekolah</option>
                            <option value="23">Nilai Ujian Nasional</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-1 align-items-center">
                    
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
                    <button id="btn_tambah1" name="btn_tambah1" type="button" class="btn btn-primary d-none align-items-center gap-2">
                        <i class="bi bi-plus-lg fs-6 fw-bold"></i> Tambah
                    </button>
                    
                    <button id="btn_importnilai1" name="btn_importnilai1" type="button" class="btn btn-warning text-white d-inline-flex align-items-center gap-2" style="height: 36px;">
                        <i class="bi bi-file-earmark-excel" style="font-size: 18px;"></i> Import Nilai
                    </button>
                    <button id="btn_importabsensi1" name="btn_importabsensi1" type="button" class="btn btn-info text-white d-inline-flex align-items-center gap-2" style="height: 36px;">
                        <i class="bi bi-file-earmark-excel" style="font-size: 18px;"></i> Import Absensi
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
                            <th style="width:20px">Ecard</th>
                            <th style="width:20px">NIS</th>
                            <th style="width:20px">NISN</th>
                            <th style="width:100px">Nama Siswa</th>
                            <th style="width:20px">Nilai</th>
                            <th style="width:20px">KKM</th>
                            <th style="width:10px">Sakit</th>
                            <th style="width:10px">Izin</th>
                            <th style="width:10px">Alpa</th>
                            <th style="width:10px">Status<br>Naik Kls</th>
                            <th style="width:10px">Ke/di<br>Kelas</th>
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
    
    <!-- ModalImport modal fade-->
        <div class="modal fade" id="ModalImport" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-warning text-white" id="modal_header1" name="modal_header1">
                        <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                            <i class="bi bi-file-earmark-excel" style="font-size: 20px;"></i>
                            <span class="fw-bold" id="modal_judul1" name="modal_judul1">Import Data</span>
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <!-- Form -->
                    <form id="formSimpan" action="" method="POST" enctype="multipart/form-data" onsubmit="event.preventDefault();" autocomplete="off">
                        @csrf
                        <fieldset id="bodyx">
                            <div class="modal-body p-1" id="bodyAdd" name="bodyAdd">
                                <input type="hidden" id="nama_tombol1" name="nama_tombol1">
                            
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
                                    <label for="idtp1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                        TP
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select name="idtp1" id="idtp1" class="form-select">
                                                <option value="" selected disabled>-- Pilih TP --</option>
                                                {{-- Option akan di-render via JS atau @foreach Blade --}}
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-1 align-items-center" id="div_mapel1" name="div_mapel1">
                                    <label for="idmapel1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                        Mapel
                                    </label>
                                    <div class="col-sm-9">
                                        <div class="input-group">
                                            <select name="idmapel1" id="idmapel1" class="form-select">
                                                <option value="" selected disabled>-- Pilih Mapel --</option>
                                                {{-- Option akan di-render via JS atau @foreach Blade --}}
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-1 align-items-center">
                                    <label for="semester1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                                        Semester
                                    </label>
                                    <div class="col-sm-9">
                                        <select name="semester1" id="semester1" value="" class="form-select">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="21">Nilai Ujian Sekolah</option>
                                            <option value="22">Nilai Sekolah</option>
                                            <option value="23">Nilai Ujian Nasional</option>
                                        </select>
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
                    <div class="modal-header bg-primary text-white">
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
                                <button type="button" id="btn_printnilai1" class="btn btn-outline-primary"><i class="i bi-printer-fill me-1"></i> Print Data</button>
                            </div>
                        </div>

                       
                    </form>

                </div>
            </div>
        </div>
        <!-- end ModalPrint -->

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
        const ModalImport = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalImport'));
        const ModalPrint = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalPrint'));
        
        //persiapan data
        const idtpx1 = document.getElementById('idtpx1');        
        const idtp1 = document.getElementById('idtp1');        
        const idkelasx1 = document.getElementById('idkelasx1');        
        const idmapelx1 = document.getElementById('idmapelx1');        
        const idmapel1 = document.getElementById('idmapel1');        
        const modal_header1 = document.getElementById('modal_header1');        
        const modal_judul1 = document.getElementById('modal_judul1');        
        const nama_tombol1 = document.getElementById('nama_tombol1');        
        const div_mapel1 = document.getElementById('div_mapel1');        
        const btn_importnilai1 = document.getElementById('btn_importnilai1');        
        const btn_importabsensi1 = document.getElementById('btn_importabsensi1');        

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
        
        setTimeout(() => {
            data1Datatable = tampil_data1();    
        }, 1000);
        
        function tampil_data1(){
            let i = 1;
            return $('#data1').DataTable({
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
                ajax: "{{ route('sips01.transaksi.nilai_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'datasiswa.ecard', name: 'datasiswa.ecard', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'nilai', name: 'nilai', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kkm', name: 'kkm', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'sakit', name: 'sakit', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'izin', name: 'izin', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'alpa', name: 'alpa', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'status', name: 'status', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kelas', name: 'kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'action2', name: 'action2', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.nilai < data?.kkm) {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }
        
        //menampilkan combo tpx1
        function tampil_listtpx1(){
            fetch('{{ route('sips01.transaksi.nilai_listtp') }}', {
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
                    idtpx1.value = {{ $idtp }};
                    idtp1.innerHTML = data;
                    idtp1.value = {{ $idtp }};
                    
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }

        //menampilkan combo kelasx1
        function tampil_listkelasx1(){
            fetch('{{ route('sips01.transaksi.nilai_listkelas') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idkelasx1) {
                    idkelasx1.innerHTML = data;
                    idkelasx1.value = {{ $idkelas }};
                    
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }

        //menampilkan combo mapelx1
        function tampil_listmapelx1(){
            fetch('{{ route('sips01.transaksi.nilai_listmapel') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idmapelx1) {
                    idmapelx1.innerHTML = data;
                    idmapel1.innerHTML = data;
                    idmapelx1.value = {{ $idmapel }};
                    idmapel1.value = {{ $idmapel }};
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
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
        
        tampil_listmapelx1();
        setInterval(() => {
            semesterx1.change();
            idmapelx1.change();
            kirim_syarat();
        }, 500);

        setTimeout(() => {
            load_walikelas();
            document.getElementById('semesterx1').value = {{ $semester }};
            document.getElementById('semester1').value = {{ $semester }};
        }, 1000);

        idtpx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    load_walikelas();
                }, 100);
            }, 100);
            document.getElementById('idtp1').value = idtpx1.value;
        });

        idkelasx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    load_walikelas();
                }, 100);
            }, 100);
        });

        idmapelx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
            }, 100);
             document.getElementById('idmapel1').value = idmapelx1.value;
        });

        semesterx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
            }, 100);
             document.getElementById('semester1').value = semesterx1.value;
        });

        async function load_walikelas() {
            document.getElementById('walikelasx1').value = '';
            const url = `{{ url('/sips01/transaksi/nilaishowwali') }}`;
            
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
            const idmapel1= document.getElementById('idmapelx1').value;
            const semester1= document.getElementById('semesterx1').value;
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('idmapel1', idmapel1);
                formData.append('semester1', semester1);

            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.transaksi.nilai_kirimsyarat')}}',
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

        btn_download1.addEventListener('click', function () {
            // Ambil URL Route Laravel secara langsung
            var x = nama_tombol1.value;
            if(x=='nilai'){
                var url3 = "{{ route('sips01.download.import-nilai-form') }}";
            }else if(x=='absensi'){
                var url3 = "{{ route('sips01.download.import-absensi-form') }}";
            }
            // Alihkan halaman ke route tersebut untuk memicu unduhan otomatis aman
            window.location.href = url3;
        });

        btn_importnilai1.addEventListener('click', function () {
            document.getElementById('nama_tombol1').value = 'nilai';
            modal_header1.classList.remove('bg-info');
            modal_header1.classList.add('bg-warning');
            div_mapel1.classList.remove('d-none');
            modal_judul1.innerHTML = 'Import Data nilai';
            ModalImport.show(); 
        });
        
        btn_importabsensi1.addEventListener('click', function () {
            document.getElementById('nama_tombol1').value = 'absensi';
            modal_header1.classList.add('bg-info');
            modal_header1.classList.remove('bg-warning');
            div_mapel1.classList.add('d-none');
            modal_judul1.innerHTML = 'Import Data Absensi';
            ModalImport.show(); 
        });

        btn_upload1.addEventListener('click', function (e) {
            e.preventDefault();
            var x = nama_tombol1.value;
            if(x=='nilai'){
                data_import_nilai();
            }else if(x=='absensi'){
                data_import_absensi();
            }
                         
        });

        function data_import_nilai(){
            const idtp1 = document.getElementById('idtp1').value;
            const idmapel1 = document.getElementById('idmapel1').value;
            const semester1 = document.getElementById('semester1').value;
            const file1 = document.getElementById('fileimportx').files[0];
            if (!file1) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'File excel belum dipilih', 'error');
                return;
            }
            if (!idtp1) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'Tahun pelajaran belum dipilih', 'error');
                return;
            }
            if (!idmapel1) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'Semester belum dipilih', 'error');
                return;
            }
            
            swalsedangproses();
            ModalImport.hide();
            
            let formData = new FormData();
                formData.append('idtp1', idtp1); 
                formData.append('idmapel1', idmapel1);
                formData.append('semester1', semester1);
                formData.append('file1', file1);            
            
            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.transaksi.nilai_importnilai')}}',
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
                            swalsuksesimport('Daftar Nilai'); 
                        }, 500);
                    },
                error : function(formData){ 
                        Swal.close();                   
                        swalgagalimport('Daftar Nilai');                 
                    }
            });        
        }

        function data_import_absensi(){
            const idtp1 = document.getElementById('idtp1').value;
            const semester1 = document.getElementById('semester1').value;
            const file1 = document.getElementById('fileimportx').files[0];
            if (!file1) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'File excel belum dipilih', 'error');
                return;
            }
            if (!idtp1) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'Tahun pelajaran belum dipilih', 'error');
                return;
            }
            
            swalsedangproses();
            ModalImport.hide();
            
            let formData = new FormData();
                formData.append('idtp1', idtp1); 
                formData.append('semester1', semester1);
                formData.append('file1', file1);            
            
            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.transaksi.nilai_importabsensi')}}',
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
                            swalsuksesimport('Daftar Absensi'); 
                        }, 500);
                    },
                error : function(formData){ 
                        Swal.close();                   
                        swalgagalimport('Daftar Absensi');                 
                    }
            });        
        }

        document.getElementById('show_data1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_print');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var nama1 = targetButton.getAttribute('data2');
                var nis1 = targetButton.getAttribute('data3');
                var nisn1 = targetButton.getAttribute('data4');

                document.getElementById('id3').value = id1;
                document.getElementById('namaprint').innerHTML = nama1;
                document.getElementById('nisprint').innerHTML = nis1;
                document.getElementById('nisnprint').innerHTML = nisn1;
                kirim_id(id1, nisn1)
                ModalPrint.show();
            }
        });

        btn_printnilai1.addEventListener('click', function (e) {
            e.preventDefault();
            var id3 = document.getElementById('id3').value;
            window.open('{{ route('sips01.transaksi.nilai_printnilai') }}');
            ModalPrint.hide();
        });

        function kirim_id(id, nisn) {
            const iddatasiswa1 = id;
            const nisn1 = nisn;

            let formData = new FormData();
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('nisn1', nisn1);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route('sips01.transaksi.nilai_kirimid') }}', {
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