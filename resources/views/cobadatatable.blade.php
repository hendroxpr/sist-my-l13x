@extends('admin.layouts.main')

@section('contents')

@php
    $level = auth()->user()->levels;    
@endphp

<div class="container-fluid px-0">
    <div class="card-header border-0 mb-1 bg-transparent px-0">  
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
            <div class="col-md-6">
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



    </div>

    <!-- ModalAdd modal fade-->
    
    <!-- Modal Add / Edit User -->
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

                        <!-- Upload Foto & Preview -->
                        <div class="row mb-1 align-items-start">
                            <label for="foto1" class="col-sm-4 col-form-label text-sm-end fw-semibold">
                                Foto <br><small class="text-muted fw-normal">(Maks. 2048 KB)</small>
                            </label>
                            <div class="col-sm-8">
                                <input type="file" name="foto1" id="foto1" class="form-control mb-2" accept="image/*" onchange="previewImage(event)">
                                <input type="hidden" name="foto1x" id="foto1x">
                                
                                <!-- Box Preview Image -->
                                <div class="card border rounded-2 d-flex align-items-center justify-content-center bg-light" style="height: 120px; overflow: hidden;">
                                    <img id="gambarfoto1" src="" alt="Preview Foto" class="img-fluid d-none" style="max-height: 100%; object-fit: contain;">
                                    <span id="placeholderFoto" class="text-muted small">Belum ada foto</span>
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
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
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
            
            
        }

        persiapan();
        

        btn_tambah1.addEventListener('click', function () {
            alert('coba');
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


    });
</script>

@endsection