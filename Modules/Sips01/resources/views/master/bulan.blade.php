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
                <div class="row mb-1 align-items-center">
                    <label for="idtp1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Tahun Pelajaran
                    </label>
                    <div class="col-sm-5">
                        <select name="idtp1" id="idtp1" value="{{ $idtp }}" class="form-select">
                            <option value="" selected disabled>-- Pilih TP --</option>
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
							<th style='width:50px'>Tahun Pelajaran</th>
							<th style='width:100px'>Bulan</th>
							<th style='width:50px'>Tanggal Awal</th>
							<th style='width:50px'>Tanggal Akhir</th>
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
    
    <!-- khusus menyimpan data yang akan didestroy -->
    <input name="id3" id="id3"type="hidden">	
    <input name="data3a" id="data3a"type="hidden">	
    <input name="data3b" id="data3b"type="hidden">	
    <input name="data3c" id="data3c"type="hidden">	
    

</div>

<script type="text/javascript">
    function hanyaTp(event) {
         var angka = (event.which) ? event.which : event.keyCode
         if (angka != 46 && (angka > 31) && (angka < 48 || angka > 57) && angka != 47 )
           return false;
         return true;
         //47 = /
         //48 - 57 = 0 - 9
       }

    let data1Datatable;
    
    document.addEventListener("DOMContentLoaded", function() {
        
        //persiapan button dan modal
        const btn_tambah1 = document.getElementById('btn_tambah1');
        
        //persiapan data
        const idtp1 = document.getElementById('idtp1');        

        function btn_baru_click(){
            // 
        }
        
        function btn_simpan_click(){      
            // 
        }

        function btn_edit1_click(){      
        //    
        }

        btn_tambah1.addEventListener('click', function () {
            data_simpan();
            tampil_dataTable();
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
                ajax: "{{ route('sips01.master.bulan_show') }}",
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'tp.tp', name: 'tp.tp', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'namabulan', name: 'namabulan', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tglawal', name: 'tglawal', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tglakhir', name: 'tglakhir', orderable: true, searchable: true, className: 'dt-center' },
                ]
            });
        }

    tampil_listtp()
    //menampilkan combo tp
    function tampil_listtp(){				
        $.ajax({
            type: 'get',
            url   : '{{route('sips01.master.bulan_listtp')}}',
            
            success: function(data){		    
                idtp1.innerHTML = data;
                $("#idtp1").val({{ $idtp }});
            }
        })
    }

    setInterval(() => {
        idtp1.change();
        kirim_syarat();
    }, 500);

    idtp1.addEventListener('change', function () {
        setTimeout(() => {
            kirim_syarat();
        }, 500);            
    });

    function kirim_syarat(){
        const idtp1= document.getElementById('idtp1').value;
        let formData = new FormData();
            formData.append('idtp1', idtp1);

        $.ajax({
            enctype: 'multipart/form-data',
            type   : 'post',
            url    : '{{route('sips01.master.bulan_kirimsyarat')}}',
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

        function data_simpan(){   
            const idtp1= document.getElementById('idtp1').value;			
            const tp1 = document.getElementById('idtp1').options[document.getElementById('idtp1').selectedIndex].text;
            let formData = new FormData();
                formData.append('idtp1', idtp1);
            
                fetch("{{ route('sips01.master.bulan_create') }}", {
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
                    
                    // swalsuksestambah(tp1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    // swalgagaltambah(tp1);
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