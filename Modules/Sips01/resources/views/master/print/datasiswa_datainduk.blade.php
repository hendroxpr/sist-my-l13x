<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <style>
        /* Mengatur batas luar kertas PDF */
        @page {
            margin: 1cm 1cm 1cm 2cm; /* Atas | Kanan | Bawah | Kiri */
        }
        
        /* Opsional: Reset margin body agar tidak menumpuk */
        body {
            margin: 0px;
            padding: 0px;
        }

    table {
        width: 100%;
        border-collapse: collapse; /* 1. Menghilangkan spasi antar garis/sel */
        border-spacing: 0;         /* 2. Memastikan jarak antar sel menjadi 0 */
        margin: 0;                 /* 3. Menghilangkan jarak luar tabel */

    }

    table td, 
    table th {
        padding: 0;                /* 4. Menghilangkan jarak dalam sel teks */
        margin: 0;                 /* 5. Reset margin sel */
        /* border: 1px solid #000000;  */
    }



    </style>
</head>
<body>
    @foreach ($tabel as $baris)
        
    <div class="row">
        <p align="center">
            <span style="font-size: 1.3em; font-weight: bold;">II. LEMBAR BUKU INDUK PESERTA DIDIK</span></br>
            <span>NOMOR INDUK SISWA NASIONAL / NOMOR INDUK SISWA SEKOLAH : {{ $baris->nisn }} / {{ $baris->nis }}  </span>
        </p>
    </div>

    <div class="row">
        <table style="width: 100%; border: 1px; font-size: 0.95em;">
            {{-- A. KETERANGAN TENTANG PESERTA DIDIK --}}
            <tr>
                <td colspan="5">
                    <b>A. KETERANGAN TENTANG PESERTA DIDIK</b>       
                </td>

                <td style="width: 2%">
                    {{-- spasi --}}
                </td>
                
                <td td colspan="5">
                    {{-- kol-2 --}}
                </td>

                <td style="width: 14%">
                    {{-- kol-foto --}}
                </td>

            </tr>
            {{-- 1/28 --}}
            <tr> 
                <td style="width: 2%; vertical-align: top;" rowspan="2"> </td>
                <td style="width: 2%; vertical-align: top; text-align: end;" rowspan="2">1.</td>
                <td style="width: 15%; vertical-align: top; text-align: start;" rowspan="2">Nama Lengkap Peserta Didik</td>
                <td style="width: 2%; vertical-align: top; text-align: center;" rowspan="2">:</td>
                <td style="width: 24%; vertical-align: top; text-align: start;" rowspan="2">{{ $baris->namalengkap ?? '-' }}</td>

                <td style="width: 1%; vertical-align: top;"></td>

                @php
                    if($baris->namaayah){
                        $pekerjaanayah = $baris->pekerjaanayah ?? '-';
                    }else{
                        $pekerjaanayah = '-';
                    }
                @endphp
                <td style="width: 2%; vertical-align: top;"></td>
                <td style="width: 2%; vertical-align: top; text-align: end;">28.</td>
                <td style="width: 15%; vertical-align: top; text-align: start;">Pekerjaan</td>
                <td style="width: 2%; vertical-align: top; text-align: center;">:</td>
                <td style="width: 24%; vertical-align: top; text-align: start;">{{ $pekerjaanayah }}</td>

                <td style="width: 9%; vertical-align: top; text-align: center;"></td>

            </tr>
            {{-- 29 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                
                @php
                    if($baris->namaayah){
                        $pengeluaranayah = \Illuminate\Support\Number::currency($baris->pengeluaranayah ?? 0, in: 'IDR', locale: 'id');
                    }else{
                        $pengeluaranayah = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">29.</td>
                <td style="vertical-align: top; text-align: start;">Pengeluaran/bulan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pengeluaranayah }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- NAMA PANGGILAN/30 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">Nama Panggilan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->namapanggilan ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaayah){
                        $alamatayah = $baris->alamatayah ?? '-';
                    }else{
                        $alamatayah = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">30.</td>
                <td style="vertical-align: top; text-align: start;">Alamat Rumah/Nomor Telp/HP</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $alamatayah }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 2/31 --}}
            <tr>
                @php
                    if($baris->jk->jk=='L'){
                        $jk = 'Laki-laki';
                    }else{
                        $jk = 'Perempuan';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">2.</td>
                <td style="vertical-align: top; text-align: start;">Jenis Kelamin</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $jk }}</td>

                <td style="vertical-align: top;"></td>
                @php
                    if($baris->namaayah){
                        if($baris->hidupayah=='Y'){
                            $hidupayah = 'Masih Hidup';
                        }else{
                            $hidupayah = 'Sudah meninggal tanggal  ' . \Carbon\Carbon::parse($baris->tglmeninggalayah ?? now())->locale('id')->isoFormat('DD MMMM YYYY');
                        }
                    }else{
                        $hidupayah = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">31.</td>
                <td style="vertical-align: top; text-align: start;">Masih hidup/meninggal dunia</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $hidupayah }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 3/ --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">3.</td>
                <td style="vertical-align: top; text-align: start;">Tempat dan tanggal lahir</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->tempatlahir->kabupaten }}, {{ \Carbon\Carbon::parse($baris->tgllahir ?? now())->locale('id')->isoFormat('DD MMMM YYYY') }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 4/F. KETERANGAN TENTANG IBU KANDUNG --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">4.</td>
                <td style="vertical-align: top; text-align: start;">Agama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->agama->agama }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;" colspan="5"><b>F. KETERANGAN TENTANG IBU KANDUNG</b></td>

                <td style="vertical-align: middle; text-align: center;" rowspan="8">
                    @php
                        $gbrx = 'app/public/' . $baris->fotoawal;
                        $path = storage_path($gbrx);
                        $pathx = storage_path('app/public/sips01-datasiswa-fotoawal/kotak.png');
                        
                        if(trim($baris->fotoawal)<>''){
                            if (file_exists($path)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            } else {
                                $base64 = ''; // Sediakan link gambar default/placeholder jika file tidak ditemukan

                                if (file_exists($pathx)) {
                                    $type = pathinfo($pathx, PATHINFO_EXTENSION);
                                    $data = file_get_contents($pathx);
                                    $base64x = 'data:image/' . $type . ';base64,' . base64_encode($data); 
                                }else{
                                    $base64x='';
                                }
                            }
                        }else{
                            $base64 = '';
                            if (file_exists($pathx)) {
                                $type = pathinfo($pathx, PATHINFO_EXTENSION);
                                $data = file_get_contents($pathx);
                                $base64x = 'data:image/' . $type . ';base64,' . base64_encode($data); 
                            }else{
                                $base64x='';
                            }

                        }
                    @endphp
                           

                    @if($base64)
                        <img src="{{ $base64 }}" style="width: 90px; height: 120px; border: 1px solid #000;">
                    @else
                        @if ($base64x)
                            <img src="{{ $base64x }}" style="width: 90px; height: 120px; border: 1px solid white;">
                        @else
                            <p>foto 3x4</p>
                        @endif
                    @endif
                    
                </td>
            </tr>
            {{-- 5/32 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">5.</td>
                <td style="vertical-align: top; text-align: start;">Kewarganegaraan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->warganegara }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">32.</td>
                <td style="vertical-align: top; text-align: start;">Nama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->namaibu ?? '-' }}</td>

                
            </tr>
            {{-- 6/33 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">6.</td>
                <td style="vertical-align: top; text-align: start;">Anak keberapa</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->anakke ?? 0 }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaibu){
                        $tmpibu = $baris->tempatlahiribu->kabupaten ?? '-';
                        $tglibu = \Carbon\Carbon::parse($baris->tgllahiribu ?? now())->locale('id')->isoFormat('DD MMMM YYYY');
                        $ttlibu = $tmpibu . ', ' . $tglibu;
                    }else{
                        $ttlibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">33.</td>
                <td style="vertical-align: top; text-align: start;">Tempat dan tanggal lahir</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $ttlibu }}</td>

            </tr>
            {{-- 7/34 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">7.</td>
                <td style="vertical-align: top; text-align: start;">Jumlah saudara kandung</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->jmlsdrkandung ?? 0 }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaibu){
                        $agamaibu = $baris->agamaibu->agama ?? 'Islam';
                    }else{
                        $agamaibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">34.</td>
                <td style="vertical-align: top; text-align: start;">Agama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $agamaibu }}</td>

            </tr>
            {{-- 8/35 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">8.</td>
                <td style="vertical-align: top; text-align: start;">Jumlah saudara tiri</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->jmlsdrtiri ?? 0 }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaibu){
                        $warganegaraibu = $baris->warganegaraibu->agama ?? 'Islam';
                    }else{
                        $warganegaraibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">35.</td>
                <td style="vertical-align: top; text-align: start;">Kewarganegaraan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $warganegaraibu }}</td>

            </tr>
            {{-- 9/36 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">9.</td>
                <td style="vertical-align: top; text-align: start;">Jumlah saudara angkat</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->jmlsdrangkat ?? 0 }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaibu){
                        $pendidikanibu = $baris->pendidikanibu->pendidikan ?? '-';
                    }else{
                        $pendidikanibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">36.</td>
                <td style="vertical-align: top; text-align: start;">Pendidikan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pendidikanibu }}</td>

            </tr>
            {{-- 10/37 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">10.</td>
                <td style="vertical-align: top; text-align: start;">Anak yatim / piatu / yatim piatu</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->statusanak->statusanak }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaibu){
                        $pekerjaanibu = $baris->pekerjaanibu ?? '-';
                    }else{
                        $pekerjaanibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">37.</td>
                <td style="vertical-align: top; text-align: start;">Pekerjaan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pekerjaanibu }}</td>

            </tr>
            {{-- 11/38 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">11.</td>
                <td style="vertical-align: top; text-align: start;">Bahasa sehari-hari di rumah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->bahasa }}</td>

                <td style="vertical-align: top;"></td>
                @php
                    if($baris->namaibu){
                        $pengeluaranibu = \Illuminate\Support\Number::currency($baris->pengeluaranibu, in: 'IDR', locale: 'id');
                    }else{
                        $pengeluaranibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">38.</td>
                <td style="vertical-align: top; text-align: start;">Pengeluaran/bulan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pengeluaranibu }}</td>

            </tr>
            {{-- /39 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top;"></td>
                @php
                    if($baris->namaibu){
                        $alamatibu = $baris->alamatibu ?? '-';
                    }else{
                        $alamatibu = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">39.</td>
                <td style="vertical-align: top; text-align: start;">Alamat Rumah/Nomor Telp/HP</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $alamatibu }}</td>

                <td style="vertical-align: top; text-align: center;">waktu diterima</td>

            </tr>
            {{-- B. KETERANGAN TEMPAT TINGGAL/40 --}}
            <tr>
                <td style="vertical-align: top;" colspan="5"><b>B. KETERANGAN TEMPAT TINGGAL</b></td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaibu){
                        if($baris->hidupibu=='Y'){
                            $hidupibu = 'Masih Hidup';
                        }else{
                            $hidupibu = 'Sudah meninggal tanggal  ' . \Carbon\Carbon::parse($baris->tglmeninggalibu ?? now())->locale('id')->isoFormat('DD MMMM YYYY');
                        }
                    }else{
                        $hidupibu = '-';
                    }
                @endphp

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">40.</td>
                <td style="vertical-align: top; text-align: start;">Masih hidup/meninggal dunia</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $hidupibu }}</td>
                
                <td style="vertical-align: top; text-align: center;">di sekolah ini</td>
            </tr>
            {{-- 12 --}}
            <tr>
                <td style="vertical-align: top;" rowspan="2"></td>
                <td style="vertical-align: top; text-align: end;" rowspan="2">12.</td>
                <td style="vertical-align: top; text-align: start;" rowspan="2">Alamat</td>
                <td style="vertical-align: top; text-align: center;" rowspan="2">:</td>
                <td style="vertical-align: top; text-align: start;" rowspan="2">{{ $baris->alamat ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- /G. KETERANGAN TENTANG WALI --}}
            <tr>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;" colspan="5"><b>G. KETERANGAN TENTANG WALI</b></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 13/41 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">13.</td>
                <td style="vertical-align: top; text-align: start;">Nomor telepon / HP</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->telp ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">41.</td>
                <td style="vertical-align: top; text-align: start;">Nama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->namawali ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 14/42 --}}
            <tr>
                <td style="vertical-align: top;" rowspan="2"></td>
                <td style="vertical-align: top; text-align: end;" rowspan="2">14.</td>
                <td style="vertical-align: top; text-align: start;" rowspan="2">Tinggal dengan Orang tua / Saudara / Di asrama / Kost</td>
                <td style="vertical-align: top; text-align: center;" rowspan="2">:</td>
                <td style="vertical-align: top; text-align: start;" rowspan="2">{{ $baris->tinggal->tinggal ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namawali){
                        $tmpwali = $baris->tempatlahirwali->kabupaten ?? '-';
                        $tglwali = \Carbon\Carbon::parse($baris->tgllahirwali ?? now())->locale('id')->isoFormat('DD MMMM YYYY');
                        $ttlwali = $tmpwali . ', ' . $tglwali;
                    }else{
                        $ttlwali = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">42.</td>
                <td style="vertical-align: top; text-align: start;">Tempat dan tanggal lahir</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $ttlwali }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- /43 --}}
            <tr>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namawali){
                        $agamawali = $baris->agamawali->agama ?? 'Islam';
                    }else{
                        $agamawali = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">43.</td>
                <td style="vertical-align: top; text-align: start;">Agama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $agamawali }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 15/44 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">15.</td>
                <td style="vertical-align: top; text-align: start;">Jarak tempat tinggal ke sekolah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->jarakkesekolah ?? 1 }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namawali){
                        $warganegarawali = $baris->warganegarawali ?? 'WNI';
                    }else{
                        $warganegarawali = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">44.</td>
                <td style="vertical-align: top; text-align: start;">Kewarganegaraan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $warganegarawali }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- /45 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namawali){
                        $pendidikanwali = $baris->pendidikanwali->pendidikan ?? '-';
                    }else{
                        $pendidikanwali = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">45.</td>
                <td style="vertical-align: top; text-align: start;">Pendidikan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pendidikanwali }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- C. KETERANGAN KESEHATAN/46 --}}
            <tr>
                <td style="vertical-align: top;" colspan="5"><b>C. KETERANGAN KESEHATAN</b></td>
                
                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">46.</td>
                <td style="vertical-align: top; text-align: start;">Pekerjaan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->pekerjaanwali ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 16/47 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">16.</td>
                <td style="vertical-align: top; text-align: start;">Golongan Darah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->gd->gd ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namawali){
                        $pengeluaranwali = \Illuminate\Support\Number::currency($baris->pengeluaranwali ?? 0, in: 'IDR', locale: 'id');
                    }else{
                        $pengeluaranwali = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">47.</td>
                <td style="vertical-align: top; text-align: start;">Pengeluaran/bulan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pengeluaranwali }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 17/48 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">17.</td>
                <td style="vertical-align: top; text-align: start;">Penyakit yang pernah diderita</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->penyakit ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namawali){
                        $alamatwali = $baris->alamatwali ?? '-';
                    }else{
                        $alamatwali = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">48.</td>
                <td style="vertical-align: top; text-align: start;">Alamat Rumah/Nomor Telp/HP</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $alamatwali }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 18/ --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">18.</td>
                <td style="vertical-align: top; text-align: start;">Kelainan jasmani</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->kelainan ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 19/ --}}
            <tr>
                <td style="vertical-align: top;" rowspan="2"></td>
                <td style="vertical-align: top; text-align: end;" rowspan="2">19.</td>
                <td style="vertical-align: top; text-align: start;" rowspan="2">Tinggi dan berat badan</br>(saat diterima di sekolah ini)</td>
                <td style="vertical-align: top; text-align: center;" rowspan="2">:</td>
                <td style="vertical-align: top; text-align: start;" rowspan="2"> {{ $baris->tinggibadan ?? 0 }} cm / {{ $baris->beratbadan ?? 0 }} kg</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;" colspan="5"><b>H. KEGEMARAN PESERTA DIDIK</b></td>
                

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- /49 --}}
            <tr>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">49.</td>
                <td style="vertical-align: top; text-align: start;">Kesenian</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->hobikesenian ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>

            {{-- /50 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">50.</td>
                <td style="vertical-align: top; text-align: start;">OLahraga</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->hobiolahraga ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- D. KETERANGAN PENDIDIKAN/51 --}}
            <tr>
                <td style="vertical-align: top;" colspan="5"><b>D. KETERANGAN PENDIDIKAN</b></td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">51.</td>
                <td style="vertical-align: top; text-align: start;">Kemasyarakatan / Organisasi</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->hobiorganisasi ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 20/52 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">20.</td>
                <td style="vertical-align: top; text-align: start;">Pendidikan sebelumya</td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">52.</td>
                <td style="vertical-align: top; text-align: start;">Lain-lain</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->hobilain ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 20a/ --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">a. Tamatan dari</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->asalsekolah ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 20b/ I. KETERANGAN PERKEMBANGAN PESERTA DIDIK--}}
            <tr>
                @php
                    if($baris->tglsttb && $baris->nomorsttb){
                        $tnsttb = ($baris->nomorsttb ?? '-') . ' / ' . (\Carbon\Carbon::parse($baris->tglsttb ?? now())->locale('id')->isoFormat('DD MMMM YYYY'));;
                    }else{
                        $tnsttb = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">b. Nomor / Tanggal ijazah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $tnsttb }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;" colspan="5"><b>I. KETERANGAN PERKEMBANGAN PESERTA DIDIK</b></td>

                <td style="vertical-align: middle; text-align: center;" rowspan="8">
                     @php
                        $gbrx = 'app/public/' . $baris->fotoakhir;
                        $path = storage_path($gbrx);
                        $pathx = storage_path('app/public/sips01-datasiswa-fotoawal/kotak.png');
                        
                        if(trim($baris->fotoakhir)<>''){
                            if (file_exists($path)) {
                                $type = pathinfo($path, PATHINFO_EXTENSION);
                                $data = file_get_contents($path);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                            } else {
                                $base64 = ''; // Sediakan link gambar default/placeholder jika file tidak ditemukan

                                if (file_exists($pathx)) {
                                    $type = pathinfo($pathx, PATHINFO_EXTENSION);
                                    $data = file_get_contents($pathx);
                                    $base64x = 'data:image/' . $type . ';base64,' . base64_encode($data); 
                                }else{
                                    $base64x='';
                                }
                            }
                        }else{
                            $base64 = '';
                            if (file_exists($pathx)) {
                                $type = pathinfo($pathx, PATHINFO_EXTENSION);
                                $data = file_get_contents($pathx);
                                $base64x = 'data:image/' . $type . ';base64,' . base64_encode($data); 
                            }else{
                                $base64x='';
                            }

                        }
                    @endphp
                           

                    @if($base64)
                        <img src="{{ $base64 }}" style="width: 90px; height: 120px; border: 1px solid #000;">
                    @else
                        @if ($base64x)
                            <img src="{{ $base64x }}" style="width: 90px; height: 120px; border: 1px solid white;">
                        @else
                            <p>foto 3x4</p>
                        @endif
                    @endif
                                
                </td>
            </tr>
            {{-- 20c/ 53a --}}
            <tr>
                @php
                    if($baris->tglskhun && $baris->nomorskhun){
                        $tnskhun = ($baris->nomorskhun ?? '-') . ' / ' . (\Carbon\Carbon::parse($baris->tglskhun ?? now())->locale('id')->isoFormat('DD MMMM YYYY'));
                    }else{
                        $tnskhun = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">c. Nomor / Tanggal STL/SKHUN</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $tnskhun }} </td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">53.</td>
                <td style="vertical-align: top; text-align: start;">Menerima Bea Siswa</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $beasiswa0 }}</td>

            </tr>
            {{-- 20d/ 53b --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">d. Lama belajar</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->lamabelajar ?? 3 }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;">{{ $beasiswa1 }}</td>

            </tr>
            {{-- 21/ 53c --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">21.</td>
                <td style="vertical-align: top; text-align: start;">Pindahan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->pindah ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;">{{ $beasiswa2 }}</td>

            </tr>
            {{-- 21a/ 54 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">a. Dari sekolah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->sekolahpindah ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">54.</td>
                <td style="vertical-align: top; text-align: start;">Meninggalkan sekolah ini</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;"></td>

            </tr>
            {{-- 21b/ 54a --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">b. Alasan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->alasanpindah ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">a. Tanggal meninggalkan sekolah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ \Carbon\Carbon::parse($baris->tglkeluar ?? now())->locale('id')->isoFormat('DD MMMM YYYY') }}</td>

            </tr>
            {{-- 22/ 54b --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">22.</td>
                <td style="vertical-align: top; text-align: start;">Diterima di sekolah ini</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">b. Alasan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->alasankeluar->alasankeluar ?? '-' }}</td>

            </tr>
            {{-- 22a/ 55 --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">a. Di Kelas</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $kelas }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">55.</td>
                <td style="vertical-align: top; text-align: start;">Akhir Pendidikan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;"></td>

            </tr>
            {{-- 22b/ 55a --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">b. Bidang Keahlian</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $bidang }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">a. Lulus</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">Tahun {{ \Carbon\Carbon::parse($baris->tglkeluar ?? now())->locale('id')->isoFormat('YYYY') }}</td>

                <td style="vertical-align: top; text-align: center;">waktu meninggalkan</td>
            </tr>
            {{-- 22c/ 55b --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">c. Program Keahlian</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $program }}</td>

                <td style="vertical-align: top;"></td>
                @php
                    if($baris->tglijasahlulus && $baris->nomorijasahlulus){
                        $tnijasahlulus = ($baris->nomorijasahlulus ?? '-') . ' / ' . (\Carbon\Carbon::parse($baris->tglijasahlulus ?? now())->locale('id')->isoFormat('DD MMMM YYYY'));;
                    }else{
                        $tnijasahlulus = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">b. Nomor / Tanggal Ijazah</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $tnijasahlulus }}</td>

                <td style="vertical-align: top; text-align: center;">sekolah ini</td>
            </tr>
            {{-- 22d/ 55c --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">d. Keahlian</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $kompetensi }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->tglskhunlulus && $baris->nomorskhunlulus){
                        $tnskhunlulus = ($baris->nomorskhunlulus ?? '-') . ' / ' . (\Carbon\Carbon::parse($baris->tglskhunlulus ?? now())->locale('id')->isoFormat('DD MMMM YYYY'));;
                    }else{
                        $tnskhunlulus = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">c. Nomor / Tanggal SKHUN</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $tnskhunlulus }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 22e/  --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">e. Tanggal / Bulan / Tahun</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ \Carbon\Carbon::parse($baris->tglditerima ?? now())->locale('id')->isoFormat('DD MMMM YYYY') }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 22e/  --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;" colspan="5"><b>J. KETERANGAN SETELAH SELESAI PENDIDIKAN</b></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
             {{-- E. KET/56  --}}
            <tr>
                 <td style="vertical-align: top;" colspan="5"><b>E. KETERANGAN TENTANG AYAH KANDUNG</b></td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">56.</td>
                <td style="vertical-align: top; text-align: start;">Melanjutkan ke</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->sekolahlanjut }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 23/57  --}}
            <tr>
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">23.</td>
                <td style="vertical-align: top; text-align: start;">Nama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->namaayah ?? '-' }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">57.</td>
                <td style="vertical-align: top; text-align: start;">Bekerja di</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->kerjadi ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 24/57a  --}}
            <tr>
                @php
                    if($baris->namaayah){
                        $tplayah = $baris->tempatlahirayah->kabupaten ?? '-';
                        $tglayah = \Carbon\Carbon::parse($baris->tgllahirayah ?? now())->locale('id')->isoFormat('DD MMMM YYYY');
                        $ttlayah = $tplayah . ', ' . $tglayah;
                    }else{
                        $ttlayah = '-';
                    }
                @endphp
                
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">24.</td>
                <td style="vertical-align: top; text-align: start;">Tempat dan tanggal lahir</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $ttlayah }}</td>

                <td style="vertical-align: top;"></td>

                @php
                    if($baris->namaperusahaan){
                        $tglmulaikerja = \Carbon\Carbon::parse($baris->tglmulaikerja ?? now())->locale('id')->isoFormat('DD MMMM YYYY');
                    }else{
                        $tglmulaikerja = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">a. Tanggal Mulai Bekerja</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $tglmulaikerja }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 25/57b  --}}
            <tr>
                @php
                    if($baris->namaayah){
                        $agamaayah = $baris->agamaayah->agama ?? '-';
                    }else{
                        $agamaayah = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">25.</td>
                <td style="vertical-align: top; text-align: start;">Agama</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $agamaayah }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">b. Nama Perusahaan / lembaga</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $baris->namaperusahaan ?? '-' }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 26/57c  --}}
            <tr>
                @php
                    if($baris->namaayah){
                        $warganegaraayah = $baris->warganegaraayah ?? 'WNI';
                    }else{
                        $warganegaraayah = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">26.</td>
                <td style="vertical-align: top; text-align: start;">Kewarganegaraan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $warganegaraayah }}</td>

                <td style="vertical-align: top;"></td>
                
                @php
                    if($baris->namaperusahaan){
                        $penghasilankerja = \Illuminate\Support\Number::currency($baris->penghasilankerja ?? 0, in: 'IDR', locale: 'id');
                    }else{
                        $penghasilankerja = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;">c. Penghasilan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $penghasilankerja }}</td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>
            {{-- 27/  --}}
            <tr>
                @php
                    if($baris->namaayah){
                        $pendidikanayah = $baris->pendidikanayah->pendidikan ?? '-';
                    }else{
                        $pendidikanayah = '-';
                    }
                @endphp
                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;">27.</td>
                <td style="vertical-align: top; text-align: start;">Pendidikan</td>
                <td style="vertical-align: top; text-align: center;">:</td>
                <td style="vertical-align: top; text-align: start;">{{ $pendidikanayah }}</td>

                <td style="vertical-align: top;"></td>

                <td style="vertical-align: top;"></td>
                <td style="vertical-align: top; text-align: end;"></td>
                <td style="vertical-align: top; text-align: start;"></td>
                <td style="vertical-align: top; text-align: center;"></td>
                <td style="vertical-align: top; text-align: start;"></td>

                <td style="vertical-align: top; text-align: center;"></td>
            </tr>

            
        </table>
    </div>

    @endforeach
</body>
</html>