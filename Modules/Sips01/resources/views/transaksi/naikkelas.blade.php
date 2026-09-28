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
    $idkelas = session('idkelas');    
    $idkelas2 = session('idkelas2');    
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
            <div class="col-md-1 mb-0">
                <div class="row mb-2 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label mb-md-0 small fw-bold"></label>
                    </div>
                    <div class="col-md-7">
                        {{-- Tempatkan Form Input/Select 1 di sini --}}
                    </div>
                </div>
                
                <div class="row mb-0 align-items-center">
                    <div class="col-md-3">
                        <label class="form-label mb-md-0 small fw-bold"></label>
                    </div>
                    <div class="col-md-7">
                        {{-- Tempatkan Form Input/Select 2 di sini --}}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="row mb-1 align-items-center">
                    <div class="col-sm-6">
                        <select name="idtp1" id="idtp1" class="form-select">
                            <option value="" selected disabled>-- Pilih TP --</option>
                        </select>
                    </div>
                    <label for="idtp1" class="col-sm-6 col-form-label text-sm-start fw-semibold">
                        Tahun Pelajaran Lama
                    </label>
                </div>
                <div class="row mb-0 align-items-center">
                    <div class="col-sm-6">
                        <select name="idkelas1" id="idkelas1" class="form-select">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                        </select>
                    </div>
                    <label for="idkelas1" class="col-sm-6 col-form-label text-sm-start fw-semibold">
                        Kelas Lama
                    </label>
                </div>
            </div>

            <!-- Kolom Kanan: Area Tombol Aksi Mandiri -->
            <div class="col-md-2 mt-0">
                <input name="levelx" id="levelx" type="hidden" value="{{ auth()->user()->levels }}"> 
                <div class="row mb-1 align-items-center">
                    <button id="btn_proses1" name="btn_proses1" type="button" class="btn btn-primary">
                        <i class="bi bi-gear-fill fs-6 fw-bold"></i> Proses
                    </button>
                </div>
                <div class="row mb-1 align-items-center">
                    <a href="{{ url('/') }}{{ $link }}" class="btn btn-success">
                        <i class="bi bi-arrow-clockwise fs-6"></i> Refresh
                    </a> 
                </div>
            </div>

            <div class="col-md-4">
                <div class="row mb-1 align-items-center">
                    <label for="tp2" class="col-sm-6 col-form-label text-sm-end fw-semibold">
                        Tahun Pelajaran Baru
                    </label>
                    <div class="col-sm-6">
                        <input type="search" name="tp2" id="tp2" maxlength="10" class="form-control" placeholder="TP" readonly>
                    </div>
                </div>
                <div class="row mb-0 align-items-center">
                    <label for="idkelas2" class="col-sm-6 col-form-label text-sm-end fw-semibold">
                        Kelas Baru
                    </label>
                    <div class="col-sm-6">
                        <select name="idkelas2" id="idkelas2" class="form-select">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="col-md-1">
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
        </div>

        <div class="row align-items-top p-0">
            <div class="col-md-6 g-0">
                <!--awal tabel-->        
                <div class="card-body g-0" id="headerjudul" style="display: block;">
                    <div id="reload" class="table-responsive g-0">
                        <table id="data1" class="table table-bordered table-striped table-hover align-middle g-0" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:10px;">#</th>
                                    <th style="width:20px">NIS</th>
                                    <th style="width:15px">NISN</th>
                                    <th style="width:100px">Nama Siswa</th>
                                    <th style="width:30px">Kelas</th>
                                    <th style="width:20px">TP</th>
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

            <div class="col-md-6 g-0">
                <!--awal tabel-->        
                <div class="card-body g-0" id="headerjudul" style="display: block;">
                    <div id="reload" class="table-responsive g-0">
                        <table id="data2" class="table table-bordered table-striped table-hover align-middle g-0" style="width: 100%">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:10px;">#</th>
                                    <th style="width:20px">NIS</th>
                                    <th style="width:15px">NISN</th>
                                    <th style="width:100px">Nama Siswa</th>
                                    <th style="width:30px">Kelas</th>
                                    <th style="width:20px">TP</th>
                                </tr>
                            </thead>
                            <tfoot id="show_footer2">
                                <!-- Data footer via JS -->
                            </footer>
                            <tbody id="show_data2">
                                <!-- Data body via JS -->
                            </tbody>
                        </table>				
                    </div>
                </div> 
                <!--akhir tabel-->
            </div>
        </div>
        

    </div>
    

    <!-- khusus menyimpan data yang akan didestroy -->
    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	
    

</div>

<script type="text/javascript">
    let data1Datatable;
    let data2Datatable;
    
    document.addEventListener("DOMContentLoaded", function() {
        
        //persiapan button dan modal
        const btn_proses1 = document.getElementById('btn_proses1');
        //persiapan
        const idtp1 = document.getElementById('idtp1');
        const tp2 = document.getElementById('tp2');
        const idkelas1 = document.getElementById('idkelas1');
        const idkelas2 = document.getElementById('idkelas2');

        btn_proses1.addEventListener('click', function () {
            swal_proses();            
        });

        //menampilkan combo tp1
        tampil_listtp1()
        function tampil_listtp1() {
            fetch('{{ route('sips01.transaksi.naikkelas_listtp') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idtp1) {
                    idtp1.innerHTML = data;
                    idtp1.value = '{{ $idtp }}';
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }
        //menampilkan combo kelas1
        tampil_listkelas1()
        function tampil_listkelas1() {
            fetch('{{ route('sips01.transaksi.naikkelas_listkelas') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idkelas1) {
                    idkelas1.innerHTML = data;
                    idkelas1.value = '{{ $idkelas }}';
                    idkelas2.innerHTML = data;
                    idkelas2.value = '{{ $idkelas2 }}';

                    setTimeout(() => {
                        idtp1.click();
                    }, 100);
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }

        idtp1.addEventListener('click', function () {
            const tp = idtp1.options[idtp1.selectedIndex].text;
            isitpbaru(tp);
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    data1Datatable.ajax.reload(null, false);
                    data2Datatable.ajax.reload(null, false);
                }, 200);
            }, 500);            
        });
        
        idkelas1.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    data1Datatable.ajax.reload(null, false);
                }, 200);
            }, 500);            
        });
        idkelas2.addEventListener('click', function () {
            setTimeout(() => {
                kirim_syarat();
                setTimeout(() => {
                    data2Datatable.ajax.reload(null, false);
                }, 200);
            }, 500);            
        });

        function isitpbaru(tp){
            var a = tp.split("/");
            var x = a[1];
            var y = parseInt(x)+1;
            var tpbaru = x+'/'+y;
            return tp2.value = tpbaru;
            // return $('#tp2').val(x+'/'+y);
            setTimeout(() => {
                data2Datatable.ajax.reload(null, false);
            }, 200);
        }

        
        setTimeout(() => {
            data1Datatable = tampil_data1();    
            data2Datatable = tampil_data2();    
        }, 1000);
        
        function tampil_data1(){
            let i = 1;
            return $('#data1').DataTable({
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
                ajax: "{{ route('sips01.transaksi.naikkelas_show1') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tp.tp', name: 'tp.tp', orderable: true, searchable: true, className: 'dt-center' },
                ]
            });
        }

        function tampil_data2(){
            let i = 1;
            return $('#data2').DataTable({
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
                ajax: "{{ route('sips01.transaksi.naikkelas_show2') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tp.tp', name: 'tp.tp', orderable: true, searchable: true, className: 'dt-center' },
                ]
            });
        }

        function tampil_dataTable(){   
            data1Datatable.ajax.reload(null, false);
            data2Datatable.ajax.reload(null, false);
        }

        function kirim_syarat() {
            
            const idtp1 = document.getElementById('idtp1').value;
            const tp2 = document.getElementById('tp2').value;
            const idkelas1 = document.getElementById('idkelas1').value;
            const idkelas2 = document.getElementById('idkelas2').value;
            
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('tp2', tp2);
                formData.append('idkelas1', idkelas1);
                formData.append('idkelas2', idkelas2);

            // Ambil token CSRF dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Menggunakan Fetch API bawaan browser
            fetch("{{ route('sips01.transaksi.naikkelas_kirimsyarat') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    // Catatan: Jangan set 'Content-Type' manual saat menggunakan FormData, 
                    // browser akan otomatis mengaturnya termasuk boundary multipart-nya.
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan pada server.');
                }
                return response.json(); // atau response.text() jika server tidak mengembalikan JSON
            })
            .then(data => {
                // Pengganti sukses AJAX
                setTimeout(() => {
                    tampil_dataTable(); 
                }, 500);
                Swal.close();
            })
            .catch(error => {
                // Pengganti error AJAX
                console.error('Error:', error);
                Swal.close();
            });
        }

       function swal_proses(){
            const tp1 = idtp1.options[idtp1.selectedIndex].text;
            const tp2 = document.getElementById('tp2').value;
            const kelas1 = idkelas1.options[idkelas1.selectedIndex].text;
            const kelas2 = idkelas2.options[idkelas2.selectedIndex].text;

            Swal.fire({
            title: 'Are you sure process?',
            // text: kelas1 + '(' + tp1 + ') level up to ' + kelas2 + '(' + tp2 + ')',
            html: '<h2>' + kelas1 + ' <i class="bi-arrow-up-right fs-2 fw-bold"></i> ' + kelas2 + '</h2>',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, Process !",
            cancelButtonText: "No, cancel !",
            }).then((result) => {
                if (result.isConfirmed) {
                    data_proses();            
                }
            })

            
        } 

        function data_proses() {
            swalsedangproses();
            const idtp1 = document.getElementById('idtp1').value;
            const tp2 = document.getElementById('tp2').value;
            const idkelas1 = document.getElementById('idkelas1').value;
            const idkelas2 = document.getElementById('idkelas2').value;
            
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('tp2', tp2);
                formData.append('idkelas1', idkelas1);
                formData.append('idkelas2', idkelas2);

            // Ambil token CSRF dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Menggunakan Fetch API bawaan browser
            fetch("{{ route('sips01.transaksi.naikkelas_proses') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    // Catatan: Jangan set 'Content-Type' manual saat menggunakan FormData, 
                    // browser akan otomatis mengaturnya termasuk boundary multipart-nya.
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan pada server.');
                }
                return response.json(); // atau response.text() jika server tidak mengembalikan JSON
            })
            .then(data => {
                // Pengganti sukses AJAX
                setTimeout(() => {
                    tampil_dataTable(); 
                }, 500);
                swal.close();
                // swalsuksesproses('Kenaikan Kelas');
            })
            .catch(error => {
                // Pengganti error AJAX
                console.error('Error:', error);
                swal.close();
                // swalgagalproses('Kenaikan Kelas');
            });

            setTimeout(() => {
                data2Datatable.ajax.reload(null, false);
            }, 1000);
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
        
        function swalsuksesproses(x){
            Swal.fire({
                icon: 'success',
                title: 'Process successfully',
                text: x,
                timer:1000,
                customClass: {
                    confirmButton: 'btn btn-primary rounded-3'
                },
                buttonsStyling: false
            })
        }

        function swalgagalproses(x){
            Swal.fire({
                icon: 'error',
                title: 'Oops...failed to process',
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