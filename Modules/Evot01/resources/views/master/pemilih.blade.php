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


    <div class="card-header border-0 mb-0 bg-transparent px-0">  
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

                    <button id="btn_importexcel1x" name="btn_importexcel1x" type="button" class="btn btn-warning text-white d-inline-flex align-items-center gap-2" style="height: 36px;">
                        <i class="bi bi-file-earmark-excel" style="font-size: 18px;"></i> Import
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
                            <th style="width:150px">Nama</th>                               
                            <th style="width:100px">User</th>                               
                            <th style="width:100px">Passwords</th>                               
                            <th style="width:100px">Kelas</th>                               
                            <th style="width:100px">Status</th>                               
                            <th style="width:50px">Action</th>
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
                                <label for="nama1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nama <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="nama1" id="nama1" maxlength="100" class="form-control" placeholder="Nama" value="{{ old('nama1') }}" required autofocus>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="users1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    User <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="users1" id="users1" maxlength="100" class="form-control" placeholder="Users" value="{{ old('users1') }}" required >
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="passwords1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Password <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="passwords1" id="passwords1" maxlength="100" class="form-control" placeholder="Passwords" value="{{ old('passwords1') }}" required>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="kelas1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Kelas
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="kelas1" id="kelas1" maxlength="15" class="form-control" placeholder="kelas" value="{{ old('kelas1') }}">
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

    <!-- khusus menyimpan data yang akan didestroy -->
    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	

</div>

<script type="text/javascript">
    let data1Datatable;
    
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
        const btn_importexcel1x = document.getElementById('btn_importexcel1x');
        
        //persiapan data
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const nama1 = document.getElementById('nama1');        
        const users1 = document.getElementById('users1');        
        const passwords1 = document.getElementById('passwords1');        
        const kelas1 = document.getElementById('kelas1');        

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
            nama1.value = '';        
            users1.value = '';        
            passwords1.value = '';        
            ModalAdd.show();            
        });

        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
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
                ajax: "{{ route('evot01.master.pemilih_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'nama', name: 'nama', orderable: true, searchable: true },
                    { data: 'users', name: 'users', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'passwords', name: 'passwords', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'kelas', name: 'kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'statusx', name: 'statusx', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
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
            const nama1= document.getElementById('nama1').value;
            const users1= document.getElementById('users1').value;
            const passwords1= document.getElementById('passwords1').value;
            const kelas1= document.getElementById('kelas1').value;
            
            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('nama1', nama1);
                formData.append('users1', users1);
                formData.append('passwords1', passwords1);
                formData.append('kelas1', kelas1);
            
                fetch("{{ route('evot01.master.pemilih_create') }}", {
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

        btn_download1.addEventListener('click', function () {
            // Ambil URL Route Laravel secara langsung
            var url3 = "{{ route('evot01.download.import-pemilih-form') }}";
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
            
            const file1x = document.getElementById('fileimportx').files[0];
            
            if (!file1x) {
                Swal.close();
                Swal.fire('Maaf, gagal import', 'File excel belum dipilih', 'error');
                return;
            }
            
            swalsedangproses();
            ModalImport.hide();
            
            let formData = new FormData();
                formData.append('file1x', file1x);            
            
            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('evot01.master.pemilih_import')}}',
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
                            swalsuksesimport('Data Pemilih'); 
                        }, 500);
                    },
                error : function(formData){ 
                        Swal.close();                   
                        swalgagalimport('Data Pemilih');                 
                    }
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
            const url = `{{ url('/evot01/master/pemilihedit') }}/${id1}`;
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
                    document.getElementById('users1').value = resultData[i].users;
                    document.getElementById('passwords1').value = resultData[i].passwords;
                    document.getElementById('kelas1').value = resultData[i].kelas;
                    document.getElementById('nama1').value = resultData[i].nama;
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
            // showCancelButton: true,
            // confirmButtonColor: '#3085d6',
            // cancelButtonColor: '#d33',
            // confirmButtonText: "Yes, delete !",
            // cancelButtonText: "No, cancel !",

            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: "Yes, delete one!",
            denyButtonText: "Yes, delete all!",
            cancelButtonText: "No, cancel !",

            }).then((result) => {
                if (result.isConfirmed) {
                    data_destroy();            
                } else if (result.isDenied) {
                    // Jika klik "Yes, delete all!"
                    data_destroy_all(); // Panggil fungsi untuk hapus semua data di sini
                }
            })
        } 

        function data_destroy(){			
            var id3 = document.getElementById('id3').value;       
            var data3a = document.getElementById('data3a').value;      
            
            $.ajax({
                type  : 'POST',
                url   : '{{url('/evot01/master/pemilihdestroy')}}/'+id3,
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

        function data_destroy_all(){			
            var id3 = 0;
            $.ajax({
                type  : 'POST',
                url   : '{{url('/evot01/master/pemilihdestroyall')}}/'+id3,
                async : false,
                dataType : 'json',
                data: {
                    _method: 'DELETE', // Spoofing metode menjadi DELETE untuk Laravel
                    _token: '{{ csrf_token() }}' // Wajib mengirimkan CSRF Token Laravel
                },						
                success : function(data){
                    tampil_dataTable();
                    swalsuksesdestroy('All datas'); 
                },
                error : function(data){
                    swalgagaldestroy('All datas');
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
                timer:5000,
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
                timer: 5000,
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