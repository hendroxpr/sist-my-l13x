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
            margin: 1cm 1cm 1cm 1cm; /* Atas | Kanan | Bawah | Kiri */
        }
        
        /* Opsional: Reset margin body agar tidak menumpuk */
        body {
            margin: 0px;
            padding: 0px;
        }

        table {
            /* width: 100%; */
            border-collapse: collapse; /* 1. Menghilangkan spasi antar garis/sel */
            border-spacing: 0;         /* 2. Memastikan jarak antar sel menjadi 0 */
            margin: 0;                 /* 3. Menghilangkan jarak luar tabel */
            
        }

        table.garis, table.garis td {
            padding: 1;                /* 4. Menghilangkan jarak dalam sel teks */
            margin: 0;                 /* 5. Reset margin sel */
            border: 1px solid #000000;
        }
        
        @font-face {
            font-family: 'ArialNarrowCustom';
            src: url("{{ storage_path('fonts/ARIALN.TTF') }}") format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        div { 
            font-family: 'ArialNarrowCustom', sans-serif; 
            font-size: 0.65em; 
            line-height: 1.2; 
        }

        /* Mengatur pembungkus teks vertikal */
        .vertical-text {
            /* Menentukan tinggi kolom agar teks tidak terpotong saat diputar */
            height: 120px; 
            white-space: nowrap;
        }

        .vertical-text span {
            /* Memutar teks 270 derajat (membaca dari bawah ke atas) */
            transform: rotate(-90deg);
            -webkit-transform: rotate(-90deg); /* Untuk kompatibilitas DomPDF */
            
            /* Memastikan titik poros rotasi berada di tengah/tepat */
            display: inline-block;
            transform-origin: center center;
            
            /* Mengatur posisi agar pas di tengah kolom */
            width: 20px;
        }

        /* 3. TRIK UTAMA: Memaksa tinggi tetap dan memotong teks yang lewat */
        .force-height {
            height: 25px;       /* Kunci tinggi baris di sini */
            line-height: 25px;  /* Membuat teks otomatis rata tengah secara vertikal */
            font-size: 11px;
            
            /* Cegah teks turun ke bawah */
            white-space: nowrap; 
            
            /* KUNCI UTAMA: Potong teks yang meluap agar baris tidak melar */
            overflow: hidden;   
            
            /* Opsional: Beri efek titik-titik (...) jika teks terpotong */
            text-overflow: ellipsis; 
        }

        .table-tanpa-garis-kanan th, 
        .table-tanpa-garis-kanan td {
            border-right: none !important;
        }
        
        .table-tanpa-garis-kiri th, 
        .table-tanpa-garis-kiri td {
            border-left: none !important;
        }
        
        .table-tanpa-garis-atas th, 
        .table-tanpa-garis-atas td {
            border-top: none !important;
        }
        .table-tanpa-garis-bawah th, 
        .table-tanpa-garis-bawah td {
            border-bottom: none !important;
        }
        


    </style>

</head>
<body>
    @php 
        use Modules\Sips01\Models\Kelompokmapel; 
        use Modules\Sips01\Models\Mapel; 
        use Modules\Sips01\Models\Nilai;
        use Modules\Sips01\Models\Tp;
        use Modules\Sips01\Models\Magang;
        use Modules\Sips01\Models\Absensi;
        use Modules\Sips01\Models\Datasiswa;

        $smk = strtoupper(session('memnamasingkat'));
        $iddatasiswa = $siswakelas[0]->iddatasiswa;
    @endphp
    
    <div class="row">
        <table width="100%" border="0">
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td rowspan="4" align="center"><b>
                    <span style="font-size: 2em;">LAPORAN PENILAIAN HASIL BELAJAR</span><br>
                    <span style="font-size: 1.7em;">PESERTA DIDIK SMK (K-MERDEKA)</span></b>
                </td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 190px">NAMA PESERTA DIDIK</td>
                <td style="width: 10px;" align="center">:</td>
                <td>{{ $siswakelas[0]->datasiswa->namalengkap }}</td>
                <td style="width: 130px">BIDANG KEAHLIAN</td>
                <td style="width: 10px" align="center">:</td>
                <td>{{ $siswakelas[0]->kelas->kompetensi->program->bidang->bidang }}</td>
            </tr>
            <tr>
                <td>NOMOR INDUK SISWA NASIONAL</td>
                <td style="width: 10px;" align="center">:</td>
                <td>{{ $siswakelas[0]->datasiswa->nisn }}</td>
                <td>PROGRAM KEAHLIAN</td>
                <td style="width: 10px;" align="center">:</td>
                <td>{{ $siswakelas[0]->kelas->kompetensi->program->program }}</td>
            </tr>
            <tr>
                <td>NOMOR INDUK SISWA SEKOLAH</td>
                <td style="width: 10px;" align="center">:</td>
                <td>{{ $siswakelas[0]->datasiswa->nis }}</td>
                <td>PAKET KEAHLIAN</td>
                <td style="width: 10px;" align="center">:</td>
                <td>{{ $siswakelas[0]->kelas->kompetensi->kompetensi }}</td>
            </tr>
        </table>

        <table width="100%" class="garis">
            <tr>
                <td align="center" rowspan="6">NO</td>
                <td align="center">TAHUN PELAJARAN</td>
                <td align="center"></td>
                @php
                    $tpx = Nilai::select('idtp')->where('iddatasiswa','=',$iddatasiswa)
                    ->with(['datasiswa','mapel','tp'])
                    ->where('smt','>=',1)
                    ->where('smt','<=',2)
                    ->get();
                    $tp = $tpx[0]->tp->tp ?? ''; 
                @endphp
                <td align="center" colspan="2">{{ $tp }}</td>
                @php
                    $tpx = Nilai::select('idtp')->where('iddatasiswa','=',$iddatasiswa)
                    ->with(['datasiswa','mapel','tp'])
                    ->where('smt','>=',3)
                    ->where('smt','<=',4)
                    ->get();
                    $tp = $tpx[0]->tp->tp ?? ''; 
                @endphp
                <td align="center" colspan="2">{{ $tp }}</td>
                @php
                    $tpx = Nilai::select('idtp')->where('iddatasiswa','=',$iddatasiswa)
                    ->with(['datasiswa','mapel','tp'])
                    ->where('smt','>=',5)
                    ->where('smt','<=',6)
                    ->get();
                    $tp = $tpx[0]->tp->tp ?? ''; 
                @endphp
                <td align="center" colspan="2">{{ $tp }}</td>
                @php
                    $tpx = Nilai::select('idtp')->where('iddatasiswa','=',$iddatasiswa)
                    ->with(['datasiswa','mapel','tp'])
                    ->where('smt','>=',7)
                    ->where('smt','<=',8)
                    ->get();
                    $tp = $tpx[0]->tp->tp ?? ''; 
                @endphp
                <td align="center" colspan="2">{{ $tp }}</td>
                @php
                   $tahunx = Nilai::select('idtp')->where('iddatasiswa','=',$iddatasiswa)
                    ->with(['datasiswa','mapel','tp'])
                    ->where('smt','>=',21)
                    ->where('smt','<=',23)
                    ->get();
                     
                    $exp_thn = explode("/", $tahunx[0]->tp->tp ?? '........../..........');
                    $thn = $exp_thn[1];
                @endphp
                <td align="center" colspan="5" rowspan="4">NILAI UJIAN AKHIR<br>TAHUN {{ $thn }}</td>
            </tr>
            <tr>
                <td align="center">KELAS</td>
                <td align="center"></td>
                <td align="center">1</td>
                <td align="center">2</td>
                <td align="center">3</td>
                <td align="center">4</td>
                <td align="center">5</td>
                <td align="center">6</td>
                <td align="center">7</td>
                <td align="center">8</td>                
            </tr>
            <tr>
                <td align="center" style="padding-left: 70px;">SEMESTER</td>
                <td align="center"></td>
                <td align="center">Semester 1</td>
                <td align="center">Semester 2</td>
                <td align="center">Semester 3</td>
                <td align="center">Semester 4</td>
                <td align="center">Semester 5</td>
                <td align="center">Semester 6</td>
                <td align="center">Semester 7</td>
                <td align="center">Semester 8</td>            
            </tr>
            <tr>
                <td rowspan="3">MATA PELAJARAN</td>
                <td align="center" rowspan="3">KKM</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>
                <td align="center">NSS</td>>                
            </tr>
            <tr>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">DALAM MAPEL</td>
                <td align="center">NILAI</td>
                <td align="center">NILAI</td>
                <td align="center">NILAI</td>
                <td align="center">NILAI</td>
                <td align="center">NILAI</td>                
            </tr>
            <tr>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">S/B/C/K</td>
                <td align="center">Rata-rata Raport</td>
                <td align="center">Ujian Sekolah</td>
                <td align="center">Sekolah</td>
                <td align="center">Ujian Nasional</td>
                <td align="center">Akhir (N/A)</td>                
            </tr>
            @php
                $totalrata = 0;
                $totalna = 0;
                $itemtotalrata = 0;
                $itemtotalna = 0;
                $idkelompok = '1';
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td style="width: 22px;" align="center">A</td>
                <td>{{ $kelompokmapel }}</td>
                <td style="width: 60px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
            </tr>
            @php
                
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                $no = 1;
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center">{{ $no++ }}</td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx);    
                        $totalrata = $totalrata + $rata;
                        $itemtotalrata = $itemtotalrata + 1;  
                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor

                    @php
                        //1 sd 8
                        $jmlnilai_1_8 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_1_8 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata_1_8 = ceil($jmlnilai/$jmlx);  

                        //21 sd 23
                        $jmlnilai_21_23 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_21_23 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->sum('hitung');
                        
                        $jmlnilai_na = $rata_1_8 + $jmlnilai_21_23;
                        $jmlx_na = $jmlx_21_23 + 1;

                        $rata_na = ceil($jmlnilai_na/$jmlx_na);
                        $totalna = $totalna + $rata_na; 
                        $itemtotalna = $itemtotalna + 1;

                    @endphp
                    
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach

            <tr>
                <td align="center">&nbsp;</td>
                <td></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
            </tr>
            
            @php
                $idkelompok = '2'; // kelompok kejuruan
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td style="width: 20px;" align="center">B</td>
                <td>{{ $kelompokmapel }}</td>
                <td style="width: 60px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
            </tr>
            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                $no = 1;
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center">{{ $no++ }}</td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx);    
                        $totalrata = $totalrata + $rata;
                        $itemtotalrata = $itemtotalrata + 1;
                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor

                    @php
                        //1 sd 8
                        $jmlnilai_1_8 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_1_8 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata_1_8 = ceil($jmlnilai/$jmlx);  

                        //21 sd 23
                        $jmlnilai_21_23 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_21_23 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->sum('hitung');
                        
                        $jmlnilai_na = $rata_1_8 + $jmlnilai_21_23;
                        $jmlx_na = $jmlx_21_23 + 1;

                        $rata_na = ceil($jmlnilai_na/$jmlx_na);
                        $totalna = $totalna + $rata_na;
                        $itemtotalna = $itemtotalna + 1;
                    @endphp
                    
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach

            @php
                $idkelompok = '3'; // kejuruan
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td style="width: 20px;" align="center">{{ $no++ }} </td>
                <td>{{ $kelompokmapel }}</td>
                <td style="width: 60px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
            </tr>
            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center"></td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx); 
                        $totalrata = $totalrata + $rata;   
                        $itemtotalrata = $itemtotalrata + 1;
                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor

                    @php
                        //1 sd 8
                        $jmlnilai_1_8 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_1_8 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata_1_8 = ceil($jmlnilai/$jmlx);  

                        //21 sd 23
                        $jmlnilai_21_23 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_21_23 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->sum('hitung');
                        
                        $jmlnilai_na = $rata_1_8 + $jmlnilai_21_23;
                        $jmlx_na = $jmlx_21_23 + 1;

                        $rata_na = ceil($jmlnilai_na/$jmlx_na);
                        $totalna = $totalna + $rata_na;
                        $itemtotalna = $itemtotalna + 1;
                        
                    @endphp
                    
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach
            
            @php
                $idkelompok = '4';
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            
            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center">{{ $no++ }}</td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx);    
                        $totalrata = $totalrata + $rata;
                        $itemtotalrata = $itemtotalrata + 1;
                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor

                    @php
                        //1 sd 8
                        $jmlnilai_1_8 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_1_8 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata_1_8 = ceil($jmlnilai/$jmlx);  

                        //21 sd 23
                        $jmlnilai_21_23 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_21_23 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->sum('hitung');
                        
                        $jmlnilai_na = $rata_1_8 + $jmlnilai_21_23;
                        $jmlx_na = $jmlx_21_23 + 1;

                        $rata_na = ceil($jmlnilai_na/$jmlx_na);
                        $totalna = $totalna + $rata_na;
                        $itemtotalna = $itemtotalna + 1;
                    @endphp
                    
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach

            @php
                $idkelompok = '5'; // mata pelajaran pilihan
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td style="width: 20px;" align="center">{{ $no++ }} </td>
                <td>{{ $kelompokmapel }}</td>
                <td style="width: 60px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
            </tr>
            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center"></td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx);    
                        $totalrata = $totalrata + $rata;
                        $itemtotalrata = $itemtotalrata + 1;
                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor

                    @php
                        //1 sd 8
                        $jmlnilai_1_8 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_1_8 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata_1_8 = ceil($jmlnilai/$jmlx);  

                        //21 sd 23
                        $jmlnilai_21_23 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_21_23 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->sum('hitung');
                        
                        $jmlnilai_na = $rata_1_8 + $jmlnilai_21_23;
                        $jmlx_na = $jmlx_21_23 + 1;

                        $rata_na = ceil($jmlnilai_na/$jmlx_na);
                        $totalna = $totalna + $rata_na;
                        $itemtotalna = $itemtotalna + 1;
                        
                    @endphp
                    
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach

            @php
                $idkelompok = '6'; // Muatan lokal
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td style="width: 20px;" align="center">{{ $no++ }} </td>
                <td>{{ $kelompokmapel }}</td>
                <td style="width: 60px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
            </tr>
            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center"></td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx);    
                        $totalrata = $totalrata + $rata;
                        $itemtotalrata = $itemtotalrata + 1;
                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor

                    @php
                        //1 sd 8
                        $jmlnilai_1_8 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_1_8 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata_1_8 = ceil($jmlnilai/$jmlx);  

                        //21 sd 23
                        $jmlnilai_21_23 = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx_21_23 = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','21')
                            ->where('smt','<=','23')
                            ->sum('hitung');
                        
                        $jmlnilai_na = $rata_1_8 + $jmlnilai_21_23;
                        $jmlx_na = $jmlx_21_23 + 1;

                        $rata_na = ceil($jmlnilai_na/$jmlx_na);
                        $totalna = $totalna + $rata_na;
                        $itemtotalna = $itemtotalna + 1;
                        
                    @endphp
                    
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach

            @php
                $idkelompok = '7'; // lain-lain
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td style="width: 20px;" align="center">{{ $no++ }} </td>
                <td>{{ $kelompokmapel }}</td>
                <td style="width: 60px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 80px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
                <td style="width: 90px;"></td>
            </tr>
            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center"></td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                    <td align="center"></td>
                </tr>
            @endforeach

            <tr>
                <td align="center">&nbsp;</td>
                <td></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
            </tr>

            @php
                $idkelompok = '8'; // jumlah nilai
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
            @endphp
            <tr>
                <td colspan="2">{{ $kelompokmapel }}</td>
                <td align="center"></td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $idmapel = Mapel::select('id')->where('idkelompokmapel','=','8');
                        $totnilaix = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','=',$i)
                        ->where('hitung','=','1')
                        ->sum('nilai');
                        
                        if($totnilaix=='0'){
                            $nilai = '';
                        }else{
                            $nilai = $totnilaix;
                        }
                        
                    @endphp
                    <td align="center">{{ $nilai }} </td>    
                        
                @endfor

                @php
                    $idmapel = Mapel::select('id')->where('idkelompokmapel','=','8');
                    $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','>=','1')
                        ->where('smt','<=','8')
                        ->where('hitung','=','1')
                        ->sum('nilai');
                    $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','>=','1')
                        ->where('smt','<=','8')
                        ->sum('hitung');
                    if($jmlx=='0'){
                        $rata = '';
                    }else{
                        $rata = ceil($jmlnilai/$jmlx);
                    }

                @endphp
                <td align="center">{{ $totalrata }}</td>
                 @for ($i = 21; $i <= 23; $i++)
                        @php
                            $idmapel = Mapel::select('id')->where('idkelompokmapel','=','8');
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->whereNotIn('idmapel',$idmapel)
                            ->where('smt','=',$i)
                            ->value('nilai');
                            
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                <td align="center">{{ $totalna }}</td>
            </tr>

            <tr>
                <td align="center"></td>
                <td>RATA-RATA</td>
                <td align="center"></td>

                 @for ($i = 1; $i <= 8; $i++)
                    @php
                        $idmapel = Mapel::select('id')->where('idkelompokmapel','=','8');
                        $totnilaix = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','=',$i)
                        ->where('hitung','=','1')
                        ->sum('nilai');
                                                
                        $jmlitemx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','=',$i)
                        ->where('hitung','=','1')
                        ->sum('hitung');

                        if($jmlitemx=='0'){
                            $rata2 = '';
                        }else{
                            $rata2 = ceil($totnilaix/$jmlitemx);
                        }
                        
                    @endphp
                    <td align="center">{{ $rata2 }} </td>    
                        
                @endfor
                @php
                    if($itemtotalrata=='0'){
                        $rata2total = '';
                    }else{
                        $rata2total = ceil($totalrata/$itemtotalrata);
                    }
                @endphp
                <td align="center">{{ $rata2total }}</td>
                 @for ($i = 21; $i <= 23; $i++)
                    @php
                        $idmapel = Mapel::select('id')->where('idkelompokmapel','=','8');
                        $totnilaix = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','=',$i)
                        ->where('hitung','=','1')
                        ->sum('nilai');
                                                
                        $jmlitemx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                        ->whereNotIn('idmapel',$idmapel)
                        ->where('smt','=',$i)
                        ->where('hitung','=','1')
                        ->sum('hitung');

                        if($jmlitemx=='0'){
                            $rata2 = '';
                        }else{
                            $rata2 = ceil($totnilaix/$jmlitemx);
                        }
                        
                    @endphp
                    <td align="center">{{ $rata2 }} </td>    
                        
                @endfor
                @php
                    if($itemtotalna=='0'){
                        $rata2totalna = '';
                    }else{
                        $rata2totalna = ceil($totalna/$itemtotalna);
                    }
                @endphp
                <td align="center">{{ $rata2totalna }} </td>
            </tr>

            @php
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
                
            @endphp

            @foreach ($mapel as $item)
                <tr>
                    <td align="center"></td>
                    <td>{{ $item->mapel }}</td>
                    <td align="center"></td>
                    
                    @for ($i = 1; $i <= 8; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    @php
                        $jmlnilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->where('hitung','=','1')
                            ->sum('nilai');
                        $jmlx = Nilai::select('hitung')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','>=','1')
                            ->where('smt','<=','8')
                            ->sum('hitung');
                        $rata = ceil($jmlnilai/$jmlx);    

                    @endphp
                    <td align="center">{{ $rata }}</td>

                    @for ($i = 21; $i <= 23; $i++)
                        @php
                            $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                            ->where('idmapel','=',$item->id)
                            ->where('smt','=',$i)
                            ->value('nilai');
                        @endphp
                        <td align="center">{{ $nilai }} </td>    
                    @endfor
                    <td align="center">{{ $rata_na }}</td>
                </tr>
            @endforeach

            <tr>
                <td align="center">&nbsp;</td>
                <td></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
            </tr>

            <tr>
                <td colspan="16">KEGIATAN di DUNIA USAHA / DUNIA INDUSTRI dan INSTANSI RELEVAN</td>
            </tr>


            <tr>
                <td align="center">NO</td>
                <td align="center" colspan="2">Nama Industri / Dunia Usaha</td>
                <td align="center" colspan="5">Lokasi</td>
                <td align="center" colspan="5">Jenis Kegiatan</td>
                <td align="center" colspan="3">Lama Pelaksanaan</td>
            </tr>
            @php
                $magang = Magang::where('iddatasiswa','=',$iddatasiswa)
                    ->with(['datasiswa','dudi'])
                    ->get();
                $no = 1;
            @endphp

            @foreach ($magang as $item)
                <tr>
                    <td align="center">{{ $no++ }}</td>
                    <td colspan="2">{{ $item->dudi->dudi }}</td>
                    <td colspan="5">{{ $item->dudi->alamat }}</td>
                    <td colspan="5">{{ $item->dudi->kegiatan }}</td>
                    <td  align="center" colspan="3">{{ $item->lama }}</td>
                </tr>
            @endforeach
            <tr>
                <td align="center">&nbsp;</td>
                <td colspan="2"></td>
                <td colspan="5"></td>
                <td colspan="5"></td>
                <td  align="center" colspan="3"></td>
            </tr>

            
        </table>
        

        <table width="100%" class="garis">

            @php
                $idkelompok = '9'; // EXTRA KURIKULER
                $kelompokmapel = Kelompokmapel::select('kelompokmapel')->where('id','=',$idkelompok)->value('kelompokmapel');
           
                $idmapel = Nilai::select('idmapel')->where('iddatasiswa','=',$iddatasiswa);
                $mapel = Mapel::whereIn('id',$idmapel)->where('idkelompokmapel','=',$idkelompok)
                    ->orderBy('urutan','asc')
                    ->get();
            @endphp

            <tr>
                <td width="15px" align="center" rowspan="3" style="font-size: 0.7em; line-height: 1.2;" class="vertical-text force-height"><span>EXTRA<br>KURIKULER</span></td>
                <td width="190px" style="line-height: 1.2;">1. {{ $mapel[0]->mapel ?? '' }}</td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->where('idmapel','=', $mapel[0]->id ?? 0 )
                        ->where('smt','=',$i)
                        ->value('nilai');
                    @endphp
                    <td width="125px" align="center">{{ $nilai }} </td>    
                @endfor
                <td width="160px" align="center"></td>
            </tr>
            
            <tr>
                <td>2. {{ $mapel[1]->mapel ?? '' }}</td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->where('idmapel','=', $mapel[1]->id ?? 0 )
                        ->where('smt','=',$i)
                        ->value('nilai');
                    @endphp
                    <td align="center">{{ $nilai }} </td>    
                @endfor
                <td align="center"></td>
            </tr>
            <tr>
                <td>3. {{ $mapel[2]->mapel ?? '' }}</td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $nilai = Nilai::select('nilai')->where('iddatasiswa','=',$iddatasiswa)
                        ->where('idmapel','=', $mapel[2]->id ?? 0 )
                        ->where('smt','=',$i)
                        ->value('nilai');
                    @endphp
                    <td align="center">{{ $nilai }} </td>    
                @endfor
                <td align="center"></td>
            </tr>

            <tr>
                <td align="center" rowspan="3" style="font-size: 0.7em; line-height: 1.2;" class="vertical-text force-height"><span>KETIDAK<br>HADIRAN</span></td>
                <td style="line-height: 1.2;">1. Sakit</td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $absenx = Absensi::select('sakit')->where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',$i)
                        ->value('sakit');
                        if($absenx==''){
                            $absen = '....  hari';
                        }else{
                            $absen = $absenx . '  hari';
                        }
                    @endphp
                    <td align="center">{{ $absen }}</td>    
                @endfor
                @php
                    $absenx = Absensi::select('sakit')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','>=',1)
                    ->where('smt','<=',8)
                    ->sum('sakit');
                    if($absenx==''){
                        $absen = '....  hari';
                    }else{
                        $absen = $absenx . '  hari';
                    }
                @endphp
                <td align="center">{{ $absen }}</td>
            </tr>
            
            <tr>
                <td>2. Izin</td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $absenx = Absensi::select('izin')->where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',$i)
                        ->value('izin');
                        if($absenx==''){
                            $absen = '....  hari';
                        }else{
                            $absen = $absenx . '  hari';
                        }
                    @endphp
                    <td align="center">{{ $absen }} </td>    
                @endfor
                @php
                    $absenx = Absensi::select('izin')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','>=',1)
                    ->where('smt','<=',8)
                    ->sum('izin');
                    if($absenx==''){
                        $absen = '....  hari';
                    }else{
                        $absen = $absenx . '  hari';
                    }
                @endphp
                <td align="center">{{ $absen }}</td>
            </tr>
            <tr>
                <td>3. Tanpa Keterangan</td>
                @for ($i = 1; $i <= 8; $i++)
                    @php
                        $absenx = Absensi::select('alpa')->where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',$i)
                        ->value('alpa');
                        if($absenx==''){
                            $absen = '....  hari';
                        }else{
                            $absen = $absenx . '  hari';
                        }
                    @endphp
                    <td align="center">{{ $absen }} </td>    
                @endfor
                @php
                    $absenx = Absensi::select('alpa')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','>=',1)
                    ->where('smt','<=',8)
                    ->sum('alpa');
                    if($absenx==''){
                        $absen = '....  hari';
                    }else{
                        $absen = $absenx . '  hari';
                    }
                @endphp
                <td align="center">{{ $absen }}</td>
            </tr>

            <tr>
                <td colspan="2">Status Akhir Tahun</td>
                 @php
                    $kelas = Absensi::select('kelas')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','=',2)
                    ->value('kelas');
                    $absenx = Absensi::where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',2)
                        ->get();
                    $kelas = $absenx[0]->kelas ?? ''; 
                    $status = $absenx[0]->status ?? ''; 
                    $tempatwali2 = $absenx[0]->tempatwali ?? '..........................................'; 
                    $namawali2 = $absenx[0]->namawali ?? '..........................................'; 
                    $nipwali2 = $absenx[0]->nipwali ?? '.................................'; 
                    $tempatks2 = $absenx[0]->tempatks ?? '..........................................'; 
                    $namaks2 = $absenx[0]->namaks ?? '..........................................'; 
                    $nipks2 = $absenx[0]->nipks ?? '.................................'; 

                    if($kelas==''){
                        $kelasa='......';
                    }else{
                        $kelasa=$kelas;
                    }
                    if($status=='T'){
                        $naikx = '<s>Naik ke</s>';
                        $tinggalx = 'Tinggal di';
                        $kelasx = $kelasa;
                    }else if($status=='Y'){
                        $naikx = 'Naik ke';
                        $tinggalx = '<s>Tinggal di</s>';
                        $kelasx = $kelasa;
                    }else{
                        $naikx = 'Naik ke';
                        $tinggalx = '<s>Tinggal di</s>';
                        $kelasx = '......';
                    }
                    
                @endphp
                <td class="table-tanpa-garis-kiri table-tanpa-garis-kanan table-tanpa-garis-atas table-tanpa-garis-bawah" colspan="2">
                    <table width="100%">
                        <tr>
                            <td width="50px"></td>
                            <td width="25px">{!! $naikx !!}</td>
                            <td width="85px">*) Kelas {{ $kelasx }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{!! $tinggalx !!}</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                @php
                    $kelas = Absensi::select('kelas')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','=',4)
                    ->value('kelas');
                    $absenx = Absensi::where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',4)
                        ->get();
                    $kelas = $absenx[0]->kelas ?? ''; 
                    $status = $absenx[0]->status ?? ''; 
                    $tempatwali4 = $absenx[0]->tempatwali ?? '..........................................'; 
                    $namawali4 = $absenx[0]->namawali ?? '..........................................'; 
                    $nipwali4 = $absenx[0]->nipwali ?? '.................................'; 
                    $tempatks4 = $absenx[0]->tempatks ?? '..........................................'; 
                    $namaks4 = $absenx[0]->namaks ?? '..........................................'; 
                    $nipks4 = $absenx[0]->nipks ?? '.................................'; 

                    if($kelas==''){
                        $kelasa='......';
                    }else{
                        $kelasa=$kelas;
                    }
                    if($status=='T'){
                        $naikx = '<s>Naik ke</s>';
                        $tinggalx = 'Tinggal di';
                        $kelasx = $kelasa;
                    }else if($status=='Y'){
                        $naikx = 'Naik ke';
                        $tinggalx = '<s>Tinggal di</s>';
                        $kelasx = $kelasa;
                    }else{
                        $naikx = 'Naik ke';
                        $tinggalx = 'Tinggal di';
                        $kelasx = '......';
                    }
                    
                @endphp
                <td class="table-tanpa-garis-kiri table-tanpa-garis-kanan table-tanpa-garis-atas table-tanpa-garis-bawah" colspan="2">
                    <table width="100%">
                        <tr>
                            <td width="50px"></td>
                            <td width="25px">{!! $naikx !!}</td>
                            <td width="85px">*) Kelas {{ $kelasx }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{!! $tinggalx !!}</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                @php
                    $kelas = Absensi::select('kelas')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','=',6)
                    ->value('kelas');
                    $absenx = Absensi::where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',6)
                        ->get();
                    $kelas = $absenx[0]->kelas ?? ''; 
                    $status = $absenx[0]->status ?? ''; 
                    $tempatwali6 = $absenx[0]->tempatwali ?? '..........................................'; 
                    $namawali6 = $absenx[0]->namawali ?? '..........................................'; 
                    $nipwali6 = $absenx[0]->nipwali ?? '.................................'; 
                    $tempatks6 = $absenx[0]->tempatks ?? '..........................................'; 
                    $namaks6 = $absenx[0]->namaks ?? '..........................................'; 
                    $nipks6 = $absenx[0]->nipks ?? '.................................';  

                    if($kelas==''){
                        $kelasa='......';
                    }else{
                        $kelasa=$kelas;
                    }
                    if($status=='T'){
                        $naikx = '<s>Naik ke</s>';
                        $tinggalx = 'Tinggal di';
                        $kelasx = $kelasa;
                    }else if($status=='Y'){
                        $naikx = 'Naik ke';
                        $tinggalx = '<s>Tinggal di</s>';
                        $kelasx = $kelasa;
                    }else{
                        $naikx = 'Naik ke';
                        $tinggalx = 'Tinggal di';
                        $kelasx = '......';
                    }
                    
                @endphp
                <td class="table-tanpa-garis-kiri table-tanpa-garis-kanan table-tanpa-garis-atas table-tanpa-garis-bawah" colspan="2">
                    <table width="100%">
                        <tr>
                            <td width="50px"></td>
                            <td width="25px">{!! $naikx !!}</td>
                            <td width="85px">*) Kelas {{ $kelasx }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{!! $tinggalx !!}</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                @php
                    $kelas = Absensi::select('kelas')->where('iddatasiswa','=',$iddatasiswa)
                    ->where('smt','=',8)
                    ->value('kelas');
                    $absenx = Absensi::where('iddatasiswa','=',$iddatasiswa)
                        ->where('smt','=',8)
                        ->get();
                    $kelas = $absenx[0]->kelas ?? ''; 
                    $status = $absenx[0]->status ?? ''; 
                    $tempatwali8 = $absenx[0]->tempatwali ?? '..........................................'; 
                    $namawali8 = $absenx[0]->namawali ?? '..........................................'; 
                    $nipwali8 = $absenx[0]->nipwali ?? '.................................'; 
                    $tempatks8 = $absenx[0]->tempatks ?? '..........................................'; 
                    $namaks8 = $absenx[0]->namaks ?? '..........................................'; 
                    $nipks8 = $absenx[0]->nipks ?? '.................................'; 

                    if($kelas==''){
                        $kelasa='......';
                    }else{
                        $kelasa=$kelas;
                    }
                    if($status=='T'){
                        $naikx = '<s>Naik ke</s>';
                        $tinggalx = 'Tinggal di';
                        $kelasx = $kelasa;
                    }else if($status=='Y'){
                        $naikx = 'Naik ke';
                        $tinggalx = '<s>Tinggal di</s>';
                        $kelasx = $kelasa;
                    }else{
                        $naikx = 'Naik ke';
                        $tinggalx = 'Tinggal di';
                        $kelasx = '......';
                    }
                    
                @endphp
                <td class="table-tanpa-garis-kiri table-tanpa-garis-kanan table-tanpa-garis-atas table-tanpa-garis-bawah" colspan="2">
                    <table width="100%">
                        <tr>
                            <td width="50px"></td>
                            <td width="25px">{!! $naikx !!}</td>
                            <td width="85px">*) Kelas {{ $kelasx }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>{!! $tinggalx !!}</td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                @php
                    $tglijasahlulus = Datasiswa::select('tglijasahlulus')->where('id','=',$iddatasiswa)
                        ->value('tglijasahlulus');
                    $tgllulus = \Carbon\Carbon::parse($tglijasahlulus)->locale('id')->isoFormat('DD MMMM YYYY') ?? '..................................... ';
                @endphp
                <td align="center">LULUS<br>TGL. {{ $tgllulus }}</td>
            </tr>

        </table>
        Keterangan : NP : Nilai Pengetauan; NK : Nilai Ketrampilan; NSSS : Nilai Sikap Spiritual dan Sosial.
        
        <table width="100%">
            <tr>
                <td align="center" width="300px">&nbsp;</td>
                <td align="center" width="250px"></td>
                <td align="center" width="250px"></td>
                <td align="center" width="250px"></td>
                <td align="center" width="200px"></td>
            </tr>

            
            <tr>
                <td align="center"></td>
                <td align="center">
                    {{ $tempatwali4 }}<br>Wali Kelas,<br><br><br><br><br>
                    {{ $namawali4 }}<br>
                    NIP. {{ $nipwali4 }}
                </td>
                <td align="center">
                    {{ $tempatwali6 }}<br>Wali Kelas,<br><br><br><br><br>
                    {{ $namawali6 }}<br>
                    NIP. {{ $nipwali6 }}
                </td>
                <td align="center">
                    {{ $tempatks6 }}<br>Kepala Sekolah,<br><br><br><br><br>
                    {{ $namaks6 }}<br>
                    NIP. {{ $nipks6 }}
                </td>
                <td align="center"></td>
            </tr>
        </table>




    </div>


    
</body>
</html>