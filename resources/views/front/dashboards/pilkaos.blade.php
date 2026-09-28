<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>


    <link rel="icon" href="{{ asset('storage/') }}/{{ $instansi[0]->logo }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/bootstrap-5.2.2/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}"> 
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/toastr/toastr.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/datetimepicker/datetimepicker.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/jquery.smartmenus/jquery.smartmenus.bootstrap-4.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/jquery.smartmenus/sm-core.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/jquery.smartmenus/sm-clean.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/plugins/magnific-popup/magnific-popup.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/css/loading.css') }}">
    
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert2.min.js') }}"></script>

    <link type="text/css" rel="stylesheet" href="{{ asset('assets/front/themes/sky_light/style.css') }}">
    <script src="{{ asset('assets/front/js/frontend.min.js') }}"></script>
    <style>
        @media (max-width: 720px) {
        .row { flex-direction: column; max-width: 480px; }
        }

        .gurudanpegawai01-title {
            height: 40px; 
            width: 100%;
            background-color: #0f6fc7;overflow: hidden;
            color: white;
            font-size: 1.5em;
        }

        .gurudanpegawai01-img:hover img{
            transform: scale(1.1);
            /* box-shadow: 0 0 0 0.5rem rgba(135, 206, 250, 0.5) !important; */
            box-shadow: 0 0 0 0.5rem rgba(61, 104, 236, 0.5) !important;
            border-color: #87cefa !important;
            
        }
        .gurudanpegawai01-img img{
            transition: all 0.4s ease 0s;
        }

        img{
            width: 100%; 
            height: 500px;
            box-shadow: 0 0 0 0.1rem rgba(61, 104, 236, 0.5) !important;
            border-color: #87cefa !important;
        }
        
    </style>

</head>
{{-- <body class="text-center" style="display:flex; align:center; justify-content:center;"> --}}
<body class="text-center" style="align:center; justify-content:center; width: 100%;">
    @php
        $napel = session('namapemilih');
        if ($napel==''){
            return redirect('/loginevot');
        }
    @endphp
    
        <div class="row">
            <h3 class="font-weight-bold"><font style="color:#343a40;">Assalamu'alaikum, {{ session('namapemilih') }}</font></h3>
            <h4 class="font-weight-bold text-dark mb-2">Salurkan aspirasimu yang terbaik pada</h4>
            <h3 class="font-weight-bold text-dark mb-4">{{ $periode[0]->namavote }}</h3>
        </div>

        <div class="row text-center" style="display:flex; align-items: center; align:center; justify-content:center; width: 85%;  margin: 0 auto;">
            @php
                $jmlx = $jmlkandidat;
            @endphp
            
            <div class="col-md-4 text-center mb-2">
                <div class="col-md-12  text-center">
                    <div class="card rounded-4 text-center" style="width: auto; cursor: pointer;">
                        <div class="gurudanpegawai01-img w3-card w3-border rounded-4" name="gbx1" id="gbx1">
                            <input name="pilih1" id="pilih1" type="hidden" value="{{ $kandidat[0]->nomor }}">
                            <img src="{{ route('front.index') }}/storage/{{ $kandidat[0]->foto }}" class="card-img-top rounded-4" alt="...">
                        </div>

                    </div>

                    <div class="gurudanpegawai01-title rounded-4 mt-2" style="height: 80px;">
                        <p class="card-text px- mt-4">{{ $kandidat[0]->nama }}</p>
                    </div>

                </div>
            </div>
        
            <div class="col-md-4 text-center mb-2">
                <div class="col-md-12  text-center">
                    <div class="card rounded-4 text-center" style="width: auto; cursor: pointer;">
                        <div class="gurudanpegawai01-img w3-card w3-border rounded-4"  name="gbx2" id="gbx2"  >
                            <input name="pilih2" id="pilih2" type="hidden" value="{{ $kandidat[1]->nomor }}">
                            <img src="{{ route('front.index') }}/storage/{{ $kandidat[1]->foto }}" class="card-img-top rounded-4" alt="...">
                        </div>
                    </div>
                    <div class="gurudanpegawai01-title rounded-4 mt-2" style="height: 80px;">
                        <p class="card-text px-1 mt-4">{{ $kandidat[1]->nama }}</p>
                    </div>
                </div>
            </div> 

            <div class="col-md-4 text-center mb-2">
                <div class="col-md-12  text-center">
                    <div class="card rounded-4 text-center" style="width: auto; cursor: pointer;">
                        <div class="gurudanpegawai01-img w3-card w3-border rounded-4"  name="gbx3" id="gbx3"  >
                            <input name="pilih3" id="pilih3" type="hidden" value="{{ $kandidat[2]->nomor }}">
                            <img src="{{ route('front.index') }}/storage/{{ $kandidat[2]->foto }}" class="card-img-top rounded-4" alt="...">
                        </div>
                    </div>
                    <div class="gurudanpegawai01-title rounded-4 mt-2" style="height: 80px;">
                        <p class="card-text px-1 mt-4">{{ $kandidat[2]->nama }}</p>
                    </div>
                </div>
            </div>

        </div>


        <div class="row text-center" style="display: none;">
            <div class="col-6-md text-center">
                <h1><b><span id="komentar" id="komentar"></span></b></h1>
            </div>
        </div>

        <form method="post" id="formLogin" name="formLogin" action="{{ route('front.admin_cekpilkaos') }}" style="display: none;">
            @csrf              
            <input name="idx" id="idx" class="" type="hidden" value="{{ session('idpemilih') }}">           
            <input name="nomorx" id="nomorx" class="" type="hidden" value="">           
            <div class="py-0">
                <button id="btn_simpan" name="btn_simpan" type="submit" style="width: 100%; padding-top:15px; padding-bottom:15px;" class="btn btn-lg btn-primary btn-block rounded-0" id="submit">Simpan</button>
            </div>
        </form>

        <div class="row" style="display:flex; align:center; justify-content:center;">
            <p class="pt-3 text-muted">
                <div class="float-right d-none d-sm-block">
                    Developed by team IT {{ session('memnamasingkat') }}
                    </div>
                    <strong> 
                        Copyright &copy; 2022-<?= date('Y'); ?> {{ session('memnamasingkat') }}
                    </strong> 
                    All rights reserved. Build v{{ Illuminate\Foundation\Application::VERSION }} 
                    PHP v<?php print phpversion(); ?>               
            </p>
        </div>


    
<script type="text/javascript">
        var mydataDatatable;
       
    $(document).ready(function(){
        
        $('#komentar').text('SAYA BELUM MEMILIH');
        //entry data -> ok
        $('#gbx1').on('click',function(){
            no = $('#pilih1').val();
            $('#nomorx').val(no);
            $('#komentar').text('SAYA PILIH PASLON ' + no);
            modal_pilih(no);                      
        });
        $('#gbx2').on('click',function(){
            no = $('#pilih2').val();
            $('#nomorx').val(no);
            $('#komentar').text('SAYA PILIH PASLON ' + no); 
            modal_pilih(no);                     
        });
        $('#gbx3').on('click',function(){
            no = $('#pilih3').val();
            $('#nomorx').val(no);
            $('#komentar').text('SAYA PILIH PASLON ' + no);
            modal_pilih(no);                      
        });
    
        function modal_pilih(x){
            Swal.fire({
            title: 'Saya Pilih Paslon ' +x,
            text: 'yakinkah .....?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, yakin !",
            cancelButtonText: "Tidak, batal !",
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#btn_simpan').click();          
                }
            })
        } 

        


        
    
    });
    </script>  
</body>
</html>