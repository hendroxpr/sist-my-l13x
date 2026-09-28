@extends('admin.layouts.main')

@section('contents')

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
                    <a href="{{ url('/') }}{{ $link }}" class="btn btn-success d-inline-flex align-items-center gap-2">
                        <i class="bi bi-arrow-clockwise fs-6"></i> Refresh
                    </a>            
                    <button id="btn_update1" name="btn_update1" type="button" class="btn btn-primary d-inline-flex align-items-center gap-2">
                        <i class="bi bi-check-lg fs-6"></i> Update
                    </button>
                    
                </div> 
            </div>
        </div>
    </div>

   <div class="form-group">
        <form class="form-horizontal" id="formTambah" nama="formTambah" action="" method="GET" enctype="multipart/form-data"></form>
            @csrf
            <div class="row">
                <div class="col-md-6">

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Nama Instansi</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="nama1" id="nama1" class="w3-input w3-border" type="text" placeholder="Nama Instansi" autofocus value="{{ $tabel[0]->nama }}" required>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Nama Instansi (singkatan)</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="namasingkat1" id="namasingkat1" class="w3-input w3-border" type="text" placeholder="Nama Instansi"  value="{{ $tabel[0]->namasingkat }}" required>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Alamat</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="alamat1" id="alamat1" class="w3-input w3-border" type="text" placeholder="Alamat"  value="{{ $tabel[0]->alamat }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Desa/Kelurahan</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="desa1" id="desa1" class="w3-input w3-border" type="text" placeholder="Desa/Kelurahan"  value="{{ $tabel[0]->desa }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Kecamatan</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="kecamatan1" id="kecamatan1" class="w3-input w3-border" type="text" placeholder="Kecamatan"  value="{{ $tabel[0]->kecamatan }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Kabupaten</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="kabupaten1" id="kabupaten1" class="w3-input w3-border" type="text" placeholder="Kabupaten"  value="{{ $tabel[0]->kabupaten }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Propinsi</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="propinsi1" id="propinsi1" class="w3-input w3-border" type="text" placeholder="Propinsi"  value="{{ $tabel[0]->propinsi }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Kode Pos</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="kodepos1" id="kodepos1" class="w3-input w3-border" type="text" placeholder="Kode Pos"  value="{{ $tabel[0]->kodepos }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Email</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="email1" id="email1" class="w3-input w3-border" type="email" placeholder="Email"  value="{{ $tabel[0]->email }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Facebook</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="facebook1" id="facebook1" class="w3-input w3-border" type="text" placeholder="Facebook"  value="{{ $tabel[0]->facebook }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Instagram</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="instagram1" id="instagram1" class="w3-input w3-border" type="text" placeholder="Instagram"  value="{{ $tabel[0]->instagram }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Twitter</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="twitter1" id="twitter1" class="w3-input w3-border" type="text" placeholder="Twitter"  value="{{ $tabel[0]->twitter }}">
                        </div>
                    </div>
                    
                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>WhatsApp</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="whatsapp1" id="whatsapp1" class="w3-input w3-border" type="text" placeholder="WhatsApp"  value="{{ $tabel[0]->whatsapp }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Website</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="website1" id="website1" class="w3-input w3-border" type="text" placeholder="Website"  value="{{ $tabel[0]->website }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Kontak Person</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="kontakperson1" id="kontakperson1" class="w3-input w3-border" type="text" placeholder="Kontak Person"  value="{{ $tabel[0]->kontakperson }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Nomor Kontak</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="nomorkontak1" id="nomorkontak1" class="w3-input w3-border" type="text" placeholder="Nomor Person"  value="{{ $tabel[0]->nomorkontak }}">
                        </div>
                    </div>
                    
                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Jabatan Kontak</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="jabatankontak1" id="jabatankontak1" class="w3-input w3-border" type="text" placeholder="Jabatan Person"  value="{{ $tabel[0]->jabatankontak }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Bendahara</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="bendahara1" id="bendahara1" class="w3-input w3-border" type="text" placeholder="Bendahara"  value="{{ $tabel[0]->bendahara }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>NIP Bendahara</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="nipbendahara1" id="nipbendahara1" class="w3-input w3-border" type="text" placeholder="NIP Bendahara"  value="{{ $tabel[0]->nipbendahara }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Kota ttd</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="kotattd1" id="kotattd1" class="w3-input w3-border" type="text" placeholder="Kota ttd"  value="{{ $tabel[0]->kotattd }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Kepala Sekolah</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="kepsek1" id="kepsek1" class="w3-input w3-border" type="text" placeholder="Kepala Sekolah"  value="{{ $tabel[0]->kepsek }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>NIP Kepala Sekolah</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="nipkepsek1" id="nipkepsek1" class="w3-input w3-border" type="text" placeholder="NIK Kepala Sekolah"  value="{{ $tabel[0]->nipkepsek }}">
                        </div>
                    </div>

                    <div class="row mb-0 align-items-top">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Foto Kepala Sekolah<br>(Mak. 2048 KB)</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="fotoks1" id="fotoks1" type="file" class="w3-input w3-border mb-1">
                            <input name="fotoks1x" id="fotoks1x" type="hidden" value="{{ $tabel[0]->fotoks }}">
                            <div class="w3-card w3-border" style="min-height:200px; height: auto;">                                              
                                <div id="gambarfotoks1" name="gambarfotoks1" class="mb-1" style="width: 100%;">                                                                         
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Sambutan Kepala Sekolah</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white; border-top: 2px solid white;">
                            <button id="btn_sambutanks1" name="btn_sambutanks1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Sambutan Kepala Sekolah</button>	
                        </div>
                    </div>

                </div>

                
                <div class="col-md-6">
                    

                    <div class="row mb-0 align-items-top">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Logo Sekolah<br>(Mak. 2048 KB)</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="logo1" id="logo1" type="file" class="w3-input w3-border mb-1">
                            <input name="logo1x" id="logo1x" type="hidden" value="{{ $tabel[0]->logo }}">
                            <div class="w3-card w3-border" style="min-height:200px; height: auto;">                                              
                                <div id="gambarlogo1" name="gambarlogo1" class="mb-1" style="width: 100%;">                                                                         
                                </div> 
                            </div>
                        </div>
                    </div>

                    <style>
                        
                        #motto1 {
                        width: 100%;
                        height: 15vh;
                        padding: 0.5em;
                        font-size: 1em;
                        text-align: left;
                        border: 1px solid #000;
                        resize: none;
                        }

                        #awalanprofil1 {
                        width: 100%;
                        height: 30vh;
                        padding: 0.5em;
                        font-size: 1em;
                        text-align: left;
                        border: 1px solid #000;
                        resize: none;
                        }

                        .boxSizing-borderBox {
                        box-sizing: border-box;
                        }
                    </style>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-3">
                        <h6>Motto</h6>
                        </div>
                        <div class="col-md-7" style="border-top: 2px solid white;">
                            <textarea name="motto1" id="motto1" class="w3-input w3-border" type="text" placeholder="Motto">{{ $tabel[0]->motto }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Visi</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white; border-top: 2px solid white">
                            <button id="btn_visi1" name="btn_visi1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Visi</button>	
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Misi</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white">
                            <button id="btn_misi1" name="btn_misi1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Misi</button>	
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Tujuan</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white">
                            <button id="btn_tujuan1" name="btn_tujuan1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Tujuan</button>	
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Sejarah</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white">
                            <button id="btn_sejarah1" name="btn_sejarah1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Sejarah</button>	
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Profil</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white">
                            <button id="btn_profil1" name="btn_profil1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Profil</button>	
                        </div>
                    </div>

                    <div class="row mb-0 align-items-top">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Awalan Profil</h6>
                        </div>
                        <div class="col-md-7">
                            <textarea class="boxSizing-borderBox" name="awalanprofil1" id="awalanprofil1" class="w3-input w3-border" type="text" placeholder="Awalan Profil">{{ $tabel[0]->awalanprofil }}</textarea>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-top">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Video Profil</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white">
                            <input name="videoprofil1" id="videoprofil1" class="w3-input w3-border" type="text" placeholder="Video Embed" value="{{ $tabel[0]->videoprofil }}">
                            <input name="videoprofil1x" id="videoprofil1x" type="hidden">

                            <div class="content-video">
                                
                                <iframe id="video" style="min-height:200px; height: auto; width: 100%; border: 1px solid grey;" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-top">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Struktur Organisasi<br>(Mak. 2048 KB)</h6>
                        </div>
                        <div class="col-md-7">
                            <input name="strukturorganisasi1" id="strukturorganisasi1" type="file" class="w3-input w3-border mb-1">
                            <input name="strukturorganisasi1x" id="strukturorganisasi1x" type="hidden" value="{{ $tabel[0]->strukturorganisasi }}">
                            <div class="w3-card w3-border" style="min-height:200px; height: auto;">                                              
                                <div id="gambarstruktur1" name="gambarstruktur1" class="mb-1" style="width: 100%;">                                                                         
                                </div> 
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-top">
                        <div class="col-md-5 text-sm-end mt-4">
                        <h6>Lokasi</h6>
                        </div>
                        <div class="col-md-7 mt-2">                            
                            <input name="lokasimap1" id="lokasimap1" class="w3-input w3-border" type="text" placeholder="Lokasi" value="{{ $tabel[0]->lokasimap }}">
                            <div class="w3-card w3-border" style="min-height:200px; height: auto;">                                              
                                <iframe id="lokasi" style="min-height:250px; height: 250px; width: 100%; border: 1px solid grey;" src="{{ $tabel[0]->lokasimap }}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
                            </div>
                        </div>
                    </div>

                    <div class="row mb-0 align-items-center">
                        <div class="col-md-5 text-sm-end mt-2">
                        <h6>Keterangan</h6>
                        </div>
                        <div class="col-md-7" style="border-bottom: 2px solid white; border-top: 2px solid white;">
                            <button id="btn_keterangan1" name="btn_keterangan1" type="button" class="btn bg-primary rounded-0 text-white" style="width: 100%"></i>Keterangan</button>	
                        </div>
                    </div>

                </div>

            </div>

            <div class="modal-footer justify-content-between">
                <button id="btn_update" name="btn_update" type="button" class="w3-button w3-border w3-border-white" style="display: none"><i style="font-size:18px" class="fa">&#xf0c7;</i> Update</button>
            </div>
        
        </form>
    </div>	

    <!-- ModalSambutanks1 modal fade-->
    <div class="modal fade" id="ModalSambutanks1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Sambutan Kepala Sekolah</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="sambutanks1" name="sambutanks1">{!! $tabel[0]->sambutanks !!}</textarea>   
                    </div>

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
    <!-- end ModalSambutanks1 -->

    <!-- Modalvisi1 -->
    <div class="modal fade" id="Modalvisi1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Visi</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="visi1" name="visi1">{!! $tabel[0]->visi !!}</textarea>  
                    </div>

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
    <!-- end Modalvisi1 -->

    <!-- Modalmisi1 modal fade-->
    <div class="modal fade" id="Modalmisi1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Misi</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="misi1" name="misi1">{!! $tabel[0]->misi !!}</textarea> 
                    </div>

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
    <!-- end Modalmisi1 -->


    <!-- Modaltujuan1 modal fade-->
    <div class="modal fade" id="Modaltujuan1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Tujuan</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="tujuan1" name="tujuan1">{!! $tabel[0]->tujuan !!}</textarea> 
                    </div>

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
    <!-- end Modaltujuan1 -->

    <!-- Modalsejarah1 modal fade-->
    <div class="modal fade" id="Modalsejarah1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Sejarah</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="sejarah1" name="sejarah1">{!! $tabel[0]->sejarah !!}</textarea> 
                    </div>

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
    <!-- end Modalsejarah1 -->

    <!-- Modalprofil1 modal fade-->
    <div class="modal fade" id="Modalprofil1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Profil</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="profil1" name="profil1">{!! $tabel[0]->profil !!}</textarea> 
                    </div>

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
    <!-- end Modalprofil1 -->

    <!-- Modalketerangan1 modal fade-->
    <div class="modal fade" id="Modalketerangan1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div id="modalx" nama="modalx" class="modal-content shadow-lg border-0">
                
                <!-- Modal Header -->
                <div id="warnax" class="modal-header bg-primary text-white">
                    <h3 class="modal-title"><i id="iconx" name="iconx" class="bi-pencil-square"></i><b><span id="judulx" name="judulx"> Keterangan</span></b></h3>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form -->
                <form id="formSimpan" action="" method="GET" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="modal-body" id="bodyAdd" name="bodyAdd">                        
                        <textarea class="ckeditor" id="keterangan1" name="keterangan1">{!! $tabel[0]->keterangan !!}</textarea> 
                    </div>

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
    <!-- end Modalketerangan1 -->


</div>

<script type="text/javascript">
    
    document.addEventListener("DOMContentLoaded", function() {





    $('#video').attr('src', $('#videoprofil1').val());

    function readURLfotoks1(input) {
        if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    
                    $('.img-previewfotoks1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
    }

    $("#fotoks1").change(function() {
        var gbrx="<img class='img-previewfotoks1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoks1' name='img-previewfotoks1' style='width: 100%;'>";
        document.getElementById("gambarfotoks1").innerHTML=gbrx;
        readURLfotoks1(this);
    });

    function readURLlogo1(input) {
        if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    
                    $('.img-previewlogo1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
    }

    $("#logo1").change(function() {
        var gbrx="<img class='img-previewlogo1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewlogo1' name='img-previewlogo1' style='width: 100%;'>";
        document.getElementById("gambarlogo1").innerHTML=gbrx;
        readURLlogo1(this);
    });

    function readURLstruktur1(input) {
        if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    
                    $('.img-previewstruktur1').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
    }

    $("#strukturorganisasi1").change(function() {
        var gbrx="<img class='img-previewstruktur1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewstruktur1' name='img-previewstruktur1' style='width: 100%;'>";
        document.getElementById("gambarstruktur1").innerHTML=gbrx;
        readURLstruktur1(this);
    });

    function tampil_gambarfotoks1(){
        var gbr2=$('#fotoks1x').val();
        if(gbr2){                        
            var url2="{{ asset('storage/') }}/"+gbr2;
            var gbrx="<img src='"+url2+"' class='img-previewfotoks1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewfotoks1' name='img-previewfotoks1' style='width: 100%;' alt='"+url2+"'>";
        }else{
            var gbrx="<h3 class='mt-5' align='center'>Belum ada foto yang diupload<h3>";
        }
        document.getElementById("gambarfotoks1").innerHTML=gbrx;
    }
    tampil_gambarfotoks1();

    function tampil_gambarlogo1(){
        var gbr2=$('#logo1x').val();
        if(gbr2){                        
            var url2="{{ asset('storage/') }}/"+gbr2;
            var gbrx="<img src='"+url2+"' class='img-previewlogo1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewlogo1' name='img-previewlogo1' style='width: 100%;' alt='"+url2+"'>";
        }else{
            var gbrx="<h3 class='mt-5' align='center'>Belum ada logo yang diupload<h3>";
        }
        document.getElementById("gambarlogo1").innerHTML=gbrx;
    }
    tampil_gambarlogo1();

    function tampil_gambarstruktur1(){
        var gbr2=$('#strukturorganisasi1x').val();
        if(gbr2){                        
            var url2="{{ asset('storage/') }}/"+gbr2;
            var gbrx="<img src='"+url2+"' class='img-previewstruktur1 img-fluid col-sm-12 mb-1 mt-1 d-block' id='img-previewstruktur1' name='img-previewstruktur1' style='width: 100%;' alt='"+url2+"'>";
        }else{
            var gbrx="<h3 class='mt-5' align='center'>Belum ada struktur yang diupload<h3>";
        }
        document.getElementById("gambarstruktur1").innerHTML=gbrx;
    }
    tampil_gambarstruktur1();

    // CKEDITOR.ClassicEditor.create(document.getElementById("sambutanks1"),formatckeditor5);   
    $('#btn_sambutanks1').on('click',function(){
        $('#ModalSambutanks1').modal('show');
    });

    // CKEDITOR.ClassicEditor.create(document.getElementById("visi1"),formatckeditor5);
    $('#btn_visi1').on('click',function(){
        $('#Modalvisi1').modal('show');
    });

    // CKEDITOR.ClassicEditor.create(document.getElementById("misi1"),formatckeditor5);
    $('#btn_misi1').on('click',function(){
        $('#Modalmisi1').modal('show');
    });
    
    // CKEDITOR.ClassicEditor.create(document.getElementById("tujuan1"),formatckeditor5);
    $('#btn_tujuan1').on('click',function(){
        $('#Modaltujuan1').modal('show');
    });

    // CKEDITOR.ClassicEditor.create(document.getElementById("sejarah1"),formatckeditor5);
    $('#btn_sejarah1').on('click',function(){
        $('#Modalsejarah1').modal('show');
    });

    // CKEDITOR.ClassicEditor.create(document.getElementById("profil1"),formatckeditor5);
    $('#btn_profil1').on('click',function(){
        $('#Modalprofil1').modal('show');
    });

    $('#videoprofil1').on('keyup',function(){			
        let url = $(this).val();
        if(url.includes('embed')) return $('#video').attr('src', url);  
        url = new URLSearchParams(url);        
        url.forEach((a) => url = a);
        console.log(url);
        url = `https://www.youtube.com/embed/${url}`;
        $('#video').attr('src', url);
        console.log($('#video').attr('src'));
    });

    // CKEDITOR.ClassicEditor.create(document.getElementById("keterangan1"),formatckeditor5);
    $('#btn_keterangan1').on('click',function(){
        $('#Modalketerangan1').modal('show');
    });

    $('#btn_update1').on('click',function(){
        data_simpan();
    }); 

    function data_simpan(){
        var nama1=$('#nama1').val();
        var namasingkat1=$('#namasingkat1').val();
        var alamat1=$('#alamat1').val();
        var desa1=$('#desa1').val();
        var kecamatan1=$('#kecamatan1').val();
        var kabupaten1=$('#kabupaten1').val();
        var propinsi1=$('#propinsi1').val();
        var kodepos1=$('#kodepos1').val();
        var email1=$('#email1').val();
        var facebook1=$('#facebook1').val();
        var instagram1=$('#instagram1').val();
        var twitter1=$('#twitter1').val();
        var whatsapp1=$('#whatsapp1').val();
        var website1=$('#website1').val();
        var kontakperson1=$('#kontakperson1').val();
        var nomorkontak1=$('#nomorkontak1').val();
        var jabatankontak1=$('#jabatankontak1').val();
        var kepsek1=$('#kepsek1').val();
        var nipkepsek1=$('#nipkepsek1').val();
        
        var sambutanks1= CKEDITOR.instances['sambutanks1'].getData();
        var bendahara1=$('#bendahara1').val();
        var nipbendahara1=$('#nipbendahara1').val();
        var kotattd1=$('#kotattd1').val();
        var motto1=$('#motto1').val();
        var lokasimap1=$('#lokasimap1').val();
        
        var visi1=CKEDITOR.instances['visi1'].getData();
        var misi1=CKEDITOR.instances['misi1'].getData();
        var tujuan1=CKEDITOR.instances['tujuan1'].getData();
        var sejarah1=CKEDITOR.instances['sejarah1'].getData();
        
        var profil1=CKEDITOR.instances['profil1'].getData();
        var awalanprofil1=$('#awalanprofil1').val();
        var videoprofil1=$('#video').attr('src');
        var keterangan1=CKEDITOR.instances['keterangan1'].getData();

        const fotoks1 = $('#fotoks1').prop('files')[0];
        const logo1 = $('#logo1').prop('files')[0];
        const strukturorganisasi1 = $('#strukturorganisasi1').prop('files')[0];
        
        let formData = new FormData();
            formData.append('fotoks1', fotoks1);
            formData.append('logo1', logo1);
            formData.append('strukturorganisasi1', strukturorganisasi1);
            formData.append('nama1', nama1);
            formData.append('namasingkat1', namasingkat1);
            formData.append('alamat1', alamat1);
            formData.append('desa1', desa1);
            formData.append('kecamatan1', kecamatan1);
            formData.append('kabupaten1', kabupaten1);
            formData.append('propinsi1', propinsi1);
            formData.append('kodepos1', kodepos1);
            formData.append('email1', email1);
            formData.append('facebook1', facebook1);
            formData.append('instagram1', instagram1);
            formData.append('twitter1', twitter1);
            formData.append('whatsapp1', whatsapp1);
            formData.append('website1', website1);
            formData.append('kontakperson1', kontakperson1);
            formData.append('nomorkontak1', nomorkontak1);
            formData.append('jabatankontak1', jabatankontak1);
            formData.append('kepsek1', kepsek1);
            formData.append('nipkepsek1', nipkepsek1);
            formData.append('sambutanks1', sambutanks1);
            formData.append('bendahara1', bendahara1);
            formData.append('nipbendahara1', nipbendahara1);
            formData.append('kotattd1', kotattd1);
            formData.append('motto1', motto1);
            formData.append('lokasimap1', lokasimap1);

            formData.append('visi1', visi1);
            formData.append('misi1', misi1);
            formData.append('tujuan1', tujuan1);
            formData.append('sejarah1', sejarah1);
            formData.append('profil1', profil1);
            formData.append('awalanprofil1', awalanprofil1);
            formData.append('videoprofil1', videoprofil1);
            formData.append('keterangan1', keterangan1);

        $.ajax({
            enctype: 'multipart/form-data',
            type   : 'post',
            url    : '{{route('admin.instansi_update')}}',
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },				 				
            success : function(formData){                                         
                    swalupdate();
                },
            error : function(formData){                    
                   swalgagalupdate(); 
                }
        });
        
    }   
    function swalupdate(){
        Swal.fire({
            icon: 'success',
            title: 'Update successfully',
            text: $('#nama1').val(),
            timer:1000
        })
    }

    function swalgagalupdate(){
        Swal.fire({
            icon: 'error',
            title: 'Oops...failed to update',
            text: $('#nama1').val(),
            timer:1000
        })
    }
        
    });
    
</script>

@endsection