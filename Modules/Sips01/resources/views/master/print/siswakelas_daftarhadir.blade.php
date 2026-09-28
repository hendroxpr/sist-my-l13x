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
            font-size: 0.7em; 
            line-height: 1.2; 
        }




    </style>

</head>
<body>
    @php   
        $smk = strtoupper(session('memnamasingkat'));
    @endphp

    <div class="row">
        <p align="center">
            DAFTAR HADIR SISWA
            <br>
            {{ $smk }}
            <br>
            Kompetensi Keahlian : {{ $siswakelas[0]->kelas->kompetensi->kompetensi }}
        </p>
    </div>
    
    <div class="row">
        <table>
            <tr>
                <td>KELAS</td>
                <td>:</td>
                <td>{{ $siswakelas[0]->kelas->kelas }}</td>
            </tr>
            <tr>
                <td>HARI / TANGGAL</td>
                <td>:</td>
                <td></td>
            </tr>
        </table>

        <table width="100%" class="garis">
        
            <tr>
                <td rowspan="2" align="center" width="25px">NO</td>
                <td rowspan="2" align="center" width="80px">NISN</td>
                <td rowspan="2" align="center" width="100px">NIS</td>
                <td rowspan="2" align="center" width="250px">NAMA</td>
                <td colspan="11" align="center">KODE GURU</td>
                <td rowspan="2" align="center" width="40px">KET.</td>
            </tr>
            <tr>            
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                <td width="17px"> &nbsp; </td>
                
            </tr>
            @php
            $no = 1;    
            @endphp
            
            @foreach ($siswakelas as $item)
            <tr>
                <td align="center">{{ $no++ }}</td>
                <td align="center">{{ $item->datasiswa->nisn }}</td>
                <td align="center">{{ $item->datasiswa->nis }}</td>
                <td style="padding-left: 3">{{ $item->datasiswa->namalengkap }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        @endforeach
        </table>
        <center style="margin-top: 10; margin-bottom: 10">
            JURNAL KELAS
        </center>
        <table width="100%" class="garis">
            <tr>
                <td align="center" width="25px">JAM</td>
                <td align="center" width="80px">MAPEL</td>
                <td align="center" width="100px">NAMA GURU</td>
                <td align="center" width="420px">MATERI</td>
                <td align="center" width="91px">TANDA TANGAN</td>
            </tr>
        @php
            $datax = array(1,2,3,4,5,6,7,8,9,10,11);         
        @endphp 
        
        @foreach ($datax as $item)
        <tr>
            <td align="center">{{ $item }}</td>
            <td></td>
            <td></td>
            <td></td>
            @php
                $x = fmod($item,2);
            @endphp
            @if ($x==0)
                <td align="center">{{ $item }}</td>
            @else
                <td align="left">{{ $item }}</td>  
            @endif
        </tr>
        @endforeach
        </table>
    
        <table width="100%" style="margin-top: 10; margin-bottom: 10">
            <tr>
                <td width="60%"></td>
                <td width="40%" align="center">Wali Kelas {{ $siswakelas[0]->kelas->kelas }}<br><br><br><br></td>
            </tr>
            <tr>
                <td></td>
                @if(!$walikelas->isEmpty())
                <td align="center"><b><u>{{ $walikelas[0]->dataguru->nama }}<br></u></b>
                    NIP. {{ $walikelas[0]->dataguru->nip }}
                </td>
                @else
                <td align="center"><b><u>.....................................<br></u></b>
                    NIP. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                </td>
                @endif
            </tr>
        </table>




    </div>


    
</body>
</html>