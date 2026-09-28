<?php

namespace Modules\Sips01\Imports; 
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Modules\Sips01\Models\Agama;
use Modules\Sips01\Models\Desa;
use Modules\Sips01\Models\Gd;
use Modules\Sips01\Models\Kabupaten;
use Modules\Sips01\Models\Kecamatan;
use Modules\Sips01\Models\Memdatasiswa;
use Modules\Sips01\Models\Pendidikan;
use Modules\Sips01\Models\Statusanak;
use Modules\Sips01\Models\Tinggal;
use Modules\Sips01\Models\Tingkat;

class MemdatasiswaImport implements ToModel, WithStartRow
{
    
    public function startRow(): int
    {
        return 4;
    }

    // Tentukan berapa baris yang diproses per chunk
    public function model(array $row)
    {
        //ecard
        $pjr0 = strlen(trim($row[0]));
        $pjr1 = strlen(trim($row[1]));
        $pjr2 = strlen(trim($row[2]));
        if($pjr0=='0'){
            $r0 = 'ECARD-' . random_int(100000000, 999999999);
        }else{
            $r0 = trim($row[0]);
        }
        if($pjr1=='0'){
            $r1 = 'NISN-' . random_int(100000000, 999999999);
        }else{
            $r1 = trim($row[1]);
        }
        if($pjr2=='0'){
            $r2 = 'NIS-' . random_int(100000000, 999999999);
        }else{
            $r2 = trim($row[2]);
        }

        //idtempatlahir
        $tempatlahir = Str::slug($row[6]);
        if(strlen($row[6])=='0'){
            $idtempatlahir1 = '249'; //bojonegoro
        }else{
            if($tempatlahir){
                $jmltempatlahir = Kabupaten::select('id')->where('slug','=',$tempatlahir)->count();
                if($jmltempatlahir=='0'){
                    $idtempatlahir1 = '249'; //bojonegoro    
                }else{
                    $idtempatlahir1 = Kabupaten::select('id')->where('slug','=',$tempatlahir)->value('id');
                } 
            }else{
                $idtempatlahir1 = '249'; //bojonegoro
            }
        }
        //idjk
        $jk = strtoupper(substr(trim($row[5]),0,1));
        if(strlen($row[5])=='0'){
            $idjk1 = '1'; //L=laki-laki
        }else{
            if($jk=='L'){
                $idjk1 = '1'; //L=laki-laki 
            }else{
                $idjk1 = '2';
            }
        }
        //idagama
        if(strlen($row[8])=='0'){
            $idagama1 = '1';
        }else{
            $jmlagama = Agama::select('id')->where('agama','like','%'. $row[8] . '%')->count();
            if($jmlagama=='0'){
                $idagama1 = '1';    
            }else{
                $idagama1 = Agama::select('id')->where('agama','like','%'. $row[8] . '%')->value('id');
            } 
        }
        //anakke
        $r10 = $row[10]; 
        if (!is_numeric($r10)) {
            $r10 = (int)$r10;
        } else {
            $r10 = $row[10];
        }
        //jmlsdrkandung
        $r11 = $row[11]; 
        if (!is_numeric($r11)) {
            $r11 = (int)$r11;
        } else {
            $r11 = $row[11];
        }
        //jmlsdrtiri
        $r12 = $row[12]; 
        if (!is_numeric($r12)) {
            $r12 = (int)$r12;
        } else {
            $r12 = $row[12];
        }
        //jmlsdrangkat
        $r13 = $row[13]; 
        if (!is_numeric($r13)) {
            $r13 = (int)$r13;
        } else {
            $r13 = $row[13];
        }
        //idstatusanak
        if(strlen($row[14])=='0'){
            $idstatusanak1 = '1';
        }else{
            $jml = Statusanak::select('id')->where('statusanak','=',$row[14])->count();
            if($jml=='0'){
                $idstatusanak1 = '1';    
            }else{
                $idstatusanak1 = Statusanak::select('id')->where('statusanak','=',$row[14])->value('id');
            } 
        }
        //iddesa
        if(strlen($row[16])=='0'){
            $iddesa1 = '47731'; //ds.pojok
        }else{
            $exp_alamat = explode(",", $row[16]);
            $desax = $exp_alamat[0]; 
            $rtx = $exp_alamat[1]; 
            $kecx = $exp_alamat[2];
            $jmltitik_desax = substr_count($desax, "."); //hitung jml titik 
            if($jmltitik_desax=='2'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[2]);
            }else if ($jmltitik_desax=='1'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[1]);
            }else{
                $desa = trim($desax);
            }
            $jmltitik_kecx = substr_count($kecx, ".");
            if($jmltitik_kecx=='1'){
                $exp_kecx = explode(".", $kecx);
                $kec = trim($exp_kecx[1]);
            }else{
                $kec = trim($kecx);
            }
            $jmlkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->count();
            if($jmlkec=='0'){
                $idkec = '3732'; //kec. purwosari
            }else{
                $idkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->value('id');
            }
            $jmldesa = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->count();
            if($jmldesa=='0'){
                $iddesa1 = '47731'; //kec. purwosari
            }else{
                $iddesa1 = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->value('id');
            }
        }            
        //idtinggal
        if(strlen($row[18])=='0'){
            $idtinggal1 = '1';
        }else{
            $jmltinggal = Tinggal::select('id')->where('tinggal','=',$row[18])->count();
            if($jmltinggal=='0'){
                $idtinggal1 = '1';    
            }else{
                $idtinggal1 = Tinggal::select('id')->where('tinggal','=',$row[18])->value('id');
            } 
        }
        //jarakkesekolah
        $r19 = $row[19]; 
        if (!is_numeric($r19)) {
            $r19 = (int)$r19;
        } else {
            $r19 = $row[19];
        }
        //idgd
        if(strlen($row[20])=='0'){
            $idgd1 = '1';
        }else{
            $jmlgd = Gd::select('id')->where('gd','=',$row[20])->count();
            if($jmlgd=='0'){
                $idgd1 = '1';    
            }else{
                $idgd1 = Gd::select('id')->where('gd','=',$row[20])->value('id');
            } 
        }
        //tinggibadan
        $r23 = $row[23]; 
        if (!is_numeric($r23)) {
            $r23 = (int)$r23;
        } else {
            $r23 = $row[23];
        }
        //beratbadan
        $r24 = $row[24]; 
        if (!is_numeric($r24)) {
            $r24 = (int)$r24;
        } else {
            $r24 = $row[24];
        }
        //lamabelajar
        $r28 = trim(substr($row[28],0,2)); 
        if (!is_numeric($r28)) {
            $r28 = (int)$r28;
        } else {
            $r28 = trim(substr($row[28],0,2));
        }
        //idtempatlahirayah
        $tempatlahirayah = Str::slug($row[36]);
        if(strlen($row[36])=='0'){
            $idtempatlahirayah1 = '249'; //bojonegoro
        }else{
            if($tempatlahirayah){
                $jmltempatlahirayah = Kabupaten::select('id')->where('slug','=',$tempatlahirayah)->count();
                if($jmltempatlahirayah=='0'){
                    $idtempatlahirayah1 = '249'; //bojonegoro    
                }else{
                    $idtempatlahirayah1 = Kabupaten::select('id')->where('slug','=',$tempatlahirayah)->value('id');
                } 
            }else{
                $idtempatlahirayah1 = '249'; //bojonegoro
            }
        }
        //tgllahirayah
        if(strlen($row[38])=='10'){
            $tgllahirayah1 = $row[38];
        }else{
            $r38 = $row[38];
            if (!is_numeric($r38)) {
                $tgllahirayah1 = (int)$r38 . '-01-01';
            } else {
                $tgllahirayah1 = $row[38] . '-01-01';
            }
        }
        //idagamaayah
        if(strlen($row[39])=='0'){
            $idagamaayah1 = '1';
        }else{
            $jmlagamaayah = Agama::select('id')->where('agama','like','%'. $row[39] . '%')->count();
            if($jmlagamaayah=='0'){
                $idagamaayah1 = '1';    
            }else{
                $idagamaayah1 = Agama::select('id')->where('agama','like','%'. $row[39] . '%')->value('id');
            } 
        }
        //idpendidikanayah
        if(strlen($row[41])=='0'){
            $idpendidikanayah1 = '1';
        }else{
            $exp_pendidikanayah = explode("/", $row[41]);
            $pendidikanayahx = strtoupper(trim($exp_pendidikanayah[0]));
            if($pendidikanayahx=='SD'||$pendidikanayahx=='MI'){
                $idpendidikanayah1 = '1';
            }else if($pendidikanayahx=='SMP'||$pendidikanayahx=='MTS'){
                $idpendidikanayah1 = '2';
            }else if($pendidikanayahx=='SMA'||$pendidikanayahx=='SMU'){
                $idpendidikanayah1 = '3';
            }else{
                $jmlpendidikan = Pendidikan::select('id')->where('pendidikan', 'like', '%' . $pendidikanayahx . '%')->count();
                if($jmlpendidikan=='0'){
                    $idpendidikanayah1 = '1';
                }else{
                    $idpendidikanayah1 = Pendidikan::select('id')->where('pendidikan', 'like', '%' . $pendidikanayahx . '%')->value('id');
                }
            }
        }
        //pengeluaranayah
        $r43 = $row[43]; 
        if (!is_numeric($r43)) {
            $r43 = (int)$r43;
        } else {
            $r43 = $row[43];
        }
        //iddesaayah1
        if(strlen($row[54])=='0'){
            $iddesaayah1 = '47731'; //ds.pojok
        }else{
            $exp_alamat = explode(",", $row[44]);
            $desax = $exp_alamat[0]; 
            $rtx = $exp_alamat[1]; 
            $kecx = $exp_alamat[2];
            $jmltitik_desax = substr_count($desax, "."); //hitung jml titik 
            if($jmltitik_desax=='2'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[2]);
            }else if ($jmltitik_desax=='1'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[1]);
            }else{
                $desa = trim($desax);
            }
            $jmltitik_kecx = substr_count($kecx, ".");
            if($jmltitik_kecx=='1'){
                $exp_kecx = explode(".", $kecx);
                $kec = trim($exp_kecx[1]);
            }else{
                $kec = trim($kecx);
            }
            $jmlkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->count();
            if($jmlkec=='0'){
                $idkec = '3732'; //kec. purwosari
            }else{
                $idkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->value('id');
            }
            $jmldesa = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->count();
            if($jmldesa=='0'){
                $iddesaayah1 = '47731'; //kec. purwosari
            }else{
                $iddesaayah1 = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->value('id');
            }
        }
        //hidupayah
        $r45 = trim(strtolower($row[45])); 
        if ($r45=='masih hidup') {
            $r45 = 'Y';
        } else {
            $r45 = 'N';
        }
        //idtempatlahiribu
        $tempatlahiribu = Str::slug($row[47]);
        if(strlen($row[47])=='0'){
            $idtempatlahiribu1 = '249'; //bojonegoro
        }else{
            if($tempatlahiribu){
                $jmltempatlahiribu = Kabupaten::select('id')->where('slug','=',$tempatlahiribu)->count();
                if($jmltempatlahiribu=='0'){
                    $idtempatlahiribu1 = '249'; //bojonegoro    
                }else{
                    $idtempatlahiribu1 = Kabupaten::select('id')->where('slug','=',$tempatlahiribu)->value('id');
                } 
            }else{
                $idtempatlahiribu1 = '249'; //bojonegoro
            }
        }
        //tgllahiribu
        if(strlen($row[48])=='10'){
            $tgllahiribu1 = $row[48];
        }else{
            $r48 = $row[48];
            if (!is_numeric($r48)) {
                $tgllahiribu1 = (int)$r48 . '-01-01';
            } else {
                $tgllahiribu1 = $row[48] . '-01-01';
            }
        }
        //idagamaibu
        if(strlen($row[49])=='0'){
            $idagamaibu1 = '1';
        }else{
            $jmlagamaibu = Agama::select('id')->where('agama','like','%'. $row[49] . '%')->count();
            if($jmlagamaibu=='0'){
                $idagamaibu1 = '1';    
            }else{
                $idagamaibu1 = Agama::select('id')->where('agama','like','%'. $row[49] . '%')->value('id');
            } 
        }
        //idpendidikanibu
        if(strlen($row[51])=='0'){
            $idpendidikanibu1 = '1';
        }else{
            $exp_pendidikanibu = explode("/", $row[51]);
            $pendidikanibux = strtoupper(trim($exp_pendidikanibu[0]));
            if($pendidikanibux=='SD'||$pendidikanibux=='MI'){
                $idpendidikanibu1 = '1';
            }else if($pendidikanibux=='SMP'||$pendidikanibux=='MTS'){
                $idpendidikanibu1 = '2';
            }else if($pendidikanibux=='SMA'||$pendidikanibux=='SMU'){
                $idpendidikanibu1 = '3';
            }else{
                $jmlpendidikan = Pendidikan::select('id')->where('pendidikan', 'like', '%' . $pendidikanibux . '%')->count();
                if($jmlpendidikan=='0'){
                    $idpendidikanibu1 = '1';
                }else{
                    $idpendidikanibu1 = Pendidikan::select('id')->where('pendidikan', 'like', '%' . $pendidikanibux . '%')->value('id');
                }
            }
        }
        //pengeluaranibu
        $r53 = $row[53]; 
        if (!is_numeric($r53)) {
            $r53 = (int)$r53;
        } else {
            $r53 = $row[53];
        }
        //iddesaibu1
        if(strlen($row[54])=='0'){
            $iddesaibu1 = '47731'; //ds.pojok
        }else{
            $exp_alamat = explode(",", $row[54]);
            $desax = $exp_alamat[0]; 
            $rtx = $exp_alamat[1]; 
            $kecx = $exp_alamat[2];
            $jmltitik_desax = substr_count($desax, "."); //hitung jml titik 
            if($jmltitik_desax=='2'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[2]);
            }else if ($jmltitik_desax=='1'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[1]);
            }else{
                $desa = trim($desax);
            }
            $jmltitik_kecx = substr_count($kecx, ".");
            if($jmltitik_kecx=='1'){
                $exp_kecx = explode(".", $kecx);
                $kec = trim($exp_kecx[1]);
            }else{
                $kec = trim($kecx);
            }
            $jmlkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->count();
            if($jmlkec=='0'){
                $idkec = '3732'; //kec. purwosari
            }else{
                $idkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->value('id');
            }
            $jmldesa = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->count();
            if($jmldesa=='0'){
                $iddesaibu1 = '47731'; //kec. purwosari
            }else{
                $iddesaibu1 = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->value('id');
            }
        }
        //hidupibu
        $r55 = trim(strtolower($row[55])); 
        if ($r55=='masih hidup') {
            $r55 = 'Y';
        } else {
            $r55 = 'N';
        }
        //idtempatlahirwali
        $tempatlahirwali = Str::slug($row[57]);
        if(strlen($row[57])=='0'){
            $idtempatlahirwali1 = '249'; //bojonegoro
        }else{
            if($tempatlahirwali){
                $jmltempatlahirwali = Kabupaten::select('id')->where('slug','=',$tempatlahirwali)->count();
                if($jmltempatlahirwali=='0'){
                    $idtempatlahirwali1 = '249'; //bojonegoro    
                }else{
                    $idtempatlahirwali1 = Kabupaten::select('id')->where('slug','=',$tempatlahirwali)->value('id');
                } 
            }else{
                $idtempatlahirwali1 = '249'; //bojonegoro
            }
        }
        //tgllahirwali
        if(strlen($row[58])=='10'){
            $tgllahirwali1 = $row[58];
        }else{
            $r58 = $row[58];
            if (!is_numeric($r58)) {
                $tgllahirwali1 = (int)$r58 . '-01-01';
            } else {
                $tgllahirwali1 = $row[58] . '-01-01';
            }
        }
        //idagamawali
        if(strlen($row[59])=='0'){
            $idagamawali1 = '1';
        }else{
            $jmlagamawali = Agama::select('id')->where('agama','like','%'. $row[59] . '%')->count();
            if($jmlagamawali=='0'){
                $idagamawali1 = '1';    
            }else{
                $idagamawali1 = Agama::select('id')->where('agama','like','%'. $row[59] . '%')->value('id');
            } 
        }
        //idpendidikanwali
        if(strlen($row[61])=='0'){
            $idpendidikanwali1 = '1';
        }else{
            $exp_pendidikanwali = explode("/", $row[61]);
            $pendidikanwalix = strtoupper(trim($exp_pendidikanwali[0]));
            if($pendidikanwalix=='SD'||$pendidikanwalix=='MI'){
                $idpendidikanwali1 = '1';
            }else if($pendidikanwalix=='SMP'||$pendidikanwalix=='MTS'){
                $idpendidikanwali1 = '2';
            }else if($pendidikanwalix=='SMA'||$pendidikanwalix=='SMU'){
                $idpendidikanwali1 = '3';
            }else{
                $jmlpendidikan = Pendidikan::select('id')->where('pendidikan', 'like', '%' . $pendidikanwalix . '%')->count();
                if($jmlpendidikan=='0'){
                    $idpendidikanwali1 = '1';
                }else{
                    $idpendidikanwali1 = Pendidikan::select('id')->where('pendidikan', 'like', '%' . $pendidikanwalix . '%')->value('id');
                }
            }
        }
        //pengeluaranwali
        $r63 = $row[63]; 
        if (!is_numeric($r63)) {
            $r63 = (int)$r63;
        } else {
            $r63 = $row[63];
        }
        //iddesawali1
        if(strlen($row[64])=='0'){
            $iddesawali1 = '47731'; //ds.pojok
        }else{
            $exp_alamat = explode(",", $row[64]);
            $desax = $exp_alamat[0]; 
            $rtx = $exp_alamat[1]; 
            $kecx = $exp_alamat[2];
            $jmltitik_desax = substr_count($desax, "."); //hitung jml titik 
            if($jmltitik_desax=='2'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[2]);
            }else if ($jmltitik_desax=='1'){
                $exp_desax = explode(".", $desax);
                $desa = trim($exp_desax[1]);
            }else{
                $desa = trim($desax);
            }
            $jmltitik_kecx = substr_count($kecx, ".");
            if($jmltitik_kecx=='1'){
                $exp_kecx = explode(".", $kecx);
                $kec = trim($exp_kecx[1]);
            }else{
                $kec = trim($kecx);
            }
            $jmlkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->count();
            if($jmlkec=='0'){
                $idkec = '3732'; //kec. purwosari
            }else{
                $idkec = Kecamatan::select('id')->where('kecamatan','=',$kec)->value('id');
            }
            $jmldesa = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->count();
            if($jmldesa=='0'){
                $iddesawali1 = '47731'; //kec. purwosari
            }else{
                $iddesawali1 = Desa::select('id')->where('desa','=',$desa)->where('idkecamatan','=',$idkec)->value('id');
            }
        }

        return new Memdatasiswa ([
                        
            // 'idtpmasuk' => $request['idtpmasuk1'], langsung dari blade
            //identitas1
            'namalengkap' => $row[3],
            'ecard' => $r0,
            'nis' => $r2,
            'nisn' => $r1,
            // 'tglditerima' => $request['tglditerima1'], langsung dari blade
            'idstatussiswa' => '1',
            // 'idkompetensi' => $request['idkompetensi1'], langsung dari blade
            //datadiri1
            'namapanggilan' => $row[4],
            'idtempatlahir' => $idtempatlahir1,
            'tempatlahirx' => $row[6],
            'tgllahir' => $row[7],
            'tgllahirx' => $row[7],
            'idjk' => $idjk1,
            'jkx' => $row[5],
            'idagama' => $idagama1,
            'agamax' => $row[8],
            'warganegara' => $row[9],
            'bahasa' => $row[15],
            'idstatusanak' => $idstatusanak1,
            'statusanakx' => $row[14],
            'anakke' => $r10,
            'jmlsdrkandung' => $r11,
            'jmlsdrtiri' => $r12,
            'jmlsdrangkat' => $r13,
            //tempattinggal1
            'alamat' => $row[16],
            'iddesa' => $iddesa1,
            'telp' => $row[17],
            // 'email' => $request['email1'],
            'jarakkesekolah' => $r19,
            'idtinggal' => $idtinggal1,
            'tinggalx' => $row[18],
            //kesehatan1
            'penyakit' => $row[21],
            'kelainan' => $row[22],
            'idgd' => $idgd1,
            'gdx' => $row[20],
            'tinggibadan' => $r23,
            'beratbadan' => $r24,     
                   
            //pendidikan1
            'asalsekolah' => $row[25],
            // 'tglsttb' => $request['tglsttb1'],
            // 'tglsttbx' => $request['tglsttb1'],
            // 'nomorsttb' => $request['nomorsttb1'],
            'nomorsttbx' => $row[26],
            // 'tglskhun' => $request['tglskhun1'],
            // 'tglskhunx' => $request['tglskhun1'],
            // 'nomorskhun' => $request['nomorskhun1'],
            'nomorskhunx' => $row[27],
            'lamabelajar' => $r28,
            // 'pindah' => $request['pindah1'],
            'sekolahpindah' => $row[29],
            'alasanpindah' => $row[30],
            //ayahkandung1
            'namaayah' => $row[36],
            'idtempatlahirayah' => $idtempatlahirayah1,
            'tempatlahirayahx' => $row[37],
            'tgllahirayah' => $tgllahirayah1,
            'tgllahirayahx' => $row[38],
            // 'umurayah' => $request['umurayah1'],
            'idagamaayah' => $idagamaayah1,
            'agamaayahx' => $row[39],
            'idpendidikanayah' => $idpendidikanayah1,
            'pendidikanayahx' => $row[41],
            'warganegaraayah' => $row[40],
            'pekerjaanayah' => $row[42],
            // 'penghasilanayah' => $request['penghasilanayah1'],
            'pengeluaranayah' => $r43,
            'hidupayah' => $r45,
            // 'tglmeninggalayah' => $request['tglmeninggalayah1'],
            'alamatayah' => $row[44],
            'iddesaayah' => $iddesaayah1,
            // 'telpayah' => $request['telpayah1'],     
            //ibu 
            'namaibu' => $row[46],
            'idtempatlahiribu' => $idtempatlahiribu1,
            'tempatlahiribux' => $row[47],
            'tgllahiribu' => $tgllahiribu1,
            'tgllahiribux' => $row[48],
            // 'umuribu' => $request['umuribu1'],
            'idagamaibu' => $idagamaibu1,
            'agamaibux' => $row[49],
            'idpendidikanibu' => $idpendidikanibu1,
            'pendidikanibux' => $row[51],
            'warganegaraibu' => $row[50],
            'pekerjaanibu' => $row[52],
            // 'penghasilanibu' => $request['penghasilanibu1'],
            'pengeluaranibu' => $r53,
            'hidupibu' => $r55,
            // 'tglmeninggalibu' => $request['tglmeninggalibu1'],
            'alamatibu' => $row[54],
            'iddesaibu' => $iddesaibu1,
            // 'telpibu' => $request['telpibu1'],
            //wali
            'namawali' => $row[56],
            'idtempatlahirwali' => $idtempatlahirwali1,
            'tempatlahirwalix' => $row[56],
            'tgllahirwali' => $tgllahirwali1,
            'tgllahirwalix' => $row[58],
            // 'umurwali' => $request['umurwali1'],
            'idagamawali' => $idagamawali1,
            'agamawalix' => $row[59],
            'idpendidikanwali' => $idpendidikanwali1,
            'pendidikanwalix' => $row[61],
            'warganegarawali' => $row[60],
            'pekerjaanwali' => $row[62],
            // 'penghasilanwali' => $request['penghasilanwali1'],
            'pengeluaranwali' => $r63,
            // 'hidupwali' => $request['hidupwali1'],
            // 'tglmeninggalwali' => $request['tglmeninggalwali1'],
            'alamatwali' => $row[64],
            'iddesawali' => $iddesawali1,
            // 'telpwali' => $request['telpwali1'],
            //hobi1
            'hobikesenian' => $row[65],
            'hobiolahraga' => $row[66],
            'hobiorganisasi' => $row[67],
            'hobilain' => $row[68],        
            // //perkembangan1
            // 'idtpkeluar' => $request['idtpkeluar1'],
            // 'tglkeluar' => $request['tglkeluar1'],
            // 'idalasankeluar' => $request['idalasankeluar1'],
            // 'nomorijasahlulus' => $request['nomorijasahlulus1'],
            // 'tglijasahlulus' => $request['tglijasahlulus1'],
            // 'nomorskhunlulus' => $request['nomorskhunlulus1'],
            // 'tglskhunlulus' => $request['tglskhunlulus1'],
            // 'keteranganlulus' => $request['keteranganlulus1'],
            // 'aktif' => $request['aktif1'],
            // //selesai1
            // 'idalasansetelahkeluar' => $request['idalasansetelahkeluar1'],
            // 'sekolahlanjut' => $request['sekolahlanjut1'],
            // 'jurusanlanjut' => $request['jurusanlanjut1'],
            // 'kerjadi' => $request['kerjadi1'],
            // 'tglmulaikerja' => $request['tglmulaikerja1'],
            // 'namaperusahaan' => $request['namaperusahaan1'],
            // 'penghasilankerja' => $request['penghasilankerja1'],
            // //images
            // 'fotoktp' => $fotoktp1,
            // 'fotoawal' => $fotoawal1,
            // 'fotoakhir' => $fotoakhir1,

        ]);
    }
    // public function batchSize(): int
    // {
    //     return 1000;
    // }
    
}