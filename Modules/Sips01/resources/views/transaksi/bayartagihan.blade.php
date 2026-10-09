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
                        <select name="idkelasx1" id="idkelasx1" value="{{ $idkelas }}" class="form-select" style="pointer-events: none;" onfocus="this.blur();" readonly>
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

            <div class="col-md-4">
                <!-- Baris Filter 1 -->
                <div class="row mb-1 align-items-center">
                    <input type="hidden" name="iddatasiswax1" id="iddatasiswax1" value="0">
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
                                    <select name="idjenistagihan1" id="idjenistagihan1"class="form-select" autofocus>
                                        <option value="" selected disabled>-- Pilih Jenis Tagihan --</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-1 align-items-center">
                                <label for="iddataguru1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Bendahara Penerima
                                </label>
                                <div class="col-sm-8">
                                    <select name="iddataguru1" id="iddataguru1"class="form-select" style="pointer-events: none;" onfocus="this.blur();" readonly>
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
                                    <input type="search" name="targetbayar1" id="targetbayar1" class="form-control text-sm-end" placeholder="0" value="{{ old('targetbayar1') }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="sudahbayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Sudah Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="sudahbayar1" id="sudahbayar1" class="form-control text-sm-end" placeholder="0" value="{{ old('sudahbayar1') }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="bayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="bayar1" id="bayar1" class="form-control text-sm-end" placeholder="0" value="{{ old('bayar1') }}" onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);" >
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="kurangbayar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Kurang Bayar
                                </label>
                                <div class="col-sm-8">
                                    <input type="search" name="kurangbayar1" id="kurangbayar1" class="form-control text-sm-end" placeholder="0" value="{{ old('kurangbayar1') }}" readonly>
                                </div>
                            </div>
                            <div class="row mb-1 align-items-center">
                                <label for="idbulan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                    Untuk Bulan
                                </label>
                                <div class="col-sm-8">
                                    <select name="idbulan1" id="idbulan1"class="form-select">
                                        <option value="" selected disabled>-- Pilih bulan --</option>
                                    </select>
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
                                                <th style="width:20px">Kelas</th>
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

    <!-- ModalPrint modal fade-->
        <div class="modal fade" id="ModalPrint" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered">
                <div class="modal-content shadow-lg border-0">
                    
                    <!-- Modal Header -->
                    <div class="modal-header bg-warning text-white">
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
                                        Tgl Transaksi
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="tgltransaksiprint"></span>
                                    </label>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold px-0">
                                        Jenis Tagihan
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="jenistagihanprint"></span>
                                    </label>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold px-0">
                                        Nomor Bukti
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="nomorbuktiprint"></span>
                                    </label>
                                </div>
                                <div class="row mb-1 align-items-center">
                                    <label class="col-sm-3 col-form-label text-sm-end fw-semibold px-0">
                                        Bayar
                                    </label>
                                    <label class="col-sm-1 col-form-label text-sm-center fw-semibold px-0">
                                        :
                                    </label>
                                    <label class="col-sm-8 col-form-label text-sm-first fw-semibold px-0">
                                        <span id="bayarprint"></span>
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
                                <button type="button" id="btn_printkwitansi1" class="btn btn-outline-primary"><i class="i bi-printer-fill me-1"></i> Print Data</button>
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
    let caridatasiswa1Datatable;
    let listkelasx1Datatable;
    let listkelas1Datatable;

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

    function tgl_sekarang(){
        var x = new Date();
        var tgl = x.getDate();
        if(tgl<10){
            tgl='0'+tgl;
        }
        var bln = x.getMonth()+1;
        if(bln<10){
            bln='0'+bln;
        }
        var thn = x.getFullYear();

			return thn+'-'+bln+'-'+tgl;

	}
   
    document.getElementById('tgltransaksi1').value = tgl_sekarang();

        //persiapan button dan modal
        const ModalAdd = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalAdd'));
        const ModalCaridatasiswa = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalCaridatasiswa'));
        const ModalPrint = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalPrint'));
        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        const btn_cariidx1 = document.getElementById('btn_cariidx1');
        const btn_printkwitansi1 = document.getElementById('btn_printkwitansi1');
        
        //persiapan data
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const iddatasiswax1 = document.getElementById('iddatasiswax1');        
        const idtpx1 = document.getElementById('idtpx1');        
        const idkelasx1 = document.getElementById('idkelasx1');        
        const ecardx1 = document.getElementById('ecardx1');        
        const nisx1 = document.getElementById('nisx1');        
        const nisnx1 = document.getElementById('nisnx1');        
        const namalengkapx1 = document.getElementById('namalengkapx1');        
        const tgltransaksi1 = document.getElementById('tgltransaksi1');        
        const idjenistagihan1 = document.getElementById('idjenistagihan1');        
        const iddataguru1 = document.getElementById('iddataguru1');        
        const nomorbukti1 = document.getElementById('nomorbukti1');        
        const keterangan1 = document.getElementById('keterangan1');        

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
        const dragModalCaridatasiswa = document.getElementById('ModalCaridatasiswa');
        dragModalCaridatasiswa.addEventListener('hidden.bs.modal', function () {
            const dialog = this.querySelector('.modal-dialog');
            dialog.style.position = '';
            dialog.style.margin = '';
            dialog.style.transform = '';
            dialog.style.left = '';
            dialog.style.top = '';
            dialog.style.width = '';
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
            if(document.getElementById('ecardx1').value){
                btn_baru_click();
                id1.value = '0';
                cek1.value = '0';
                keterangan1.value = '';        
                ModalAdd.show();            
            }else{
                toastgagaltambah();
            }


        });

        const tgltransaksix = new Datepicker(tgltransaksi1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
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
                ],
                rowCallback: function(row, data, index) {
                    if (data?.nomorbuktilapor) {
                        if (data?.nomorbuktiapp) {
                            row.classList.add('sudah-app');    
                        }else{
                            row.classList.add('sudah-lapor');
                        }

                    }
                }
            });
        }

        setTimeout(() => {
            caridatasiswa1Datatable = tampil_caridatasiswa1();    
        }, 1000);

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
                    url: "{{ route('sips01.transaksi.bayartagihan_showdatasiswa') }}",
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
                    { data: 'kelas', name: 'kelas', orderable: true, searchable: true, className: 'dt-center' },
                ]
            });
        }

        btn_cariidx1.addEventListener('click', function () {
            caridatasiswa1Datatable.ajax.reload(null, false);
            ModalCaridatasiswa.show();            
        });

        document.getElementById('show_caridatasiswa1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest(['.item_ecard','.item_nis','.item_nisn','.item_namalengkap','.item_kelas']);
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var nis1 = targetButton.getAttribute('data2');
                var nisn1 = targetButton.getAttribute('data3');
                var namalengkap1 = targetButton.getAttribute('data4');
                var ecard1 = targetButton.getAttribute('data5');
                var idkelas1 = targetButton.getAttribute('data6');
                var iddatasiswa1 = targetButton.getAttribute('data7');
                
                document.getElementById('iddatasiswax1').value = iddatasiswa1; 
                document.getElementById('idkelasx1').value = idkelas1; 
                document.getElementById('ecardx1').value = ecard1; 
                document.getElementById('nisx1').value = nis1; 
                document.getElementById('nisnx1').value = nisn1; 
                document.getElementById('namalengkapx1').value = namalengkap1; 
                document.getElementById('cariidx1').value = ecard1; 

                setTimeout(() => {
                    const element = document.getElementById('idkelasx1');
                        if (element) {
                            element.click();
                        }
                }, 1000);
                ModalCaridatasiswa.hide();
                setTimeout(() => {
                    kirim_syarat();

                    tampil_listbulan1();
                    tampil_listjenistagihan1();
                    setTimeout(() => {
                        document.getElementById('idjenistagihan1').click();
                    }, 2000);
                    tampil_listdataguru1();

                }, 1000);
            }
        });

        document.getElementById('cariidx1').addEventListener('keypress', function (e) {
            // Mengosongkan nilai input (Alternatif jQuery .val(''))
            document.getElementById('ecardx1').value = '';
            document.getElementById('nisx1').value = '';
            document.getElementById('nisnx1').value = '';
            document.getElementById('namalengkapx1').value = '';
            document.getElementById('iddatasiswax1').value = '0';

            // Cek apakah tombol yang ditekan adalah Enter (e.key === 'Enter')
            if (e.key === 'Enter') {
                var x = this.value;
                cariid(x);
                setTimeout(() => {
                    if(document.getElementById('nisnx1').value==''){
                       document.getElementById('btn_cariidx1').click();                                            
                    }
                }, 2000);
                
            }
            
        });

        function cariid(cari){
            const idtp1= document.getElementById('idtpx1').value;
            const cari1=cari;
            // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const payload = {
                    cari1: cari1,
                    idtp1: idtp1
                };
            // Menggunakan Fetch API (Pengganti $.ajax)
            fetch('{{route("sips01.transaksi.bayartagihan_cariid")}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload) // Mengubah objek JS menjadi string JSON
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Mengonversi respon server ke JSON
            })
            .then(data => {
                const resultData = data.data;

                // Loop data menggunakan forEach (Standar Modern Vanilla JS)
                resultData.forEach(item => {
                    document.getElementById('ecardx1').value = item.ecard;
                    document.getElementById('nisx1').value = item.nis;
                    document.getElementById('nisnx1').value = item.nisn;
                    document.getElementById('namalengkapx1').value = item.namalengkap;
                    document.getElementById('iddatasiswax1').value = item.id;
                    document.getElementById('idkelasx1').value = item.idkelas;
                    document.getElementById('idkelasx1').click();
                    
                });
                setTimeout(() => {
                    kirim_syarat();

                    tampil_listbulan1();
                    tampil_listjenistagihan1();
                    setTimeout(() => {
                        document.getElementById('idjenistagihan1').click();
                    }, 2000);
                    tampil_listdataguru1();

                }, 1000);

            })
            .catch(error => {
                console.error('Error:', error);
            });
            
        }

        document.getElementById('bodyAdd').addEventListener('mousemove', function () {
            var x = document.getElementById('bayar1').value;
            var pjx = x.length;
            if(pjx=='0'){
                document.getElementById('bayar1').value = '0';
            }

            var x = document.getElementById('bayar1').value;
            var y = document.getElementById('sudahbayar1').value;
            var z = document.getElementById('targetbayar1').value;
            var r = document.getElementById('kurangbayar1').value;
            var x1 = parseFloat(x.replace(/[^,\d]/g, '').toString());
            var y1 = parseFloat(y.replace(/[^,\d]/g, '').toString());
            var z1 = parseFloat(z.replace(/[^,\d]/g, '').toString());
            var r1 = parseFloat(r.replace(/[^,\d]/g, '').toString());
            var p1 = formatAngka(parseFloat(z1)-parseFloat(y1)-parseFloat(x1),'');
            var q1 = formatAngka(parseFloat(z1)-parseFloat(y1),'');
            if(x.length=='0'){
                document.getElementById('targetbayar1').value = q1;
                document.getElementById('bayar1').value = '0';
            }else{
                document.getElementById('kurangbayar1').value = p1;
            }
            
            if(parseFloat(z1)-parseFloat(y1)<=parseFloat(x1)){
                var x = $('#bayar1').val(formatAngka(parseFloat(z1)-parseFloat(y1),''));

                document.getElementById('kurangbayar1').value = '0'; 
            }

        })

        document.getElementById('bayar1').addEventListener('keyup', function () {
            var x = document.getElementById('bayar1').value;
            var y = document.getElementById('sudahbayar1').value;
            var z = document.getElementById('targetbayar1').value;
            var r = document.getElementById('kurangbayar1').value;
            var x1 = parseFloat(x.replace(/[^,\d]/g, '').toString());
            var y1 = parseFloat(y.replace(/[^,\d]/g, '').toString());
            var z1 = parseFloat(z.replace(/[^,\d]/g, '').toString());
            var r1 = parseFloat(r.replace(/[^,\d]/g, '').toString());
            var p1 = formatAngka(parseFloat(z1)-parseFloat(y1)-parseFloat(x1),'');
            var q1 = formatAngka(parseFloat(z1)-parseFloat(y1),'');
            if(x.length=='0'){
                document.getElementById('targetbayar1').value = q1;
                document.getElementById('bayar1').value = '0';
            }else{
                document.getElementById('kurangbayar1').value = p1;
            }
            
            if(parseFloat(z1)-parseFloat(y1)<=parseFloat(x1)){
                var x = $('#bayar1').val(formatAngka(parseFloat(z1)-parseFloat(y1),''));

                document.getElementById('kurangbayar1').value = '0'; 
            }
        });

        function nomorbukti(){
            const idtp1 = document.getElementById('idtpx1').value;
            const tgltransaksi1 = document.getElementById('tgltransaksi1').value;
            const iddatasiswa1 = document.getElementById('iddatasiswax1').value;
            const idjenistagihan1 = document.getElementById('idjenistagihan1').value;
            const idkelas1 = document.getElementById('idkelasx1').value;

            // const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const payload = {
                    tgltransaksi1:tgltransaksi1, 
                    iddatasiswa1:iddatasiswa1,
                    idjenistagihan1:idjenistagihan1,
                    idkelas1:idkelas1,                   
                    idtp1: idtp1
                };

            // Menggunakan Fetch API (Pengganti $.ajax)
            fetch('{{route("sips01.transaksi.bayartagihan_nomorbukti")}}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(payload) // Mengubah objek JS menjadi string JSON
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Mengonversi respon server ke JSON
            })
            .then(data => {
                const resultData = data.data;

                // Loop data menggunakan forEach (Standar Modern Vanilla JS)
                resultData.forEach(item => {
                    var bayarx = document.getElementById('bayar1').value;
                    var bayar = parseFloat(bayarx.replace(/[^,\d]/g, '').toString());
                    document.getElementById('nomorbukti1').value = item.nomorbukti;
                    document.getElementById('iddataguru1').value = item.iddataguru;
                    document.getElementById('targetbayar1').value = formatAngka(item.targetbayar,'');
                    document.getElementById('sudahbayar1').value = formatAngka(item.sudahbayar,'');
                    document.getElementById('bayar1').value = formatAngka(bayar,'');
                    document.getElementById('kurangbayar1').value = formatAngka(item.targetbayar - item.sudahbayar - bayar,'');
                    document.getElementById('nomorb11').value = item.nomorb1;
                    
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
            
        }
        
        //menampilkan combo tpx1
        function tampil_listtpx1(){				
            fetch('{{ route("sips01.transaksi.bayartagihan_listtp") }}')
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
        //menampilkan combo kelasx1
        function tampil_listkelasx1(){				
            fetch('{{ route("sips01.transaksi.bayartagihan_listkelas") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(idkelasx1){
                        idkelasx1.innerHTML = data;
                        idkelasx1.value = "{{ $idkelas }}";
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
                });
        }

        //menampilkan combo jenistagihan1    
        function tampil_listjenistagihan1(){				
            fetch('{{ route("sips01.transaksi.bayartagihan_listjenistagihan") }}')
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
        //menampilkan combo dataguru1 
        function tampil_listdataguru1(){				
            fetch('{{ route("sips01.transaksi.bayartagihan_listdataguru") }}')
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
        //menampilkan combo bulan1 
        function tampil_listbulan1(){				
            fetch('{{ route("sips01.transaksi.bayartagihan_listbulan") }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // Menggunakan .text() karena data tampaknya berupa HTML string
                })
                .then(data => {
                    if(idbulan1){
                        idbulan1.innerHTML = data;
                    }
                })
                .catch(error => {
                    console.error('Error fetching data:', error);
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
        
        setTimeout(() => {
            load_walikelas();
        }, 2000);

        idtpx1.addEventListener('click', function () {
            //kosongkan data
            document.getElementById('iddatasiswax1').value = '0';
            document.getElementById('ecardx1').value = '';
            document.getElementById('nisx1').value = '';
            document.getElementById('nisnx1').value = '';
            document.getElementById('namalengkapx1').value = '';

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
            const url = `{{ url('/sips01/transaksi/bayartagihanshowwali') }}`;
            
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

        document.getElementById('idjenistagihan1').addEventListener('click', function () {
            setTimeout(() => {
                nomorbukti();
            }, 500);
        });
        
        function kirim_syarat() {
            // Mengambil nilai dari elemen input
            const idtp1= document.getElementById('idtpx1').value;
            const idkelas1= document.getElementById('idkelasx1').value;
            const iddatasiswa1= document.getElementById('iddatasiswax1').value;
            const id1= document.getElementById('id1').value;

            // Membuat objek FormData
            let formData = new FormData();
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('id1', id1);

            // Mengambil CSRF Token dari meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Mengirim data menggunakan Fetch API (Vanilla JS)
            fetch("{{ route('sips01.transaksi.bayartagihan_kirimsyarat') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    // Catatan: 'Content-Type' tidak perlu diatur manual jika menggunakan FormData. 
                    // Browser akan mengaturnya otomatis sebagai 'multipart/form-data' beserta boundary-nya.
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Terjadi kesalahan pada jaringan/server.');
                }
                return response.json(); // Atau response.text() tergantung return dari controller Laravel Anda
            })
            .then(data => {
                // Aksi sukses (menggantikan success pada $.ajax)
                tampil_dataTable(); 
                // alert('sukses');
            })
            .catch(error => {
                // Aksi error (menggantikan error pada $.ajax)
                // alert('gagal');
                console.error('Error:', error);
            });
        }

        function tampil_dataTable(){   
            data1Datatable.ajax.reload(null, false);
            caridatasiswa1Datatable.ajax.reload(null, false);
        }

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });

        function data_simpan(){            
            const id1= document.getElementById('id1').value;			
            const idtp1= document.getElementById('idtpx1').value;	
            const tgltransaksi1= document.getElementById('tgltransaksi1').value;	
            const iddatasiswa1= document.getElementById('iddatasiswax1').value;	
            const idjenistagihan1= document.getElementById('idjenistagihan1').value;	
            const iddataguru1= document.getElementById('iddataguru1').value;
            const nomorbukti1= document.getElementById('nomorbukti1').value;
            const nomorb11= document.getElementById('nomorb11').value;
            const targetbayar1= document.getElementById('targetbayar1').value.replace(/[^,\d]/g, '').toString();
            const sudahbayar1= document.getElementById('sudahbayar1').value.replace(/[^,\d]/g, '').toString();
            const bayar1= document.getElementById('bayar1').value.replace(/[^,\d]/g, '').toString();
            const kurangbayar1= document.getElementById('kurangbayar1').value.replace(/[^,\d]/g, '').toString();
            const idbulan1= document.getElementById('idbulan1').value.replace(/[^,\d]/g, '').toString();
            const keterangan1= document.getElementById('keterangan1').value;

            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('tgltransaksi1', tgltransaksi1);
                formData.append('idtp1', idtp1);
                formData.append('iddatasiswa1', iddatasiswa1);
                formData.append('idjenistagihan1', idjenistagihan1);
                formData.append('iddataguru1', iddataguru1);
                formData.append('nomorbukti1', nomorbukti1);
                formData.append('nomorb11', nomorb11);
                formData.append('targetbayar1', targetbayar1);
                formData.append('sudahbayar1', sudahbayar1);
                formData.append('bayar1', bayar1);
                formData.append('kurangbayar1', kurangbayar1);
                formData.append('idbulan1', idbulan1);
                formData.append('keterangan1', keterangan1);;
            
                fetch("{{ route('sips01.transaksi.bayartagihan_create') }}", {
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
                    swalsuksestambah(nomorbukti1);
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    console.error('Error:', error);
                    swalgagaltambah(nomorbukti1);
                });    
        }

        document.getElementById('show_data1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_print');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                var tgltransaksi1 = targetButton.getAttribute('data2');
                var jenistagihan1 = targetButton.getAttribute('data3');
                var nomorbukti1 = targetButton.getAttribute('data4');
                var bayar1 = targetButton.getAttribute('data5');
                
                document.getElementById('id1').value = id1;
                document.getElementById('tgltransaksiprint').innerText = tgltransaksi1;
                document.getElementById('jenistagihanprint').innerText = jenistagihan1;
                document.getElementById('nomorbuktiprint').innerText = nomorbukti1;
                document.getElementById('bayarprint').innerText = formatAngka(bayar1,'');

                ModalPrint.show();
                
            }
        });

        btn_printkwitansi1.addEventListener('click', function (e) {
            e.preventDefault();
            var id3 = document.getElementById('id3').value;
            document.getElementById('idtpx1').click();
            setTimeout(() => {
                window.open('{{ route('sips01.transaksi.bayartagihan_printkwintansi') }}');
                ModalPrint.hide();
            }, 500);
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
            const url = `{{ url('/sips01/transaksi/bayartagihanedit') }}/${id1}`;
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
                    document.getElementById('idjenistagihan1').value = resultData[i].idjenistagihan;
                    document.getElementById('iddataguru1').value = resultData[i].iddataguru;
                    document.getElementById('nomorbukti1').value = resultData[i].nomorbukti1;
                    document.getElementById('targetbayar1').value = formatAngka(resultData[i].targetbayar,'');
                    document.getElementById('sudahbayar1').value = formatAngka(resultData[i].sudahbayar,'');
                    document.getElementById('bayar1').value = formatAngka(resultData[i].bayar,'');
                    document.getElementById('kurangbayar1').value = formatAngka(resultData[i].kurangbayar,'');
                    document.getElementById('idbulan1').value = resultData[i].idbulan;
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

        function toastgagaltambah(){
            var a='Data siswa belum dipilih.<br><br>';
            var x=a+'Gagal tambah data.</br>Terima kasih.';
            toastr.error(x);
        }
        
    });
</script>

@endsection