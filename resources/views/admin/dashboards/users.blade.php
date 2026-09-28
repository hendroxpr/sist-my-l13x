@extends('admin.layouts.main')

@section('contents')

@php
    $level = auth()->user()->levels;    
@endphp

<style>
  /* Efek dasar untuk gambar */
  .img-hover-zoom {
    transition: transform 0.3s ease-in-out; /* Mengatur kecepatan dan kehalusan animasi */
  }

  /* Efek saat kursor berada di atas gambar */
  .img-hover-zoom:hover {
    transform: scale(1.1); /* Membesarkan gambar sebanyak 10% */
  }

</style>

<div class="container-fluid px-0">
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
                        <i class="bi bi-plus-lg fs-6"></i> Tambah
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
                            <th style="width: 5%">#</th>
                            <th style="width: 15%">User Name</th>
                            <th style="width: 15%">Email</th>
                            <th style="width: 10%">Nama Depan</th>
                            <th style="width: 10%">Nama Tengah</th>
                            <th style="width: 10%">Nama Belakang</th>
                            <th style="width: 5%">Aplikasi</th>
                            <th style="width: 5%">Level</th>
                            <th style="width: 5%">Blokir</th>
                            <th style="width: 10%">Image</th>
                            <th style="width: 15%">Status</th>
                            <th style="width: 5%">Action</th>
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
                            <!-- Username -->
                            <div class="row mb-1 align-items-center">
                                <label for="name1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    User Name <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="name1" id="name1" class="form-control" placeholder="Masukkan Username" value="{{ old('name1') }}" required autofocus>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="row mb-1 align-items-center">
                                <label for="email1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Email <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="email" name="email1" id="email1" class="form-control" placeholder="email@domain.com" required>
                                </div>
                            </div>
                            <!-- Password -->
                            <div class="row mb-1 align-items-center">
                                <label for="password1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Password
                                </label>
                                <div class="col-sm-8">
                                    <input type="password" name="password1" id="password1" class="form-control" placeholder="Password">
                                    <span class="form-text text-danger" id="pesanpassword1"></span>
                                </div>
                            </div>
                            <!-- Nama Depan -->
                            <div class="row mb-1 align-items-center">
                                <label for="namadepan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nama Depan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="namadepan1" id="namadepan1" class="form-control" placeholder="Nama Depan">
                                </div>
                            </div>
                            <!-- Nama Tengah -->
                            <div class="row mb-1 align-items-center">
                                <label for="namatengah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nama Tengah
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="namatengah1" id="namatengah1" class="form-control" placeholder="Nama Tengah">
                                </div>
                            </div>
                            <!-- Nama Belakang -->
                            <div class="row mb-1 align-items-center">
                                <label for="namabelakang1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nama Belakang
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="namabelakang1" id="namabelakang1" class="form-control" placeholder="Nama Belakang">
                                </div>
                            </div>
                            <!-- Aplikasi -->
                            <div class="row mb-1 align-items-center">
                                <label for="idaplikasi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Aplikasi <span class="text-danger">*</span>
                                </label>
                                <div class="col-sm-8">
                                    <select name="idaplikasi1" id="idaplikasi1" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Aplikasi --</option>
                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                    </select>
                                </div>
                            </div>
                            <!-- Level -->
                            <div class="row mb-1 align-items-center">
                                <label class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Level
                                </label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="levels1" id="levels1xadmin" value="1">
                                            <label class="form-check-label" for="levels1xadmin">Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="levels1" id="levels1xuser" value="2">
                                            <label class="form-check-label" for="levels1xuser">User</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="levels1" id="levels1xentry" value="3" checked>
                                            <label class="form-check-label" for="levels1xentry">Entry</label>
                                        </div>
                                        <input name="levels1" id="levels1" type="hidden">
                                    </div>
                                </div>
                            </div>
                            <!-- Blokir -->
                            <div class="row mb-1 align-items-center">
                                <label class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Blokir
                                </label>
                                <div class="col-sm-8">
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="blokir1" id="blokir1xy" value="Y">
                                            <label class="form-check-label" for="blokir1xy">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="blokir1" id="blokir1xn" value="N" checked>
                                            <label class="form-check-label" for="blokir1xn">Tidak</label>
                                        </div>
                                        <input name="blokir1" id="blokir1" type="hidden">
                                    </div>
                                </div>
                            </div>
                            <!-- Countdown -->
                            <div class="row mb-1 align-items-center">
                                <label for="countdown1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Countdown (Detik)
                                </label>
                                <div class="col-sm-8">
                                    <input type="number" name="countdown1" id="countdown1" class="form-control" value="900" placeholder="900">
                                </div>
                            </div>
                            <!-- status -->
                            <div class="row mb-1 align-items-center">
                                <label for="status1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Status
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="status1" id="status1" class="form-control" placeholder="Status">
                                </div>
                            </div>
                            <!-- Upload Foto & Preview Layout -->
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
                            <!--  -->
                            <div class="row mb-0  align-items-center">
                                <label class="col-sm-4 col-form-label text-sm-first fw-semibold">
                                    <small class="text-muted"><span class="text-danger">*</span> Wajib diisi.</small>
                                </label>
                                <div class="col-sm-8">
                                    {{--  --}}
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
        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        
        //persiapan data
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const name1 = document.getElementById('name1');        
        const email1 = document.getElementById('email1');        
        const password1 = document.getElementById('password1');        
        const pesanpassword1 = document.getElementById('pesanpassword1');        
        const namadepan1 = document.getElementById('namadepan1');        
        const namatengah1 = document.getElementById('namatengah1');        
        const namabelakang1 = document.getElementById('namabelakang1');        
        const idaplikasi1 = document.getElementById('idaplikasi1');
        const levels1 = document.getElementById('levels1');        
        const levels1xadmin = document.getElementById('levels1xadmin');        
        const levels1xuser = document.getElementById('levels1xuser');        
        const levels1xentry = document.getElementById('levels1xentry');        
        const blokir1 = document.getElementById('blokir1');        
        const blokir1xy = document.getElementById('blokir1xy');        
        const blokir1xn = document.getElementById('blokir1xn');        
        const countdown1 = document.getElementById('countdown1');        
        const status1 = document.getElementById('status1');        
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
        
        //level
        levels1xadmin.addEventListener('change', function(){
           levels1.value = '1'; 
        })
        levels1xuser.addEventListener('change', function(){
           levels1.value = '2'; 
        })
        levels1xentry.addEventListener('change', function(){
           levels1.value = '3'; 
        })

        //blokir
        blokir1xy.addEventListener('change', function(){
           blokir1.value = 'Y'; 
        })
        blokir1xn.addEventListener('change', function(){
           blokir1.value = 'N'; 
        })

        function btn_baru_click(){
            bodyx.disabled = false;
            password1.classList.remove('bg-warning');
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
            password1.classList.add('bg-warning');
            pesanpassword1.innerHTML = 'Jika password tidak berubah, kosongkan saja.'
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
            name1.value = '';        
            email1.value = '';        
            password1.value = '';        
            pesanpassword1.value = '';        
            namadepan1.value = '';        
            namatengah1.value = '';        
            namabelakang1.value = '';        
            levels1.value = '3';
            if(levels1.value=='1'){
                levels1xadmin.checked = true;    
            }else if(levels1.value=='1'){
                levels1xuser.checked = true;
            }else{
                levels1xentry.checked = true;
            }       
            blokir1.value = 'N';
            if(blokir1.value=='Y'){
                blokir1xy.checked = true;
            }else{
                blokir1xn.checked = true;
            }       
            countdown1.value = '900';        
            status1.value = '';        
            
            ModalAdd.show();            
        });
       
        //btn_tambah1 disabled
        const level={{ $level }};        
        if(level!='1'){
            btn_tambah1.classList.add('disabled');
        }else{
            btn_tambah1.classList.remove('disabled');
        }

        tampil_listaplikasi()
        //menampilkan combo aplikasi
        function tampil_listaplikasi(){				
            $.ajax({
                type: 'get',
                url   : '{{route('admin.users_listaplikasi')}}',
                
                success: function(data){		    
                   idaplikasi1.innerHTML = data;                
                }
            })
        }

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
                ajax: "{{ route('admin.users_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'name', name: 'name', orderable: true, searchable: true },
                    { data: 'email', name: 'email', orderable: true, searchable: true },
                    { data: 'namadepan', name: 'namadepan', orderable: true, searchable: true },
                    { data: 'namatengah', name: 'namatengah', orderable: true, searchable: true },
                    { data: 'namabelakang', name: 'namabelakang', orderable: true, searchable: true },
                    { data: 'aplikasi', name: 'aplikasi', orderable: true, searchable: true, },
                    { data: 'levels', name: 'levels', orderable: true, searchable: true, },
                    { data: 'blokir', name: 'blokir', className: 'dt-center', orderable: true, searchable: true, },
                    { data: 'foto', name: 'foto', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'status', name: 'status', orderable: true, searchable: true  },
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
            const name1= document.getElementById('name1').value;
            const email1= document.getElementById('email1').value;
            const password1= document.getElementById('password1').value;
            const namadepan1= document.getElementById('namadepan1').value;
            const namatengah1= document.getElementById('namatengah1').value;
            const namabelakang1= document.getElementById('namabelakang1').value;
            const levels1= document.getElementById('levels1').value;
            const idaplikasi1= document.getElementById('idaplikasi1').value;
            const blokir1= document.getElementById('blokir1').value;
            const countdown1= document.getElementById('countdown1').value;
            const status1= document.getElementById('status1').value;
            const foto1 =  document.getElementById('foto1').files[0];
            
            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('name1', name1);
                formData.append('email1', email1);
                formData.append('password1', password1);
                formData.append('namadepan1', namadepan1);
                formData.append('namatengah1', namatengah1);
                formData.append('namabelakang1', namabelakang1);
                formData.append('levels1', levels1);
                formData.append('idaplikasi1', idaplikasi1);
                formData.append('blokir1', blokir1);
                formData.append('countdown1', countdown1);
                formData.append('status1', status1);
                formData.append('foto1', foto1);
            
                fetch("{{ route('admin.users_create') }}", {
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
                    swalsuksestambah(name1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(name1);
                });    
        }
        
        document.getElementById('show_data1').addEventListener('click', async function(e) {
            // Memeriksa apakah elemen yang diklik (atau elemen induknya) adalah tombol dengan kelas '.item_edit'
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                btn_edit1_click();
                inputfoto1.value = '';
                document.getElementById('foto1x').value = '';
                var id1 = targetButton.getAttribute('data1');
                await data_edit(id1);
                ModalAdd.show();
            }
        });

        async function data_edit(id1) {
            const url = `{{ url('/admin/usersedit') }}/${id1}`;
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
                    document.getElementById('name1').value = resultData[i].name;
                    document.getElementById('email1').value = resultData[i].email;
                    document.getElementById('password1').value = "";
                    document.getElementById('namadepan1').value = resultData[i].namadepan;
                    document.getElementById('namatengah1').value = resultData[i].namatengah;
                    document.getElementById('namabelakang1').value = resultData[i].namabelakang;
                    document.getElementById('idaplikasi1').value = resultData[i].kunci1;
                    document.getElementById('levels1').value = resultData[i].levels;
                    document.getElementById('blokir1').value = resultData[i].blokir;
                    document.getElementById('countdown1').value = resultData[i].countdown;
                    document.getElementById('status1').value = resultData[i].status;

                    // 2. Logika Pengecekan Radio Button "levels1"
                    const levelValue = document.getElementById('levels1').value;
                    if (levelValue === '1') {
                        document.getElementById("levels1xadmin").checked = true;
                    } else if (levelValue === '2') {
                        document.getElementById("levels1xresultData[i]").checked = true;
                    } else {
                        document.getElementById("levels1xentry").checked = true;
                    }

                    // 3. Logika Pengecekan Radio Button "blokir1"
                    const blokirValue = document.getElementById('blokir1').value;
                    if (blokirValue === 'Y') {
                        document.getElementById("blokir1xy").checked = true;
                    } else {
                        document.getElementById("blokir1xn").checked = true;
                    }

                    // 4. Pengolahan Preview Foto (Bootstrap 5 Responsive Image)
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
                url   : '{{url('/admin/usersdestroy')}}/'+id3,
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

    //   async function data_destroy() {
    //         var id3 = document.getElementById('id3').value;       
    //         var data3a = document.getElementById('data3a').value;
    //         const url = `{{ url('/admin/usersdestroy') }}/${id3}`;
            
    //         try {
    //             const response = await fetch(url, {
    //                 method: 'GET',
    //                 headers: {
    //                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    //                     'Accept': 'application/json'
    //                 }
    //             });

    //              // Jika status HTTP server bermasalah (misal: 404 atau 500)
    //             if (!response.ok) {
    //                 throw new Error('Gagal menghapus data dari server');
    //             }

    //             // Membaca response jika backend mengembalikan data JSON
    //             const data = await response.json();

    //             // === BLOK SUCCESS ===
    //             tampil_data();
    //             if (typeof swalsukseshapus === 'function') {
    //                 swalsukseshapus(data3a); 
    //                 tampil_dataTable();
    //             }

    //         } catch (error) {
    //             console.error('Error saat memuat data:', error);
    //             if (typeof swalgagaldestroy === 'function') {
    //                 // swalgagaldestroy('Gagal destroy data pengguna.');
    //             }
    //         }
    //     }
        
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