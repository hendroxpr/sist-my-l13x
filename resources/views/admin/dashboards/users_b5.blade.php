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
                    <a href="{{ url('/') }}{{ $link }}" class="btn btn-success rounded-0 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-clockwise fs-6"></i> Refresh
                    </a>            
                    
                    <!-- Tombol Tambah (Menggunakan Bootstrap Icons & Kelas btn-primary standar) -->
                    <button id="btn_tambah1" name="btn_tambah1" type="button" class="btn btn-primary rounded-0 d-inline-flex align-items-center gap-2">
                        <i class="bi bi-plus-lg fs-6"></i> Tambah
                    </button>	            
                </div> 
            </div>
        </div>

        <!--awal tabel-->        
        <div class="box-body" id="headerjudul" style="display: block;">
            <div id="table-container" class="table-responsive">
                				
                
            </div>
        </div>    
        <!--akhir tabel-->
{{-- 
        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Daftar Pengguna (Tabulator Remote Data)</h5>
            </div>
            <div class="card-body">
                <!-- Elemen kontainer tabel -->
                <div id="table-container"></div>
            </div>
        </div> --}}


    </div>

    <!-- ModalAdd modal fade-->
    <div class="modal fade" id="ModalAdd" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title d-flex align-items-center gap-2" id="modalLabel">
                        <i id="iconx" class="bi bi-person-plus-fill"></i>
                        <span id="judulx" class="fw-bold">Tambah Data User</span>
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body p-4">
                        
                        <!-- ID & Hidden Fields -->
                        <input type="hidden" name="id1" id="id1">
                        <input type="hidden" name="cek1" id="cek1">

                        <!-- Username -->
                        <div class="row mb-1 align-items-center">
                            <label for="name1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                User Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="name1" id="name1" class="form-control" placeholder="Masukkan Username" value="{{ old('name1') }}" required autofocus>
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
                                <input type="text" name="namadepan1" id="namadepan1" class="form-control" placeholder="Nama Depan">
                            </div>
                        </div>

                        <!-- Nama Tengah -->
                        <div class="row mb-1 align-items-center">
                            <label for="namatengah1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                Nama Tengah
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="namatengah1" id="namatengah1" class="form-control" placeholder="Nama Tengah">
                            </div>
                        </div>

                        <!-- Nama Belakang -->
                        <div class="row mb-1 align-items-center">
                            <label for="namabelakang1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                Nama Belakang
                            </label>
                            <div class="col-sm-8">
                                <input type="text" name="namabelakang1" id="namabelakang1" class="form-control" placeholder="Nama Belakang">
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
                        <div class="row mb-4 align-items-start">
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
                                <div class="card border rounded-2 d-flex align-items-center justify-content-center bg-outline position-relative" style="height: 150px; overflow: hidden; width: 50%;">
                                    <!-- Elemen Gambar -->
                                    <img id="gambarfoto1" alt="Preview" style="max-height: 100%; object-fit: contain;" class="img-fluid img-hover-zoom">                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-8 offset-sm-4">
                                <small class="text-muted"><span class="text-danger">*</span> Wajib diisi.</small>
                            </div>
                        </div>

                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer bg-light justify-content-between">
                        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-1"></i> Tutup
                        </button>
                        <div class="d-flex gap-2">
                            <button type="button" id="btn_baru" class="btn btn-info text-white">
                                <i class="bi bi-plus-lg me-1"></i> Baru
                            </button>
                            <button type="submit" id="btn_simpan" class="btn btn-primary">
                                <i class="bi bi-floppy me-1"></i> Simpan
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- end ModalAdd -->




</div>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function() {
        
        function persiapan(){
            const btn_tambah1 = document.getElementById('btn_tambah1');
            const gambarfoto1 = document.getElementById('gambarfoto1');
            
            
        }

        setTimeout(() => {
            persiapan();
        }, 100);

        //preview foto1
        const inputfoto1 = document.getElementById('foto1');
        const previewfoto1 = document.getElementById('gambarfoto1');
        inputfoto1.addEventListener('change', function(){
            const file = this.files[0];
            if(!file){
                previewfoto1.style.display = 'none';
                return;
            }
            const reader = new FileReader();
            reader.onload = function(e){
                previewfoto1.src = e.target.result;
                previewfoto1.style.display = 'block';
            }
            reader.readAsDataURL(file);
        });
        
        gambarfoto1.addEventListener('click', function () {
            document.getElementById('foto1').click();
        });

        // const datepicker = new Datepicker(document.getElementById('namadepan1'), {
        //     buttonClass: 'btn',          // Integrasi tombol Bootstrap 5
        //     format: 'yyyy-mm-dd',        // Format tanggal
        //     autoclose: true,             // Tutup otomatis jika pindah komponen
        //     autohide: true,              // Tutup otomatis jika tgl diklik
        //     todayHighlight: true         // Highlight hari ini
        // });

        btn_tambah1.addEventListener('click', function () {
            const modalEl = document.getElementById('ModalAdd');
            const myModal = bootstrap.Modal.getOrCreateInstance(modalEl);
            
            if (modalEl) {
                // Gunakan getOrCreateInstance agar aman dari duplikasi instance
                const myModal = bootstrap.Modal.getOrCreateInstance(modalEl);
                myModal.show();
            } else {
                console.error('Elemen modal #ModalAdd tidak ditemukan di DOM!');
            }
        });

    setTimeout(() => {
       tampil_listaplikasi();    
    }, 100);

    function tampil_listaplikasi(){
        const kontainer = document.getElementById("idaplikasi1");
        // 1. Tampilkan animasi loading spinner Bootstrap 5
        kontainer.innerHTML = `
            <div class="d-flex justify-content-center my-4">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        `;
        fetch('{{ route("admin.users_listaplikasi") }}')
        .then(response => {
            // Validasi jika status HTTP bukan 200-299 (misal 404 atau 500)
            if (!response.ok) {
                throw new Error('Respons server bermasalah');
            }
            return response.text(); // Ambil data dalam bentuk teks/HTML string
        })
        .then(data => {
            // 3. Masukkan HTML dari server ke dalam kontainer
            kontainer.innerHTML = data;
        })
        .catch(error => {
            // 4. Tangani jika terjadi error koneksi atau error dari blok .then()
            kontainer.innerHTML = `
                <div class="alert alert-danger rounded-3 m-2" role="alert">
                    Gagal memuat daftar aplikasi. Silakan coba lagi.
                </div>
            `;
            // Panggil SweetAlert2 jika fungsi gagal tersedia
            if (typeof swalgagalhapus === "function") {
                swalgagalhapus("Gagal mengambil data dari server.");
            }
            console.error('Error Fetch:', error);
        });
    }

    //tampil data    
    var table = new Tabulator("#table-container", {
        ajaxURL: "{{ route('admin.users_show') }}", 
        
        // MENYISIPKAN HEADERS UNTUK KEAMANAN LARAVEL
        ajaxConfig: {
            method: "GET", // Menggunakan GET atau POST sesuai rute Anda
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                "X-Requested-With": "XMLHttpRequest" // Memberitahu Laravel bahwa ini adalah request AJAX
            },
        },

        layout: "fitColumns",
        
        // PERBAIKAN SINTAKSIS REMOTING VERSION 5.x / 6.x
        pagination: true,                   // Aktifkan fitur halaman
        paginationMode: "remote",           // Ambil data per halaman dari server
        filterMode: "remote",               // Jalankan pencarian di sisi server
        sortMode: "remote",                 // Jalankan pengurutan di sisi server
        
        paginationSize: 10,                 
        paginationSizeSelector: [10, 25, 50, 100, 500, 1000, 5000, 10000],
        placeholder: "Data tidak ditemukan",
        
        columns: [
            {title: "No", 
            // Custom Formatter untuk menjamin nomor urut akumulatif antar halaman
            formatter: function(cell, formatterParams, onRendered){
                var page = table.getPage(); // Mengambil halaman saat ini
                var size = table.getPageSize(); // Mengambil jumlah baris per halaman
                var rowIndex = cell.getRow().getPosition(); // Posisi baris di halaman tersebut
                
                // Rumus kalkulasi nomor urut kontinu
                return ((page - 1) * size) + rowIndex;
            }, 
            hovertitle: "Nomor", align: "center", width: 60, headerSort: false, frozen: true, hozAlign: "center"},
            {
                title: "Nama", 
                field: "name", 
                sorter: "string", 
                headerFilter: "input",
                // SOLUSI: Mengaktifkan elemen klik khusus sorting di samping input filter
                headerSort: true, 
                // Mengatur perilaku klik pada elemen judul agar memicu sort, bukan fokus ke input
                headerClickMenu: undefined
                },
            {title: "Email", field: "email", sorter: "string"},
            {title: "Bergabung", field: "created_at", width: 200, sorter: "datetime", sorterParams: {
            format: "yyyy-MM-dd HH:mm:ss", // Sesuaikan dengan format data dari database Anda
            alignEmptyValues: "bottom",
            }},
            {
                title: "Aksi",
                field: "actions",
                width: 120,
                hozAlign: "center",
                headerSort: false, // Matikan fitur sort untuk kolom tombol
                headerFilter: false, // Matikan filter untuk kolom tombol
                
                // Fungsi formatter untuk merender HTML tombol Bootstrap 5
                formatter: function(cell, formatterParams, onRendered) {
                    // Ambil data dari baris aktif saat ini
                    var rowData = cell.getRow().getData(); 
                    
                    // Susun string HTML tombol aksi menggunakan Bootstrap 5 dan Font Awesome
                    var btnEdit = '<a href="javascript:void(0);" title="Edit Data" class="btn btn-success btn-sm item_edit me-1" data-id="' + rowData.id + '" data-kode="' + rowData.kode + '" data-satuan="' + rowData.satuan + '"><i class="fas fa-edit" style="font-size:16px"></i></a>';
                    var btnHapus = '<a href="javascript:void(0);" title="Hapus Data" class="btn btn-danger btn-sm item_hapus" data-id="' + rowData.id + '" data-kode="' + rowData.kode + '" data-satuan="' + rowData.satuan + '"><i class="fas fa-times" style="font-size:16px"></i></a>';
                    
                    return btnEdit + btnHapus;
                }
            }
        ],
        locale: "id",
        langs: {
            "id": {
                "pagination": {
                    "page_size": "Tampilkan",
                    "first": "&#10094;&#10094;",       // Ikon First (Ganda kiri)
                    "prev": "&#10094;",       // Ikon Prev (Tunggal kiri)
                    "next": "&#10095;",       // Ikon Next (Tunggal kanan)
                    "last": "&#10095;&#10095;",       // Ikon Last (Ganda kanan)
                }
            }
        }
    });
    // // 1. Inisialisasi Modal Bootstrap 5 (Paling Atas)
    // const modalElement = document.getElementById('ModalAdd');
    // const modalAdd = new bootstrap.Modal(modalElement);

    // // 2. Event Listener Klik Tombol Tambah
    // document.getElementById('btn_tambah1').addEventListener('click', function () {
    //         // // Panggil fungsi eksternal Anda
    //         // btn_baru_click();

    //         // // 3. Reset Nilai Input & Select (Ganti .val(''))
    //         // document.getElementById('name1').value = '';
    //         // document.getElementById('email1').value = '';
    //         // document.getElementById('namadepan1').value = '';
    //         // document.getElementById('namatengah1').value = '';
    //         // document.getElementById('namabelakang1').value = '';
    //         // document.getElementById('id1').value = '0';

    //         // // Set Nilai Default Dropdown
    //         // const levels1 = document.getElementById('levels1');
    //         // const blokir1 = document.getElementById('blokir1');
    //         // levels1.value = '3';
    //         // blokir1.value = 'N';

    //         // // 4. Logika Radio Button Levels (Ganti .checked)
    //         // if (levels1.value === '1') {
    //         //     document.getElementById("levels1xadmin").checked = true;
    //         // } else if (levels1.value === '2') {
    //         //     document.getElementById("levels1xuser").checked = true;
    //         // } else {
    //         //     document.getElementById("levels1xentry").checked = true;
    //         // }

    //         // // 5. Logika Radio Button Blokir
    //         // if (blokir1.value === 'Y') {
    //         //     document.getElementById("blokir1xy").checked = true;
    //         // } else {
    //         //     document.getElementById("blokir1xn").checked = true;
    //         // }

    //         // // 6. Manipulasi Ikon (Ganti ke Bootstrap Icons)
    //         // const iconx = document.getElementById('iconx');
    //         // iconx.className = "bi bi-plus-square"; // Menggantikan fas fa-plus-square

    //         // // 7. Manipulasi Kelas Konten Modal (Ganti ke Pewarnaan Bootstrap 5)
    //         // const modalx = document.getElementById('modalx');
    //         // // Bersihkan kelas warna dan animasi lama (w3-css)
    //         // modalx.className = "modal-content text-white bg-primary"; 

    //         // // 8. Mengaktifkan Tombol Simpan
    //         // document.getElementById("btn_simpan").disabled = false;

    //         // // 9. Mengubah Judul Modal
    //         // document.getElementById('judulx').innerHTML = ' Tambah Data';

    //         // // 10. Tampilkan Modal Bootstrap 5
    //         // modalAdd.show();
    //     });

    function swaltambah(x){
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

    function swalupdate(x){
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

    function swalhapus(x){
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

    function swalgagalhapus(x){
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