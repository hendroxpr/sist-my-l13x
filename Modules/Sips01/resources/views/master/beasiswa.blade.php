@extends('admin.layouts.main')

@section('contents')

@php
    $idtp = session('idtp');    
    $idkelas = session('idkelas');    
    $iddatasiswa = session('iddatasiswa');    
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
                    <div class="col-sm-5">
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
                            <th style="width:20px">TP</th>							
                            <th style="width:200px">Nama Siswa</th>
                            <th style="width:20px">Kelas</th>							
                            <th style="width:100px">Beasiswa</th>							
                            <th style="width:20px">Nomor Beasiswa</th>							
                            <th style="width:20px">Tanggal<br>Beasiswa</th>							
                            <th style="width:200px">Dari</th>							
                            <th style="width:100px">TTD</th>							
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
                                <label for="idtp1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Tahun Pelajaran
                                </label>
                                <div class="col-sm-8">
                                    <select name="idtp1" id="idtp1" value="{{ $idtp }}" class="form-select"  autofocus>
                                        <option value="" selected disabled>-- Pilih Tahun Pelajaran --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="idkelas1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Kelas
                                </label>
                                <div class="col-sm-8">
                                    <select name="idkelas1" id="idkelas1" value="{{ $idkelas }}" class="form-select">
                                        <option value="" selected disabled>-- Pilih Kelas --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="iddatasiswa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nama Siswa
                                </label>
                                <div class="col-sm-8">
                                    <select name="iddatasiswa1" id="iddatasiswa1" value="{{ $iddatasiswa }}" class="form-select">
                                        <option value="" selected disabled>-- Pilih Siswa --</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="beasiswa1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Beasiswa
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="beasiswa1" id="beasiswa1" maxlength="50" class="form-control" placeholder="Beasiswa" value="{{ old('beasiswa1') }}" required>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="nomor1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Nomor
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="nomor1" id="nomor1" maxlength="50" class="form-control" placeholder="Nomor" value="{{ old('nomor1') }}">
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="tanggal1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Tanggal
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="tanggal1" id="tanggal1" maxlength="10" class="form-control" placeholder="Tanggal" value="{{ old('tanggal1') }}" autocomplete="off">
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="dari1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Dari
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="dari1" id="dari1" maxlength="50" class="form-control" placeholder="Dari" value="{{ old('dari1') }}">
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="ttd1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Ttd
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="ttd1" id="ttd1" maxlength="50" class="form-control" placeholder="Ttd" value="{{ old('ttd1') }}" >
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="keterangan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Keterangan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="keterangan1" id="keterangan1" maxlength="50" class="form-control" placeholder="Keterangan" value="{{ old('keterangan1') }}">
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

    <!-- khusus menyimpan data item_edit sementara -->
    <input name="idtp3" id="idtp3"type="hidden">	
    <input name="idkelas3" id="idkelas3"type="hidden">	
    <input name="iddatasiswa3" id="iddatasiswa3"type="hidden">	

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
        const idtp1 = document.getElementById('idtp1');        
        const idtpx1 = document.getElementById('idtpx1');        
        const idkelas1 = document.getElementById('idkelas1');        
        const iddatasiswa1 = document.getElementById('iddatasiswa1');        
        const beasiswa1 = document.getElementById('beasiswa1');        
        const nomor1 = document.getElementById('nomor1');        
        const tanggal1 = document.getElementById('tanggal1');        
        const dari1 = document.getElementById('dari1');   
        
        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: ".modal-content" // Modal hanya bisa digeser saat pointer menarik bagian header
            });
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
            beasiswa1.value = '';        
            nomor1.value = '';        
            tanggal1.value = '';        
            dari1.value = '';        
            ModalAdd.show();            
        });

        const tglx = new Datepicker(tanggal1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        //menampilkan combo tp
        tampil_listtp();
        function tampil_listtp(){				
            $.ajax({
                type: 'get',
                url   : '{{route('sips01.master.beasiswa_listtp')}}',
                
                success: function(data){	
                    idtpx1.innerHTML = data;	
                    document.getElementById('idtpx1').value = '{{ $idtp }}';		    
                    idtp1.innerHTML = data;	
                    document.getElementById('idtp1').value = '{{ $idtp }}';		    
                }
            })                    
        }

        idtpx1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                var idx = idtpx1.value;
                setTimeout(() => {
                    document.getElementById('idtp1').value = idx;	
                    loadkelas(idx);
                }, 100);
            }, 100);
            setTimeout(() => {
                idkelas1.click();        
            }, 1000); 
        });
        idtp1.addEventListener('click', function () {
            setTimeout(() => {
                // kirim_syarat();
                var idx = idtp1.value;
                setTimeout(() => {
                    loadkelas(idx);
                }, 100);
            }, 100);
            setTimeout(() => {
                idkelas1.click();        
            }, 1000); 
        });
        
        idkelas1.addEventListener('click', function () {
            setTimeout(() => {
                // kirim_syarat();
                var idx = idkelas1.value;
                
                setTimeout(() => {
                    loaddatasiswa(idx);
                }, 100);
            }, 100);
            setTimeout(() => {
                // idprogramx1.click();        
            }, 1000); 
            
        });

        async function loadkelas(id1) {
            const url = `{{ url('/sips01/master/beasiswalistkelas') }}/${id1}`;
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
                var html = '';
                // Loop data
                for (let i = 0; i < resultData.length; i++) {
                    
                    html += '<option value="' + resultData[i].id + '">' + resultData[i].kelas + '</option>';
                   
                }
                 document.getElementById("idkelas1").innerHTML = html;
                //  document.getElementById("idprogram1").innerHTML = html;
            } catch (error) {
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    // swalgagaltambah('Gagal memuat data pengguna.');
                }
            }
        }

        async function loaddatasiswa(id1) {
            const url = `{{ url('/sips01/master/beasiswalistdatasiswa') }}/${id1}`;
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
                var html = '';
                // Loop data
                for (let i = 0; i < resultData.length; i++) {
                    
                    html += '<option value="' + resultData[i].id + '">' + resultData[i].namalengkap + '</option>';
                   
                }
                 document.getElementById("iddatasiswa1").innerHTML = html;
                //  document.getElementById("idprogram1").innerHTML = html;
            } catch (error) {
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    // swalgagaltambah('Gagal memuat data pengguna.');
                }
            }
        }

        function kirim_syarat(){
            const idtp1= document.getElementById('idtpx1').value;
            let formData = new FormData();
                formData.append('idtp1', idtp1);

            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.master.beasiswa_kirimsyarat')}}',
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
                ajax: "{{ route('sips01.master.beasiswa_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'tp.tp', name: 'tp.tp', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true },
                    { data: 'beasiswa', name: 'beasiswa', orderable: true, searchable: true },
                    { data: 'nomor', name: 'nomor', orderable: true, searchable: true },
                    { data: 'tanggal', name: 'tanggal', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'dari', name: 'dari', orderable: true, searchable: true },
                    { data: 'ttd', name: 'ttd', orderable: true, searchable: true },
                    { data: 'keterangan', name: 'keterangan', orderable: true, searchable: true },
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
            const idtp1= document.getElementById('idtp1').value;
            const idkelas1= document.getElementById('idkelas1').value;
            const iddatasiswa1= document.getElementById('iddatasiswa1').value;
            const beasiswa1= document.getElementById('beasiswa1').value;
            const nomor1= document.getElementById('nomor1').value;
            const tanggal1= document.getElementById('tanggal1').value;
            const dari1= document.getElementById('dari1').value;
            const ttd1= document.getElementById('ttd1').value;
            const keterangan1= document.getElementById('keterangan1').value;
            
            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('beasiswa1', beasiswa1);
                formData.append('nomor1', nomor1);
                formData.append('tanggal1', tanggal1);
                formData.append('dari1', dari1);
                formData.append('ttd1', ttd1);
                formData.append('keterangan1', keterangan1);
            
                fetch("{{ route('sips01.master.beasiswa_create') }}", {
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
                    swalsuksestambah(beasiswa1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(beasiswa1);
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
                document.getElementById('idtp1').value = document.getElementById('idtp3').value;
                // idtp1.click();
                // setTimeout(() => {
                //     document.getElementById('idkelas1').value = document.getElementById('idkelas3').value;
                //     idkelas1.click();
                //     setTimeout(() => {
                //         document.getElementById('iddatasiswa1').value = document.getElementById('iddatasiswa3').value;
                //     }, 2000);
                // }, 2000);
            }
        });

        async function data_edit(id1) {
            const url = `{{ url('/sips01/master/beasiswaedit') }}/${id1}`;
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
                    // document.getElementById('idtp3').value = resultData[i].idtp;
                    // document.getElementById('idkelas3').value = resultData[i].idkelas;
                    // document.getElementById('iddatasiswa3').value = resultData[i].iddatasiswa;
                    setTimeout(() => {
                        document.getElementById('idtp1').value = resultData[i].idtp;
                        idtp1.click();
                        setTimeout(() => {
                            document.getElementById('idkelas1').value = resultData[i].idkelas;
                            idkelas1.click();
                            setTimeout(() => {
                                document.getElementById('iddatasiswa1').value = resultData[i].iddatasiswa;
                            }, 2000);
                        }, 2000);
                    }, 2000);


                    document.getElementById('beasiswa1').value = resultData[i].beasiswa;
                    document.getElementById('nomor1').value = resultData[i].nomor;
                    document.getElementById('tanggal1').value = resultData[i].tanggal;
                    document.getElementById('dari1').value = resultData[i].dari;
                    document.getElementById('ttd1').value = resultData[i].ttd;
                    document.getElementById('keterangan1').value = resultData[i].keterangan;
                }

            } catch (error) {
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    swalgagaltambah('Gagal memuat data');
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
                url   : '{{url('/sips01/master/beasiswadestroy')}}/'+id3,
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