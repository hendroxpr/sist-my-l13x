@extends('admin.layouts.main')

@section('contents')

@php
    $idtp = session('idtp');    
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
                            <option value="" selected disabled>-- Pilih Tp --</option>
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
							<th style="width:200px">Jenis Tagihan</th>							
							<th style="width:50px">Tingkat</th>
							<th style="width:200px">Koordinator</th>							
							<th style="width:50px">Target/Tahun</th>
							<th style="width:50px">Target/Bulan</th>
							<th style="width:200px">Keterangan</th>							
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
                                    TP
                                </label>
                                <div class="col-sm-8">
                                    <select name="idtp1" id="idtp1" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Tp --</option>
                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="idjenistagihan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Jenis Tagihan
                                </label>
                                <div class="col-sm-8">
                                    <select name="idjenistagihan1" id="idjenistagihan1" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Jenis Tagihan --</option>
                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="idtingkat1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Tingkat
                                </label>
                                <div class="col-sm-8">
                                    <select name="idtingkat1" id="idtingkat1" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Tingkat --</option>
                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="iddataguru1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Koordinator
                                </label>
                                <div class="col-sm-8">
                                    <select name="iddataguru1" id="iddataguru1" class="form-select" required>
                                        <option value="" selected disabled>-- Pilih Koordinator --</option>
                                        {{-- Option akan di-render via JS atau @foreach Blade --}}
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="targettahun1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Target/tahun
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="targettahun1" id="targettahun1" maxlength="50" class="form-control text-sm-end" placeholder="Targettahun" value="{{ old('targettahun1') }}" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="targetbulan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Target/bulan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="targetbulan1" id="targetbulan1" maxlength="10" class="form-control text-sm-end" placeholder="Targetbulan" value="{{ old('targetbulan1') }}" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                </div>
                            </div>

                            <div class="row mb-1 align-items-center">
                                <label for="keterangan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Keterangan
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="keterangan1" id="keterangan1" maxlength="50" class="form-control" placeholder="Keterangan" value="{{ old('keterangan1') }}" >
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
        const idtpx1 = document.getElementById('idtpx1');        
        const idtp1 = document.getElementById('idtp1');        
        const idjenistagihan1 = document.getElementById('idjenistagihan1');        
        const idtingkat1 = document.getElementById('idtingkat1');        
        const iddataguru1 = document.getElementById('iddataguru1');        
        const targettahun1 = document.getElementById('targettahun1');        
        const keterangan1 = document.getElementById('keterangan1');        
        const targetbulan1 = document.getElementById('targetbulan1');        

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
            targettahun1.value = '0';        
            keterangan1.value = '';        
            targetbulan1.value = '0';        
            ModalAdd.show();            
        });
        
        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
            $(this).find('.modal-dialog').draggable({
            handle: '.modal-content' // Modal hanya bisa digeser 
            });
        });
        //supaya kembali ke tengah saat show lagi.
        const dragModalAdd = document.getElementById('ModalAdd');
        dragModalAdd.addEventListener('hidden.bs.modal', function () {
            const dialog = this.querySelector('.modal-dialog');
            dialog.style.position = '';
            dialog.style.margin = '';
            dialog.style.transform = '';
            dialog.style.left = '';
            dialog.style.top = '';
            dialog.style.width = '';
        });

        // function makeDraggable(dialogElement, handleElement) {
        //     if (!dialogElement || !handleElement) return;

        //     handleElement.style.cursor = 'move';

        //     let isDragging = false;
        //     let startX, startY, initialLeft, initialTop;

        //     handleElement.addEventListener('mousedown', function (e) {
        //         e.preventDefault(); 
        //         isDragging = true;
                
        //         startX = e.clientX;
        //         startY = e.clientY;

        //         const rect = dialogElement.getBoundingClientRect();
        //         initialLeft = rect.left;
        //         initialTop = rect.top;

        //         // SOLUSI: Kunci lebar modal saat ini agar ukurannya tidak berubah/menyempit
        //         dialogElement.style.width = rect.width + 'px';

        //         // Set posisi absolut/fixed
        //         dialogElement.style.position = 'fixed';
        //         dialogElement.style.margin = '0';
        //         dialogElement.style.transform = 'none';
                
        //         dialogElement.style.left = initialLeft + 'px';
        //         dialogElement.style.top = initialTop + 'px';
        //     });

        //     document.addEventListener('mousemove', function (e) {
        //         if (!isDragging) return;

        //         const dx = e.clientX - startX;
        //         const dy = e.clientY - startY;

        //         dialogElement.style.left = (initialLeft + dx) + 'px';
        //         dialogElement.style.top = (initialTop + dy) + 'px';
        //     });

        //     document.addEventListener('mouseup', function () {
        //         isDragging = false;
        //     });
        // }

        // const dragModalAdd = document.getElementById('ModalAdd');
            // dragModalAdd.addEventListener('shown.bs.modal', function () {
            //     const dialog = this.querySelector('.modal-dialog');
                
            //     // UBAH DI SINI: Gunakan .modal-header sebagai handle, jika tidak ada baru gunakan .modal-content
            //     const handle = this.querySelector('.modal-header') || this.querySelector('.modal-content');
                
            //     makeDraggable(dialog, handle);
            // });

        // const dragModalAdd = document.getElementById('ModalAdd');
        // dragModalAdd.addEventListener('shown.bs.modal', function () {
        //     const dialog = this.querySelector('.modal-dialog');
        //     const handle = this.querySelector('.modal-content');
            
        //     makeDraggable(dialog, handle);
        // });

        //supaya kembali ke tengah saat show lagi.
        // dragModalAdd.addEventListener('hidden.bs.modal', function () {
        //     const dialog = this.querySelector('.modal-dialog');
        //     dialog.style.position = '';
        //     dialog.style.margin = '';
        //     dialog.style.transform = '';
        //     dialog.style.left = '';
        //     dialog.style.top = '';
        //     dialog.style.width = '';
        // });


        bodyx.addEventListener('mousemove', function () {
            if(targettahun1.value==''){
                targettahun1.value='0';
            }
            if(targetbulan1.value==''){
                targetbulan1.value='0';
            }
        });
        
        targettahun1.addEventListener('keydown', function () {
            const targettahun = document.getElementById('targettahun1').value.replace(/[^,\d]/g, '').toString();
            if(targettahun > '0'){
                const targettahunx = parseFloat(targettahun);
                const targetbulan = Math.ceil(targettahunx/12);
                const targetbulanx = parseInt(targetbulan);
                document.getElementById('targetbulan1').value = formatAngka(targetbulanx,'');
            }
        });
        
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
                    url: "{{ route('sips01.pengaturan.parametertagihan_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'jenistagihan.jenistagihan', name: 'jenistagihan.jenistagihan', orderable: true, searchable: true },
                    { data: 'tingkat.tingkat', name: 'tingkat.tingkat', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'dataguru.nama', name: 'dataguru.nama', orderable: true, searchable: true },
                    { data: 'targettahun', name: 'targettahun', orderable: true, searchable: true, className: 'dt-right' },
                    { data: 'targetbulan', name: 'targetbulan', orderable: true, searchable: true, className: 'dt-right' },
                    { data: 'keterangan', name: 'keterangan', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ]
            });
        }

        tampil_listtpx()
        //menampilkan combo tpx
        function tampil_listtpx() {				
            fetch('{{ route("sips01.pengaturan.parametertagihan_listtp") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(idtpx1){
                        idtpx1.innerHTML = data;
                        idtpx1.value = "{{ $idtp }}";
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }


        tampil_listtp1()
        //menampilkan combo tp1
        function tampil_listtp1() {				
            fetch('{{ route("sips01.pengaturan.parametertagihan_listtp") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(idtp1){
                        idtp1.innerHTML = data;                        
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        tampil_listjenistagihan1()
        //menampilkan combo jenistagihan1
        function tampil_listjenistagihan1() {				
            fetch('{{ route("sips01.pengaturan.parametertagihan_listjenistagihan") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(idjenistagihan1){
                        idjenistagihan1.innerHTML = data;                        
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }


         tampil_listtingkat1()
        //menampilkan combo tingkat1
        function tampil_listtingkat1() {				
            fetch('{{ route("sips01.pengaturan.parametertagihan_listtingkat") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(idtingkat1){
                        idtingkat1.innerHTML = data;                        
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        tampil_listdataguru1()
        //menampilkan combo dataguru1
        function tampil_listdataguru1() {				
            fetch('{{ route("sips01.pengaturan.parametertagihan_listdataguru") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(iddataguru1){
                        iddataguru1.innerHTML = data;                        
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        setTimeout(() => {
            idtpx1.change();
            kirim_syarat();
        }, 500);

        idtpx1.addEventListener('change', function () {
            setTimeout(() => {
                idtp1.value = idtpx1.value;
                kirim_syarat();
            }, 500); 
                    
        });

        function kirim_syarat(){
            const idtp1= document.getElementById('idtpx1').value;
            let formData = new FormData();
                formData.append('idtp1', idtp1);

            $.ajax({
                enctype: 'multipart/form-data',
                type   : 'post',
                url    : '{{route('sips01.pengaturan.parametertagihan_kirimsyarat')}}',
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
            const idtp1= document.getElementById('idtp1').value;			
            const idjenistagihan1= document.getElementById('idjenistagihan1').value;			
            const idtingkat1= document.getElementById('idtingkat1').value;			
            const iddataguru1= document.getElementById('iddataguru1').value;
            const targettahun1= document.getElementById('targettahun1').value.replace(/[^,\d]/g, '').toString();
            const targetbulan1= document.getElementById('targetbulan1').value.replace(/[^,\d]/g, '').toString();
            const keterangan1= document.getElementById('keterangan1').value;
            const jenistagihan1 = document.getElementById('idjenistagihan1').options[document.getElementById('idjenistagihan1').selectedIndex].text;
            const tingkat1 = document.getElementById('idtingkat1').options[document.getElementById('idtingkat1').selectedIndex].text;
            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('idtp1', idtp1);
                formData.append('idjenistagihan1', idjenistagihan1);
                formData.append('idtingkat1', idtingkat1);
                formData.append('iddataguru1', iddataguru1);
                formData.append('targettahun1', targettahun1);
                formData.append('targetbulan1', targetbulan1);
                formData.append('keterangan1', keterangan1);
            
                fetch("{{ route('sips01.pengaturan.parametertagihan_create') }}", {
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
                    swalsuksestambah(jenistagihan1+'-'+tingkat1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(jenistagihan1+'-'+tingkat1);
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
            const url = `{{ url('/sips01/pengaturan/parametertagihanedit') }}/${id1}`;
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
                    document.getElementById('idtp1').value = resultData[i].idtp;
                    document.getElementById('iddataguru1').value = resultData[i].iddataguru;
                    document.getElementById('idjenistagihan1').value = resultData[i].idjenistagihan;
                    document.getElementById('idtingkat1').value = resultData[i].idtingkat;
                    document.getElementById('iddataguru1').value = resultData[i].iddataguru;
                    document.getElementById('targettahun1').value = formatAngka(resultData[i].targettahun,'');
                    document.getElementById('targetbulan1').value = formatAngka(resultData[i].targetbulan,'');
                    document.getElementById('keterangan1').value = resultData[i].keterangan;
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
                await swal_destroy(data3a + '-' + data3b);
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
            var data3b = document.getElementById('data3b').value;      
            
            $.ajax({
                type  : 'POST',
                url   : '{{url('/sips01/pengaturan/parametertagihandestroy')}}/'+id3,
                async : false,
                dataType : 'json',
                data: {
                    _method: 'DELETE', // Spoofing metode menjadi DELETE untuk Laravel
                    _token: '{{ csrf_token() }}' // Wajib mengirimkan CSRF Token Laravel
                },						
                success : function(data){
                    tampil_dataTable();
                    swalsuksesdestroy(data3a + '-' + data3b); 
                },
                error : function(data){
                    swalgagaldestroy(data3a + '-' + data3b);
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