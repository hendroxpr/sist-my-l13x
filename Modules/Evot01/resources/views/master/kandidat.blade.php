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
							<th style="width:10px">Nomor</th>							
							<th style="width:100px">Nama</th>							
							<th style="width:300px">Semboyan</th>							
							<th style="width:300px">Foto</th>							
							<th style="width:100px">Visi</th>							
							<th style="width:100px">Misi</th>							
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
                                <label for="nomor1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nomor
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="nomor1" id="nomor1" maxlength="200" class="form-control" placeholder="Nomor" value="{{ old('nomor1') }}" required autofocus>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="nama1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nama
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="nama1" id="nama1" maxlength="100" class="form-control" placeholder="Nama" value="{{ old('nama1') }}" required>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="semboyan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Semboyan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="semboyan1" id="semboyan1" maxlength="250" class="form-control" placeholder="Semboyan" value="{{ old('semboyan1') }}" required>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-start">
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

                            <div class="row mb-1 align-items-center">
                                <label for="btn_visi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Visi
                                </label>
                                <div class="col-sm-8">
                                    <button id="btn_visi1" name="btn_visi1" type="button" class="btn btn-info text-white" style="width: 100%">
                                        <i class="bi bi-pencil-square fs-6 fw-bold"></i> Visi
                                    </button>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="btn_misi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Misi
                                </label>
                                <div class="col-sm-8">
                                    <button id="btn_misi1" name="btn_misi1" type="button" class="btn btn-info text-white" style="width: 100%">
                                        <i class="bi bi-pencil-square fs-6 fw-bold"></i> Misi
                                    </button>
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

    <!-- ModalVisi modal fade-->
    <div class="modal fade" id="ModalVisi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                        <i class="bi bi-journal-text" style="font-size: 20px;"></i>
                        <span class="fw-bold"> Visi</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    <fieldset id="bodyx">
                        <div class="modal-body p-1">
                            <textarea class="ckeditor" id="visi1" name="visi1"></textarea>
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
    <!-- end ModalVisi -->

    <!-- ModalMisi modal fade-->
    <div class="modal fade" id="ModalMisi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                        <i class="bi bi-journal-text" style="font-size: 20px;"></i>
                        <span class="fw-bold"> Misi</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    <fieldset id="bodyx">
                        <div class="modal-body p-1">
                            <textarea class="ckeditor" id="misi1" name="misi1"></textarea>
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
    <!-- end ModalMisi -->

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
        const ModalMisi = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalMisi'));
        const ModalVisi = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalVisi'));
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
        const nomor1 = document.getElementById('nomor1');        
        const nama1 = document.getElementById('nama1');        
        const semboyan1 = document.getElementById('semboyan1'); 
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
            CKEDITOR.instances['visi1'].setData('');
            CKEDITOR.instances['misi1'].setData('');
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
            nomor1.value = '';        
            nama1.value = '';        
            semboyan1.value = '';        
            ModalAdd.show();            
        });

        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
            });
        });
        $('#ModalVisi').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
            });
        });
        $('#ModalMisi').on('shown.bs.modal', function () {
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
                ajax: "{{ route('evot01.master.kandidat_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'nomor', name: 'nomor', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'nama', name: 'nama', orderable: true, searchable: true },
                    { data: 'semboyan', name: 'semboyan', orderable: true, searchable: true },
                    { data: 'foto', name: 'foto', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'visix', name: 'visix', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'misix', name: 'misix', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }

        function tampil_dataTable(){   
            data1Datatable.ajax.reload(null, false);
        }

        btn_visi1.addEventListener('click', function () {
            ModalVisi.show();            
        });

        btn_misi1.addEventListener('click', function () {
            ModalMisi.show();            
        });

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });

        function data_simpan(){            
            const id1= document.getElementById('id1').value;			
            const nomor1= document.getElementById('nomor1').value;
            const nama1= document.getElementById('nama1').value;
            const semboyan1= document.getElementById('semboyan1').value;
            const foto1 =  document.getElementById('foto1').files[0];
            const misi1 = CKEDITOR.instances['misi1'].getData();
            const visi1 = CKEDITOR.instances['visi1'].getData();

            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('nomor1', nomor1);
                formData.append('nama1', nama1);
                formData.append('semboyan1', semboyan1);
                formData.append('foto1', foto1);
                formData.append('misi1', misi1);
                formData.append('visi1', visi1);
            
                fetch("{{ route('evot01.master.kandidat_create') }}", {
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
            const targetButton = e.target.closest('.item_visi');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var data2 = targetButton.getAttribute('data2');
                CKEDITOR.instances['visi1'].setData(data2);
                ModalVisi.show();
            }
        });

        document.getElementById('show_data1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_misi');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var data2 = targetButton.getAttribute('data2');
                CKEDITOR.instances['misi1'].setData(data2);
                ModalMisi.show();
            }
        });

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
            const url = `{{ url('/evot01/master/kandidatedit') }}/${id1}`;
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
                    document.getElementById('nomor1').value = resultData[i].nomor;
                    document.getElementById('nama1').value = resultData[i].nama;
                    document.getElementById('semboyan1').value = resultData[i].semboyan;
                    CKEDITOR.instances['visi1'].setData(resultData[i].visi);
                    CKEDITOR.instances['misi1'].setData(resultData[i].misi);
                    
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
                url   : '{{url('/evot01/master/kandidatdestroy')}}/'+id3,
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