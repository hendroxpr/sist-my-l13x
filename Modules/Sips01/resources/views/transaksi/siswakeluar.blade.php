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
                            <option value="" selected disabled>-- Pilih TP --</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-1 align-items-center">
                    <label for="idkelasx1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Kelas
                    </label>
                    <div class="col-sm-7">
                        <select name="idkelasx1" id="idkelasx1" value="{{ $idkelas }}" class="form-select">
                            <option value="" selected disabled>-- Pilih Kelas --</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-1 align-items-center">
                    <label for="idkecamatanx1" class="col-sm-3 col-form-label text-sm-end fw-semibold">
                        Wali Kelas
                    </label>
                    <div class="col-sm-7">
                        <input type="search" name="walikelasx1" id="walikelasx1" class="form-control" placeholder="Wali Kelas" readonly>
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
                    <button id="btn_tambah1" name="btn_tambah1" type="button" class="btn btn-primary d-none align-items-center gap-2">
                        <i class="bi bi-plus-lg fs-6 fw-bold"></i> Tambah
                    </button>
                    <button id="btn_keluarsemua1" name="btn_keluarsemua1" type="button" class="btn btn-warning d-inline-flex align-items-center gap-2">
                        <i class="bi bi-mortarboard-fill fs-6 fw-bold"></i> Keluar/lulus semua
                    </button>
                    
                </div> 
            </div>
        </div>


        <!-- tab-pesertadidik1 -->
        <ul class="nav nav-tabs" id="tab-pesertadidik1" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="infoawal-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#infoawal-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="#infoawal-isi-tab-pesertadidik1" aria-selected="true">Informasi Awal</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="infosekolah-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#infosekolah-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="infosekolah-isi-tab-pesertadidik1" aria-selected="false">Informasi Sekolah</button>
            </li>            
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="infokerja-tab-pesertadidik1" data-bs-toggle="pill" data-bs-target="#infokerja-isi-tab-pesertadidik1" type="button" role="tab" aria-controls="infokerja-isi-tab-pesertadidik1" aria-selected="false">Informasi Kerja</button>
            </li>            
        </ul>

        <!-- tabcontent-tab-pesertadidik1 -->
        <div class="tab-content p-3 border border-top-0" id="tabcontent-tab-pesertadidik1">            
            <!-- infoawal-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade show active" id="infoawal-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="infoawal-tab-pesertadidik1" tabindex="0">
                <div id="reload-infoawal1" class="table-responsive">
                    <table id="infoawal1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:20px">NIS</th>
                                <th style="width:20px">NISN</th>
                                <th style="width:100px">Nama Siswa</th>
                                <th style="width:20px">Kelas</th>
                                <th style="width:20px">TP Masuk</th>
                                <th style="width:20px">Tgl Diterima</th>
                                <th style="width:20px">TP Keluar</th>
                                <th style="width:20px">Tgl Keluar</th>
                                <th style="width:100px">Alasan Keluar</th>
                                <th style="width:100px">Alasan Setelah Keluar</th>
                                <th style="width:10px">Aktif<br>(Y/N)</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_infoawal1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_infoawal1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end infoawal-isi-tab-pesertadidik1 -->
            
            <!-- infosekolah-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="infosekolah-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="infosekolah-tab-pesertadidik1" tabindex="0">
                <div id="reload-infosekolah1" class="table-responsive">
                    <table id="infosekolah1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:20px">NIS</th>
                                <th style="width:20px">NISN</th>
                                <th style="width:100px">Nama Siswa</th>
                                <th style="width:20px">Kelas</th>
                                <th style="width:20px">Tgl Ijazah</th>
                                <th style="width:20px">No.Ijazah</th>
                                <th style="width:20px">Tgl SKHUN</th>
                                <th style="width:20px">No.SKHUN</th>
                                <th style="width:20px">Keterangan Lulus</th>
                                <th style="width:20px">Sekolah Lanjut</th>
                                <th style="width:20px">Jurusan</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_infosekolah1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_infosekolah1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end infosekolah-isi-tab-pesertadidik1 -->

            <!-- infokerja-isi-tab-pesertadidik1 -->
            <div class="tab-pane fade" id="infokerja-isi-tab-pesertadidik1" role="tabpanel" aria-labelledby="infokerja-tab-pesertadidik1" tabindex="0">
                <div id="reload-infokerja1" class="table-responsive">
                    <table id="infokerja1" class="table table-bordered table-striped table-hover align-middle" style="width: 100%">
                        <thead class="table-light">
                            <tr>
                                <th style="width:10px;">#</th>
                                <th style="width:20px">NIS</th>
                                <th style="width:20px">NISN</th>
                                <th style="width:100px">Nama Siswa</th>
                                <th style="width:20px">Kelas</th>
                                <th style="width:40px">Kerja Di</th>
                                <th style="width:20px">Tgl Mulai</th>
                                <th style="width:50px">Nama Perusahaan</th>
                                <th style="width:20px">Penghasilan</th>
                                <th style="width:10px">Action</th>
                            </tr>
                        </thead>
                        <tfoot id="show_footer_infokerja1">
                            <!-- Data footer via JS -->
                        </footer>
                        <tbody id="show_infokerja1">
                            <!-- Data body via JS -->
                        </tbody>
                    </table>				
                </div>
            </div>
            <!-- end infokerja-isi-tab-pesertadidik1 -->
            

        </div>
        <!-- end tabcontent-tab-pesertadidik1 -->

    </div>
    <!--akhir tabel-->
    
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

                            <div id="headertop">
                                <div class="row mb-1 align-items-center">
                                    <label for="nis1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        NIS
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="nis1" id="nis1" class="form-control" placeholder="NIS" value="{{ old('nis1') }}" readonly>
                                    </div>
                                </div>
                                
                                <div class="row mb-1 align-items-center">
                                    <label for="nisn1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        NISN
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="nisn1" id="nisn1" class="form-control" placeholder="NISN" value="{{ old('nisn1') }}" readonly>
                                    </div>
                                </div>

                                <div class="row mb-2 align-items-center">
                                    <label for="namalengkap1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                        Nama Siswa
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="search" name="namalengkap1" id="namalengkap1" class="form-control" placeholder="nama siswa" value="{{ old('namalengkap1') }}" readonly>
                                    </div>
                                </div>
                            </div>

                            <!-- tab-pesertadidik2 -->
                            <ul class="nav nav-tabs" id="tab-pesertadidik2" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="infoawal-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#infoawal-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="#infoawal-isi-tab-pesertadidik2" aria-selected="true">Informasi Awal</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="infosekolah-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#infosekolah-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="infosekolah-isi-tab-pesertadidik2" aria-selected="false">Informasi Sekolah</button>
                                </li>            
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="infokerja-tab-pesertadidik2" data-bs-toggle="pill" data-bs-target="#infokerja-isi-tab-pesertadidik2" type="button" role="tab" aria-controls="infokerja-isi-tab-pesertadidik2" aria-selected="false">Informasi Kerja</button>
                                </li>            
                            </ul>

                            <!-- tabcontent-tab-pesertadidik2 -->
                            <div class="tab-content p-3 border border-top-0" id="tabcontent-tab-pesertadidik2">            
                                <!-- infoawal-isi-tab-pesertadidik2 -->
                                <div class="tab-pane fade show active" id="infoawal-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="infoawal-tab-pesertadidik2" tabindex="0">
                                    
                                    <div class="row mb-1 align-items-center">
                                        <label for="idtpkeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            TP Keluar
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="idtpkeluar1" id="idtpkeluar1" class="form-select">
                                                <option value="" selected disabled>-- Pilih TP Keluar --</option>
                                                {{-- Option akan di-render via JS atau @foreach Blade --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-1 align-items-center">
                                        <label for="tglkeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Tgl Keluar
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="tglkeluar1" id="tglkeluar1" maxlength="10" class="form-control" placeholder="tglkeluar" value="{{ old('tglkeluar1') }}">
                                        </div>
                                    </div>

                                    <div class="row mb-1 align-items-center">
                                        <label for="idalasankeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Alasan Keluar
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="idalasankeluar1" id="idalasankeluar1" class="form-select">
                                                <option value="" selected disabled>-- Pilih Alasan Keluar --</option>
                                                {{-- Option akan di-render via JS atau @foreach Blade --}}
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-1 align-items-center">
                                        <label for="idalasansetelahkeluar1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Alasan Sth Keluar
                                        </label>
                                        <div class="col-sm-8">
                                            <select name="idalasansetelahkeluar1" id="idalasansetelahkeluar1" class="form-select">
                                                <option value="" selected disabled>-- Pilih Alasan Setelah Keluar --</option>
                                                {{-- Option akan di-render via JS atau @foreach Blade --}}
                                            </select>
                                        </div>
                                    </div>

                                     <div class="row mb-1 align-items-center">
                                        <label for="aktif1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Aktif
                                        </label>
                                        <div class="col-sm-8">
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="aktif1" id="aktif1xy" value="Y" checked>
                                                    <label class="form-check-label" for="aktif1xy">Y</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="aktif1" id="aktif1xn" value="N">
                                                    <label class="form-check-label" for="aktif1xn">N</label>
                                                </div>
                                                <input name="aktif1" id="aktif1" type="hidden">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end infoawal-isi-tab-pesertadidik2 -->
                                
                                <!-- infosekolah-isi-tab-pesertadidik2 -->
                                <div class="tab-pane fade" id="infosekolah-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="infosekolah-tab-pesertadidik2" tabindex="0">
                                    
                                    <div class="row mb-1 align-items-center">
                                        <label for="tglijasahlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Tgl Ijazah
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="tglijasahlulus1" id="tglijasahlulus1" maxlength="10" class="form-control" placeholder="tgl ijasah lulus" value="{{ old('tglijasahlulus1') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="nomorijasahlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            No. Ijazah
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="nomorijasahlulus1" id="nomorijasahlulus1" maxlength="50" class="form-control" placeholder="nomor ijasah lulus" value="{{ old('nomorijasahlulus1') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="tglskhunlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Tgl SKHUN
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="tglskhunlulus1" id="tglskhunlulus1" maxlength="10" class="form-control" placeholder="tgl SKHUN lulus" value="{{ old('tglskhunlulus1') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="nomorskhunlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            No. SKHUN
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="nomorskhunlulus1" id="nomorskhunlulus1" maxlength="50" class="form-control" placeholder="nomor SKHUN lulus" value="{{ old('nomorskhunlulus1') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="keteranganlulus1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Keterangan Lulus
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea name="keteranganlulus1" id="keteranganlulus1" cols="" rows="5" style="width: 100%"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="sekolahlanjut1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Sekolah Lanjut
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="sekolahlanjut1" id="sekolahlanjut1" maxlength="50" class="form-control" placeholder="sekolah selanjutnya" value="{{ old('sekolahlanjut1') }}">
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="jurusanlanjut1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Jurusan
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="jurusanlanjut1" id="jurusanlanjut1" maxlength="50" class="form-control" placeholder="jurusan" value="{{ old('jurusanlanjut1') }}">
                                        </div>
                                    </div>

                                </div>
                                <!-- end infosekolah-isi-tab-pesertadidik2 -->

                                <!-- infokerja-isi-tab-pesertadidik2 -->
                                <div class="tab-pane fade" id="infokerja-isi-tab-pesertadidik2" role="tabpanel" aria-labelledby="infokerja-tab-pesertadidik2" tabindex="0">
                                    <div class="row mb-1 align-items-center">
                                        <label for="kerjadi1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Bekerja di
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="kerjadi1" id="kerjadi1" maxlength="50" class="form-control" placeholder="bekerja di" value="{{ old('kerjadi1') }}" >
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="tglmulaikerja1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Tgl.Mulai Kerja
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="tglmulaikerja1" id="tglmulaikerja1" maxlength="10" class="form-control" placeholder="Tanggal" value="{{ old('tglmulaikerja1') }}" >
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="namaperusahaan1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Nama Perusahaan
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="namaperusahaan1" id="namaperusahaan1" maxlength="50" class="form-control" placeholder="nama perusahaan" value="{{ old('namaperusahaan1') }}" >
                                        </div>
                                    </div>
                                    <div class="row mb-1 align-items-center">
                                        <label for="penghasilankerja1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                            Penghasilan/bln
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="search" name="penghasilankerja1" id="penghasilankerja1" class="form-control" placeholder="penghasilan1" value="3.000.000" autofocus  onkeydown="return numbersonly(this, event);" onkeyup="javascript:tandaPemisahTitik(this);">
                                        </div>
                                    </div>    
                                </div>
                                <!-- end infokerja-isi-tab-pesertadidik2 -->
                                

                            </div>
                            <!-- end tabcontent-tab-pesertadidik2 -->

                            

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
    
    let infoawal1Datatable;
    let infosekolah1Datatable;
    let infokerja1Datatable;
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

        //persiapan button dan modal
        const ModalAdd = bootstrap.Modal.getOrCreateInstance(document.getElementById('ModalAdd'));
        const modalx = document.getElementById('modalx');
        const warnax = document.getElementById('warnax');
        const iconx = document.getElementById('iconx');
        const bodyx = document.getElementById('bodyx');
        const btn_tambah1 = document.getElementById('btn_tambah1');
        const btn_keluarsemua1 = document.getElementById('btn_keluarsemua1');
        const btn_baru = document.getElementById('btn_baru');
        const btn_simpan = document.getElementById('btn_simpan');
        const headertop = document.getElementById('headertop');
        
        //persiapan data
        const id1 = document.getElementById('id1');        
        const cek1 = document.getElementById('cek1');        
        const idtpx1 = document.getElementById('idtpx1');        
        const idkelasx1 = document.getElementById('idkelasx1');        
        const nis1 = document.getElementById('nis1');        
        const nisn1 = document.getElementById('nisn1');        
        const namalengkap1 = document.getElementById('namalengkap1');        
        const idtpkeluar1 = document.getElementById('idtpkeluar1');        
        const tglkeluar1 = document.getElementById('tglkeluar1');        
        const idalasankeluar1 = document.getElementById('idalasankeluar1');        
        const idalasansetelahkeluar1 = document.getElementById('idalasansetelahkeluar1'); 
        const aktif1 = document.getElementById('aktif1');        
        const aktif1xy = document.getElementById('aktif1xy');        
        const aktif1xn = document.getElementById('aktif1xn');       
        const tglijasahlulus1 = document.getElementById('tglijasahlulus1');       
        const nomorijasahlulus1 = document.getElementById('nomorijasahlulus1');       
        const tglskhunlulus1 = document.getElementById('tglskhunlulus1');       
        const nomorskhunlulus1 = document.getElementById('nomorskhunlulus1');       
        const keteranganlulus1 = document.getElementById('keteranganlulus1');       
        const sekolahlanjut1 = document.getElementById('sekolahlanjut1');       
        const jurusanlanjut1 = document.getElementById('jurusanlanjut1');       
        const bekerjadi1 = document.getElementById('bekerjadi1');       
        const tglmulaikerja1 = document.getElementById('tglmulaikerja1');       
        const namaperusahaan1 = document.getElementById('namaperusahaan1');       
        const penghasilankerja1 = document.getElementById('penghasilankerja1');       

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

        //aktif
        aktif1xy.addEventListener('change', function(){
           aktif1.value = 'Y'; 
        })
        aktif1xn.addEventListener('change', function(){
           aktif1.value = 'N'; 
        })

        //dragging modal
        $('#ModalAdd').on('shown.bs.modal', function () {
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
            warnax.classList.remove('bg-warning');
            warnax.classList.add('bg-success');
            iconx.classList.remove('bi-plus-square');
            iconx.classList.remove('bi-mortarboard-fill');
            iconx.classList.add('bi-pencil-square');
            judulx.innerHTML = 'Edit Data';
            btn_simpan.style.display = 'block';
            btn_baru.style.display = 'none';
            headertop.style.display = 'block';
            aktif1.value = 'Y';
            if(aktif1.value=='Y'){
                aktif1xy.checked = true;
            }else{
                aktif1xn.checked = true;
            } 
        }
        
        function btn_keluarsemua1_click(){      
            bodyx.disabled = false;
            warnax.classList.remove('bg-primary');
            warnax.classList.remove('bg-primary');
            warnax.classList.add('bg-warning');
            iconx.classList.remove('bi-plus-square');
            iconx.classList.remove('bi-pencil-square');
            iconx.classList.add('bi-mortarboard-fill');
            judulx.innerHTML = 'Keluar/lulus semua';
            btn_simpan.style.display = 'block';
            btn_baru.style.display = 'none';
            headertop.style.display = 'none';
            id1.value = '0';
            aktif1.value = 'Y';
            if(aktif1.value=='Y'){
                aktif1xy.checked = true;
            }else{
                aktif1xn.checked = true;
            }
        }

        btn_baru.addEventListener('click', function () {
            btn_baru_click();            
        });
       
        document.getElementById('ModalAdd').addEventListener('mousemove', function () {
            if (document.getElementById('penghasilankerja1').value==''){
                document.getElementById('penghasilankerja1').value = '0';
            }           
        });

        btn_tambah1.addEventListener('click', function () {
            btn_baru_click();
            id1.value = '0';
            cek1.value = '0';
            nis1.value = '';        
            namalengkap1.value = '';        
            nisn1.value = '';        
            tglkeluar1.value = '';        
            ModalAdd.show();            
        });

        setTimeout(() => {
            infoawal1Datatable = tampil_infoawal1();    
            infosekolah1Datatable = tampil_infosekolah1();    
            infokerja1Datatable = tampil_infokerja1();    
        }, 1000);
        
        function tampil_infoawal1() {
            let i = 1;
            
            return new DataTable('#infoawal1', {
                responsive: true,
                retrieve: true,
                autoWidth: true,
                stateSave: true,
                buttons: [ 
                    { extend: 'colvis', postfixButtons: [ 'colvisRestore' ] },
                    { extend: 'copy', className: 'btn btn-sm btn-secondary' }, 
                    { extend: 'csv', className: 'btn btn-sm btn-secondary' },
                    { extend: 'pdf', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-warning' },
                    { extend: 'excel', title: '{{ $caption }}', className: 'btn btn-sm btn-success' }, 
                    { extend: 'print', orientation: 'portrait', pageSize: 'A4', title: '{{ $caption }}', className: 'btn btn-sm btn-info' }, 
                ],  
                dom: "<'row mb-3 align-items-center'" +
                            "<'col-12 col-md-3'l>" +     
                            "<'col-12 col-md-6 text-md-center my-2 my-md-0'B>" + 
                            "<'col-12 col-md-3 text-md-end'f>" + 
                        ">" +
                        "<'row'<'col-sm-12'tr>>" + 
                        "<'row mt-3 align-items-center'" +
                            "<'col-sm-12 col-md-5'i>" + 
                            "<'col-sm-12 col-md-7'p>" + 
                        ">",
                lengthMenu: [
                    [ 10, 25, 50, 100, 500, 1000, 5000, -1 ],
                    [ '10', '25', '50', '100', '500','1000','5000', 'All' ]
                ],
                processing: true,
                serverSide: true,
                
                // Konfigurasi AJAX versi Vanilla JS bawaan DataTables
                ajax: {
                    url: "{{ route('sips01.transaksi.siswakeluar_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                
                columns: [
                    { data: 'DT_RowIndex', orderable: false, searchable: false, className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tpmasuk', name: 'tpmasuk', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.tglditerima', name: 'datasiswa.tglditerima', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'tpkeluar', name: 'tpkeluar', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.tglkeluar', name: 'datasiswa.tglkeluar', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'alasankeluar', name: 'alasankeluar', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'alasansetelahkeluar', name: 'alasansetelahkeluar', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.aktif', name: 'datasiswa.aktif', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.datasiswa?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        function tampil_infosekolah1(){
            let i = 1;
            return new DataTable('#infosekolah1', {
                responsive : true,
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
                // Konfigurasi AJAX versi Vanilla JS bawaan DataTables
                ajax: {
                    url: "{{ route('sips01.transaksi.siswakeluar_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.tglijasahlulus', name: 'datasiswa.tglijasahlulus', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nomorijasahlulus', name: 'datasiswa.nomorijasahlulus', orderable: true, searchable: true },
                    { data: 'datasiswa.tglskhunlulus', name: 'datasiswa.tglskhunlulus', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nomorskhunlulus', name: 'datasiswa.nomorskhunlulus', orderable: true, searchable: true },
                    { data: 'datasiswa.keteranganlulus', name: 'datasiswa.keteranganlulus', orderable: true, searchable: true },
                    { data: 'datasiswa.sekolahlanjut', name: 'datasiswa.sekolahlanjut', orderable: true, searchable: true },
                    { data: 'datasiswa.jurusanlanjut', name: 'datasiswa.jurusanlanjut', orderable: true, searchable: true },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.datasiswa?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        function tampil_infokerja1(){
            let i = 1;
            return new DataTable('#infokerja1', {
                responsive : true,
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
                // Konfigurasi AJAX versi Vanilla JS bawaan DataTables
                ajax: {
                    url: "{{ route('sips01.transaksi.siswakeluar_show') }}",
                    type: "GET" // atau "POST" sesuai route Laravel Anda
                },
                columns: [
                    { "data": 'DT_RowIndex',
                        orderable: false, 
                        searchable: false,
                        className: 'dt-center' },
                    { data: 'datasiswa.nis', name: 'datasiswa.nis', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.nisn', name: 'datasiswa.nisn', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namalengkap', name: 'datasiswa.namalengkap', orderable: true, searchable: true },
                    { data: 'kelas.kelas', name: 'kelas.kelas', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.kerjadi', name: 'datasiswa.kerjadi', orderable: true, searchable: true },
                    { data: 'datasiswa.tglmulaikerja', name: 'datasiswa.tglmulaikerja', orderable: true, searchable: true, className: 'dt-center' },
                    { data: 'datasiswa.namaperusahaan', name: 'datasiswa.namaperusahaan', orderable: true, searchable: true },
                    { data: 'penghasilankerja', name: 'penghasilankerja', orderable: true, searchable: true, className: 'dt-right' },
                    { data: 'action', name: 'action', orderable: false, searchable: false, className: 'dt-center' }
                ],
                rowCallback: function(row, data, index) {
                    if (data?.datasiswa?.aktif == 'N') {
                        row.classList.add('baris-tidak-aktif');
                    }
                }
            });
        }

        const tglkeluarx = new Datepicker(tglkeluar1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        const tglijasahlulusx = new Datepicker(tglijasahlulus1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        const tglskhunlulusx = new Datepicker(tglskhunlulus1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });
        const tglmulaikerjax = new Datepicker(tglmulaikerja1, {
            buttonClass: 'btn',
            format: 'yyyy-mm-dd', // Format tanggal
            autohide: true,       // Otomatis menutup saat tanggal dipilih
            todayHighlight: true  // Menandai hari ini
        });

        //menampilkan combo tpx1
        tampil_listtpx1()
        function tampil_listtpx1() {
            fetch('{{ route('sips01.transaksi.siswakeluar_listtp') }}', {
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
                    idtpkeluar1.innerHTML = data;
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }
        
        //menampilkan combo kelasx1
        tampil_listkelasx1()
        function tampil_listkelasx1() {
            fetch('{{ route('sips01.transaksi.siswakeluar_listkelas') }}', {
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
                    idkelasx1.innerHTML = data;
                    idkelasx1.value = {{ $idkelas }};
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }
        
        //menampilkan combo alasankeluar1
        tampil_listalasankeluar1()
        function tampil_listalasankeluar1() {
            fetch('{{ route('sips01.transaksi.siswakeluar_listalasankeluar') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idalasankeluar1) {
                    idalasankeluar1.innerHTML = data;
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        }
        //menampilkan combo alasansetelahkeluar1
        tampil_listalasansetelahkeluar1()
        function tampil_listalasansetelahkeluar1() {
            fetch('{{ route('sips01.transaksi.siswakeluar_listalasansetelahkeluar') }}', {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Gagal mengambil data');
                }
                return response.text(); 
            })
            .then(data => {
                if (idalasansetelahkeluar1) {
                    idalasansetelahkeluar1.innerHTML = data;
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
        
        setTimeout(() => {
            load_walikelas();
        }, 2000);

        idtpx1.addEventListener('click', function () {
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
            const url = `{{ url('/sips01/transaksi/siswakeluarshowwali') }}`;
            
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
            const idtp1 = document.getElementById('idtpx1').value;
            const idkelas1 = document.getElementById('idkelasx1').value;
            
            let formData = new FormData();
            formData.append('idtp1', idtp1);
            formData.append('idkelas1', idkelas1);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{route('sips01.transaksi.siswakeluar_kirimsyarat')}}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => {
                // Cek hanya status HTTP nya saja (200-299 dianggap sukses)
                if (response.ok) {
                    tampil_dataTable(); 
                } else {
                    // Jika status HTTP error (misal 500, 419, 404)
                    throw new Error('Server mengirim status error: ' + response.status);
                }
            })
            .catch(error => {
                // Ini akan mencetak detail error yang sebenarnya ke console F12
                console.error('Detail Error:', error);
                
            });
        }
        
        function tampil_dataTable(){   
            infoawal1Datatable.ajax.reload(null, false);
            infosekolah1Datatable.ajax.reload(null, false);
            infokerja1Datatable.ajax.reload(null, false);
        }

        btn_simpan.addEventListener('click', function () {
            data_simpan();                     
        });
    
        function data_simpan(){ 
            swalsedangproses();          
            const id1 = document.getElementById('id1').value;
            const idtp1 = document.getElementById('idtpx1').value;
            const idkelas1 = document.getElementById('idkelasx1').value;

            const idtpkeluar1 = document.getElementById('idtpkeluar1').value;
            const tglkeluar1 = document.getElementById('tglkeluar1').value;
            const idalasankeluar1 = document.getElementById('idalasankeluar1').value;
            const idalasansetelahkeluar1 = document.getElementById('idalasansetelahkeluar1').value;
            const aktif1 = document.getElementById('aktif1').value;
            const tglijasahlulus1 = document.getElementById('tglijasahlulus1').value;
            const nomorijasahlulus1 = document.getElementById('nomorijasahlulus1').value;
            const tglskhunlulus1 = document.getElementById('tglskhunlulus1').value;
            const nomorskhunlulus1 = document.getElementById('nomorskhunlulus1').value;
            const keteranganlulus1 = document.getElementById('keteranganlulus1').value;
            const sekolahlanjut1 = document.getElementById('sekolahlanjut1').value;
            const jurusanlanjut1 = document.getElementById('jurusanlanjut1').value;
            const kerjadi1 = document.getElementById('kerjadi1').value;
            const tglmulaikerja1 = document.getElementById('tglmulaikerja1').value;
            const namaperusahaan1 = document.getElementById('namaperusahaan1').value;
            const penghasilankerja1 = document.getElementById('penghasilankerja1').value.replace(/[^,\d]/g, '').toString();

            let formData = new FormData();
                formData.append('id1', id1);
                formData.append('idtp1', idtp1);
                formData.append('idkelas1', idkelas1);
                formData.append('idtpkeluar1', idtpkeluar1);
                formData.append('tglkeluar1', tglkeluar1);
                formData.append('idalasankeluar1', idalasankeluar1);
                formData.append('idalasansetelahkeluar1', idalasansetelahkeluar1);
                formData.append('aktif1', aktif1);
                formData.append('tglijasahlulus1', tglijasahlulus1);
                formData.append('nomorijasahlulus1', nomorijasahlulus1);
                formData.append('tglskhunlulus1', tglskhunlulus1);
                formData.append('nomorskhunlulus1', nomorskhunlulus1);
                formData.append('keteranganlulus1', keteranganlulus1);
                formData.append('sekolahlanjut1', sekolahlanjut1);
                formData.append('jurusanlanjut1', jurusanlanjut1);
                formData.append('kerjadi1', kerjadi1);
                formData.append('tglmulaikerja1', tglmulaikerja1);
                formData.append('namaperusahaan1', namaperusahaan1);
                formData.append('penghasilankerja1', penghasilankerja1);
            
                fetch("{{ route('sips01.transaksi.siswakeluar_create') }}", {
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
                    // btn_simpan_click();
                    if (id1 >= '0') {
                        // Bootstrap 5 menutup modal (menggunakan objek instans modal Anda)
                        ModalAdd.hide(); 
                    }
                    swal.close();
                    swalsuksesupdate('Keluar/lulus');
                    return;
                })
                .catch(error => {
                    // === BLOK ERROR ===
                    swal.close();
                    console.error('Error:', error);
                    swalgagalupdate('Keluar/lulus');
                });    
        }

        btn_keluarsemua1.addEventListener('click', function () {
            btn_keluarsemua1_click();
            ModalAdd.show();
        });

        document.getElementById('show_infoawal1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                id1.value = id1;
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });

        document.getElementById('show_infosekolah1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                id1.value = id1;
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });
        document.getElementById('show_infokerja1').addEventListener('click', async function(e) {
            const targetButton = e.target.closest('.item_edit');
            targetButton.blur(); // Melepas fokus agar ARIA tidak memblokir DOM
            if (targetButton) {
                var id1 = targetButton.getAttribute('data1');
                id1.value = id1;
                btn_edit1_click();
                await data_edit(id1);
                ModalAdd.show();
            }
        });

        async function data_edit(id1) {
            const url = `{{ url('/sips01/transaksi/siswakeluaredit') }}/${id1}`;
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
                    document.getElementById('nis1').value = resultData[i].nis;
                    document.getElementById('nisn1').value = resultData[i].nisn;
                    document.getElementById('namalengkap1').value = resultData[i].namalengkap;
                    document.getElementById('idtpkeluar1').value = resultData[i].idtpkeluar;
                    document.getElementById('tglkeluar1').value = resultData[i].tglkeluar;
                    document.getElementById('idalasankeluar1').value = resultData[i].idalasankeluar;
                    document.getElementById('idalasansetelahkeluar1').value = resultData[i].idalasansetelahkeluar;
                    document.getElementById('aktif1').value = resultData[i].aktif;

                    const aktifValue = document.getElementById('aktif1').value;
                    if (aktifValue === 'Y') {
                        document.getElementById("aktif1xy").checked = true;
                    } else {
                        document.getElementById("aktif1xn").checked = true;
                    }
                    document.getElementById('tglijasahlulus1').value = resultData[i].tglijasahlulus;
                    document.getElementById('nomorijasahlulus1').value = resultData[i].nomorijasahlulus;
                    document.getElementById('tglskhunlulus1').value = resultData[i].tglskhunlulus;
                    document.getElementById('nomorskhunlulus1').value = resultData[i].nomorskhunlulus;
                    document.getElementById('keteranganlulus1').value = resultData[i].keteranganlulus;
                    document.getElementById('sekolahlanjut1').value = resultData[i].sekolahlanjut;
                    document.getElementById('jurusanlanjut1').value = resultData[i].jurusanlanjut;
                    document.getElementById('kerjadi1').value = resultData[i].kerjadi;
                    document.getElementById('tglmulaikerja1').value = resultData[i].tglmulaikerja;
                    document.getElementById('namaperusahaan1').value = resultData[i].namaperusahaan;
                    document.getElementById('penghasilankerja1').value = formatAngka(resultData[i].penghasilankerja,'');

                }

            } catch (error) {
                console.error('Error saat memuat data:', error);
                if (typeof swalgagaltambah === 'function') {
                    swalgagaltambah('Gagal memuat data pengguna.');
                }
            }
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