<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Number;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Sips01\Imports\MemdatasiswaImport;
use Modules\Sips01\Models\Agama;
use Modules\Sips01\Models\Alasankeluar;
use Modules\Sips01\Models\Alasansetelahkeluar;
use Modules\Sips01\Models\Beasiswa;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Desa;
use Modules\Sips01\Models\Gd;
use Modules\Sips01\Models\Jk;
use Modules\Sips01\Models\Kabupaten;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Kompetensi;
use Modules\Sips01\Models\Memdatasiswa;
use Modules\Sips01\Models\Pendidikan;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Statusanak;
use Modules\Sips01\Models\Statussiswa;
use Modules\Sips01\Models\Tinggal;
use Modules\Sips01\Models\Tp;
use Yajra\DataTables\Facades\DataTables;

class DatasiswaController extends Controller
{
    /**
     */
    public function index()
    {

        // $product = new Product;
        // $product->setConnection('mysql_second');
        // $something = $product->find(1);
        // return $something;

        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Data Siswa</b>.';
        $page = 'sips01::master.datasiswa';
        $link = '/sips01/master/datasiswa';
        $subtitle = 'Master';
        $caption = 'Data Siswa';
        $jmlhal = 2;

        $menu=Menusub::where('link','=',$link)
            ->with(['menuutama','aplikasi'])
            ->get();
        return view($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Datasiswa::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }
 
    public function importdata(Request $request){
        
        if ($request->hasFile('file1x')) {
             $validateFile = $request->validate([
                'file1x' => 'required|mimes:xlsx,xls,csv|max:2048', // Sesuai dengan formData.append('file1x', file1x)
                'idtpmasukx1'    => 'required',
                'tglditerimax1'  => 'required',
                'idkompetensi1x' => 'required',
            ]);
            
            if($validateFile){
                try{
                    $params = [
                        'idtpmasuk'   => $request['idtpmasukx1'],
                        'tglditerima'  => $request['tglditerimax1'],
                        'idkompetensi' => $request['idkompetensi1x'],
                    ];
                    //lokasi excel sementara
                    $filex = $request->file('file1x')->store('Sips01-datasiswa-excel');
                    //import data excel dan simpan datanya ke model MemDatasiswa.php  
                    Excel::import(new MemdatasiswaImport, $filex);
                    //delete excel
                    Storage::delete($filex);
                    //update memdatasiswa
                    Memdatasiswa::where('id','<>','0')->update($params);

                    $totalrecord = Memdatasiswa::select('id')->count();
                    $jr = 0;
                    //buka Memdatasiswa
                    $tampil = Memdatasiswa::get();
                    foreach ($tampil as $item) {
                        $nis = $item->nis;            
                        $nisn = $item->nisn;            
                        $ecard = $item->ecard;
                        $jr = $jr + 1; 
                        
                        $data = [
                            'idtpmasuk' => $item->idtpmasuk,
                            //identitas1
                            'namalengkap' => $item->namalengkap,
                            'ecard' => $item->ecard,
                            'nis' => $item->nis,
                            'nisn' => $item->nisn,
                            'tglditerima' => $item->tglditerima,
                            'idstatussiswa' => '1',
                            'idkompetensi' => $item->idkompetensi,
                            //datadiri1
                            'namapanggilan' => $item->namapanggilan,
                            'idtempatlahir' => $item->idtempatlahir,
                            'tgllahir' => $item->tgllahir,
                            'idjk' => $item->idjk,
                            'idagama' => $item->idagama,
                            'warganegara' => $item->warganegara,
                            'bahasa' => $item->bahasa,
                            'idstatusanak' => $item->idstatusanak,
                            'anakke' => $item->anakke,
                            'jmlsdrkandung' => $item->jmlsdrkandung,
                            'jmlsdrtiri' => $item->jmlsdrtiri,
                            'jmlsdrangkat' => $item->jmlsdrangkat,
                            //tempattinggal1
                            'alamat' => $item->alamat,
                            'iddesa' => $item->iddesa,
                            'telp' => $item->telp,
                            // 'email' => $request['email1'],
                            'jarakkesekolah' => $item->jarakkesekolah,
                            'idtinggal' => $item->idtinggal,
                            //kesehatan1
                            'penyakit' => $item->penyakit,
                            'kelainan' => $item->kelainan,
                            'idgd' => $item->idgd,
                            'tinggibadan' => $item->tinggibadan,
                            'beratbadan' => $item->beratbadan,     
                            //pendidikan1
                            'asalsekolah' => $item->asalsekolah,
                            'tglsttb' => $item->tglsttb,
                            'nomorsttb' => $item->nomorsttb,
                            'tglskhun' => $item->tglskhun,
                            'nomorskhun' => $item->nomorskhun,
                            'lamabelajar' => $item->lamabelajar,
                            'pindah' => $item->pindah,
                            'sekolahpindah' => $item->sekolahpindah,
                            'alasanpindah' => $item->alasanpindah,
                            //ayahkandung1
                            'namaayah' => $item->namaayah,
                            'idtempatlahirayah' => $item->idtempatlahirayah,
                            'tgllahirayah' => $item->tgllahirayah,
                            // 'umurayah' => $request['umurayah1'],
                            'idagamaayah' => $item->idagamaayah,
                            'idpendidikanayah' => $item->idpendidikanayah,
                            'warganegaraayah' => $item->warganegaraayah,
                            'pekerjaanayah' => $item->pekerjaanayah,
                            // 'penghasilanayah' => $request['penghasilanayah1'],
                            'pengeluaranayah' => $item->pengeluaranayah,
                            'hidupayah' => $item->hidupayah,
                            // 'tglmeninggalayah' => $request['tglmeninggalayah1'],
                            'alamatayah' => $item->alamatayah,
                            'iddesaayah' => $item->iddesaayah,
                            // 'telpayah' => $request['telpayah1'],   
                            //ibu 
                            'namaibu' => $item->namaibu,
                            'idtempatlahiribu' => $item->idtempatlahiribu,
                            'tgllahiribu' => $item->tgllahiribu,
                            // 'umuribu' => $request['umuribu1'],
                            'idagamaibu' => $item->idagamaibu,
                            'idpendidikanibu' => $item->idpendidikanibu,
                            'warganegaraibu' => $item->warganegaraibu,
                            'pekerjaanibu' => $item->pekerjaanibu,
                            // 'penghasilanibu' => $request['penghasilanibu1'],
                            'pengeluaranibu' => $item->pengeluaranibu,
                            'hidupibu' => $item->hidupibu,
                            // 'tglmeninggalibu' => $request['tglmeninggalibu1'],
                            'alamatibu' => $item->alamatibu,
                            'iddesaibu' => $item->iddesaibu,
                            // 'telpibu' => $request['telpibu1'],
                            //wali
                            'namawali' => $item->namawali,
                            'idtempatlahirwali' => $item->idtempatlahirwali,
                            'tgllahirwali' => $item->tgllahirwali,
                            // 'umurwali' => $request['umurwali1'],
                            'idagamawali' => $item->idagamawali,
                            'idpendidikanwali' => $item->idpendidikanwali,
                            'warganegarawali' => $item->warganegarawali,
                            'pekerjaanwali' => $item->pekerjaanwali,
                            // 'penghasilanwali' => $request['penghasilanwali1'],
                            'pengeluaranwali' => $item->pengeluaranwali,
                            // 'hidupwali' => $request['hidupwali1'],
                            // 'tglmeninggalwali' => $request['tglmeninggalwali1'],
                            'alamatwali' => $item->alamatwali,
                            'iddesawali' => $item->iddesawali,
                            // 'telpwali' => $request['telpwali1'],
                            //hobi1
                            'hobikesenian' => $item->hobikesenian,
                            'hobiolahraga' => $item->hobiolahraga,
                            'hobiorganisasi' => $item->hobiorganisasi,
                            'hobilain' => $item->hobilain,        
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

                        ];

                        $cari = Datasiswa::where('nis', '=', $nis)
                            ->orWhere('nisn', '=', $nisn)
                            ->count();
                        if($cari==0){
                            Datasiswa::create($data);
                        }else{
                            Datasiswa::where('nis', '=', $nis)
                            ->orWhere('nisn', '=', $nisn)
                            ->update($data);
                        } 

                    }
                    //hapus data

                    if ($jr >= $totalrecord){
                        Memdatasiswa::where('id','>',0)
                        ->delete();
                    }

                } catch (\Exception $e) {
                    // Kirim response JSON gagal jika terjadi error database/format file
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal melakukan import: ' . $e->getMessage()
                    ], 500);
                }
            }
        }
        
    }
    
    /*
     */
   
    public function create(Request $request)
    {
       
        $id = $request['id1'];

        $tampil = Datasiswa::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $fotoktp = $item->fotoktp;            
            $fotoawal = $item->fotoawal;            
            $fotoakhir = $item->fotoakhir;            
        }

        if ($id == '0') {
            if ($request->hasFile('fotoktp1')) {
                $validatefotoktp = $request->validate([
                    'fotoktp1' => 'file|max:2048',
                ]);
                if ($validatefotoktp) {
                    $fotoktp1 = $request->file('fotoktp1')->store('Sips01-datasiswa-fotoktp');
                } else {
                    $fotoktp1 = '';
                }
            } else {
                $fotoktp1 = '';
            }
            
        } else {
            if ($request->hasFile('fotoktp1')) {
                $validatefotoktp = $request->validate([
                    'fotoktp1' => 'file|max:2048',
                ]);
                if ($validatefotoktp) {
                    if ($fotoktp) {
                        storage::delete($fotoktp);
                        $fotoktp1 = $request->file('fotoktp1')->store('Sips01-datasiswa-fotoktp');
                    } else {
                        $fotoktp1 = $request->file('fotoktp1')->store('Sips01-datasiswa-fotoktp');
                    }
                } else {
                    $fotoktp1 = $fotoktp;
                }
            } else {
                $fotoktp1 = $fotoktp;
            }
        }

        if ($id == '0') {
            if ($request->hasFile('fotoawal1')) {
                $validatefotoawal = $request->validate([
                    'fotoawal1' => 'file|max:2048',
                ]);
                if ($validatefotoawal) {
                    $fotoawal1 = $request->file('fotoawal1')->store('Sips01-datasiswa-fotoawal');
                } else {
                    $fotoawal1 = '';
                }
            } else {
                $fotoawal1 = '';
            }
            
        } else {
            if ($request->hasFile('fotoawal1')) {
                $validatefotoawal = $request->validate([
                    'fotoawal1' => 'file|max:2048',
                ]);
                if ($validatefotoawal) {
                    if ($fotoawal) {
                        storage::delete($fotoawal);
                        $fotoawal1 = $request->file('fotoawal1')->store('Sips01-datasiswa-fotoawal');
                    } else {
                        $fotoawal1 = $request->file('fotoawal1')->store('Sips01-datasiswa-fotoawal');
                    }
                } else {
                    $fotoawal1 = $fotoawal;
                }
            } else {
                $fotoawal1 = $fotoawal;
            }
        }

        if ($id == '0') {
            if ($request->hasFile('fotoakhir1')) {
                $validatefotoakhir = $request->validate([
                    'fotoakhir1' => 'file|max:2048',
                ]);
                if ($validatefotoakhir) {
                    $fotoakhir1 = $request->file('fotoakhir1')->store('Sips01-datasiswa-fotoakhir');
                } else {
                    $fotoakhir1 = '';
                }
            } else {
                $fotoakhir1 = '';
            }
            
        } else {
            if ($request->hasFile('fotoakhir1')) {
                $validatefotoakhir = $request->validate([
                    'fotoakhir1' => 'file|max:2048',
                ]);
                if ($validatefotoakhir) {
                    if ($fotoakhir) {
                        storage::delete($fotoakhir);
                        $fotoakhir1 = $request->file('fotoakhir1')->store('Sips01-datasiswa-fotoakhir');
                    } else {
                        $fotoakhir1 = $request->file('fotoakhir1')->store('Sips01-datasiswa-fotoakhir');
                    }
                } else {
                    $fotoakhir1 = $fotoakhir;
                }
            } else {
                $fotoakhir1 = $fotoakhir;
            }
        }
        
        $validatedData = $request->validate([
            'namalengkap1' => 'required',
            'ecard1' => 'required',
            'nis1' => 'required',
            'nisn1' => 'required',
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'idtpmasuk' => $request['idtpmasuk1'],
            //identitas1
            'namalengkap' => $validatedData['namalengkap1'],
            'ecard' => $validatedData['ecard1'],
            'nis' => $validatedData['nis1'],
            'nisn' => $validatedData['nisn1'],
            'tglditerima' => $request['tglditerima1'],
            'idstatussiswa' => $request['idstatussiswa1'],
            'idkompetensi' => $request['idkompetensi1'],
            //datadiri1
            'namapanggilan' => $request['namapanggilan1'],
            'idtempatlahir' => $request['idtempatlahir1'],
            'tgllahir' => $request['tgllahir1'],
            'idjk' => $request['idjk1'],
            'idagama' => $request['idagama1'],
            'warganegara' => $request['warganegara1'],
            'bahasa' => $request['bahasa1'],
            'idstatusanak' => $request['idstatusanak1'],
            'anakke' => $request['anakke1'],
            'jmlsdrkandung' => $request['jmlsdrkandung1'],
            'jmlsdrtiri' => $request['jmlsdrtiri1'],
            'jmlsdrangkat' => $request['jmlsdrangkat1'],
            //tempattinggal1
            'alamat' => $request['alamat1'],
            'iddesa' => $request['iddesa1'],
            'telp' => $request['telp1'],
            'email' => $request['email1'],
            'jarakkesekolah' => $request['jarakkesekolah1'],
            'idtinggal' => $request['idtinggal1'],
            //kesehatan1
            'penyakit' => $request['penyakit1'],
            'kelainan' => $request['kelainan1'],
            'idgd' => $request['idgd1'],
            'tinggibadan' => $request['tinggibadan1'],
            'beratbadan' => $request['beratbadan1'],            
            //pendidikan1
            'asalsekolah' => $request['asalsekolah1'],
            'tglsttb' => $request['tglsttb1'],
            'nomorsttb' => $request['nomorsttb1'],
            'tglskhun' => $request['tglskhun1'],
            'nomorskhun' => $request['nomorskhun1'],
            'lamabelajar' => $request['lamabelajar1'],
            'pindah' => $request['pindah1'],
            'sekolahpindah' => $request['sekolahpindah1'],
            'alasanpindah' => $request['alasanpindah1'],
            //ayahkandung1
            'namaayah' => $request['namaayah1'],
            'idtempatlahirayah' => $request['idtempatlahirayah1'],
            'tgllahirayah' => $request['tgllahirayah1'],
            'umurayah' => $request['umurayah1'],
            'idagamaayah' => $request['idagamaayah1'],
            'idpendidikanayah' => $request['idpendidikanayah1'],
            'warganegaraayah' => $request['warganegaraayah1'],
            'pekerjaanayah' => $request['pekerjaanayah1'],
            'penghasilanayah' => $request['penghasilanayah1'],
            'pengeluaranayah' => $request['pengeluaranayah1'],
            'hidupayah' => $request['hidupayah1'],
            'tglmeninggalayah' => $request['tglmeninggalayah1'],
            'alamatayah' => $request['alamatayah1'],
            'iddesaayah' => $request['iddesaayah1'],
            'telpayah' => $request['telpayah1'],            
            //ibu
            'namaibu' => $request['namaibu1'],
            'idtempatlahiribu' => $request['idtempatlahiribu1'],
            'tgllahiribu' => $request['tgllahiribu1'],
            'umuribu' => $request['umuribu1'],
            'idagamaibu' => $request['idagamaibu1'],
            'idpendidikanibu' => $request['idpendidikanibu1'],
            'warganegaraibu' => $request['warganegaraibu1'],
            'pekerjaanibu' => $request['pekerjaanibu1'],
            'penghasilanibu' => $request['penghasilanibu1'],
            'pengeluaranibu' => $request['pengeluaranibu1'],
            'hidupibu' => $request['hidupibu1'],
            'tglmeninggalibu' => $request['tglmeninggalibu1'],
            'alamatibu' => $request['alamatibu1'],
            'iddesaibu' => $request['iddesaibu1'],
            'telpibu' => $request['telpibu1'],
            //wali
            'namawali' => $request['namawali1'],
            'idtempatlahirwali' => $request['idtempatlahirwali1'],
            'tgllahirwali' => $request['tgllahirwali1'],
            'umurwali' => $request['umurwali1'],
            'idagamawali' => $request['idagamawali1'],
            'idpendidikanwali' => $request['idpendidikanwali1'],
            'warganegarawali' => $request['warganegarawali1'],
            'pekerjaanwali' => $request['pekerjaanwali1'],
            'penghasilanwali' => $request['penghasilanwali1'],
            'pengeluaranwali' => $request['pengeluaranwali1'],
            'hidupwali' => $request['hidupwali1'],
            'tglmeninggalwali' => $request['tglmeninggalwali1'],
            'alamatwali' => $request['alamatwali1'],
            'iddesawali' => $request['iddesawali1'],
            'telpwali' => $request['telpwali1'],
            //hobi1
            'hobikesenian' => $request['hobikesenian1'],
            'hobiolahraga' => $request['hobiolahraga1'],
            'hobiorganisasi' => $request['hobiorganisasi1'],
            'hobilain' => $request['hobilain1'],        
            //perkembangan1
            'idtpkeluar' => $request['idtpkeluar1'],
            'tglkeluar' => $request['tglkeluar1'],
            'idalasankeluar' => $request['idalasankeluar1'],
            'nomorijasahlulus' => $request['nomorijasahlulus1'],
            'tglijasahlulus' => $request['tglijasahlulus1'],
            'nomorskhunlulus' => $request['nomorskhunlulus1'],
            'tglskhunlulus' => $request['tglskhunlulus1'],
            'keteranganlulus' => $request['keteranganlulus1'],
            'aktif' => $request['aktif1'],
            //selesai1
            'idalasansetelahkeluar' => $request['idalasansetelahkeluar1'],
            'sekolahlanjut' => $request['sekolahlanjut1'],
            'jurusanlanjut' => $request['jurusanlanjut1'],
            'kerjadi' => $request['kerjadi1'],
            'tglmulaikerja' => $request['tglmulaikerja1'],
            'namaperusahaan' => $request['namaperusahaan1'],
            'penghasilankerja' => $request['penghasilankerja1'],
            //images
            'fotoktp' => $fotoktp1,
            'fotoawal' => $fotoawal1,
            'fotoakhir' => $fotoakhir1,

        ];

        if ($id == '0') {
            Datasiswa::create($data);
        } else {
            Datasiswa::where('id', '=', $id)->update($data);
        }
        return json_encode('data');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show(Request $request)
    {
        $idtpmasuk = session('idtp');

        $datax = Datasiswa::where('idtpmasuk','=',$idtpmasuk)->orderBy('nis','asc')
                ->with([
                    'tpmasuk', 
                    'statussiswa',
                    'kompetensi', 
                    'tempatlahir', 
                    'jk', 
                    'agama', 
                    'statusanak', 
                    'desa', 
                    'tinggal', 
                    'gd', 
                    'tempatlahirayah', 'agamaayah', 'pendidikanayah','desaayah',
                    'tempatlahiribu', 'agamaibu', 'pendidikanibu', 'desaibu',
                    'tempatlahirwali', 'agamawali', 'pendidikanwali','desawali',
                    'tpkeluar',
                    'alasankeluar',
                    'alasansetelahkeluar',
                ]);
                
    if ($request->ajax()) {
        $data = DataTables::of($datax)
            ->addIndexColumn()
            ->filterColumn('nis', function($query, $keyword) {                    
                $query->whereRaw("nis LIKE ?", ["%{$keyword}%"]);
            })
            ->filterColumn('nisn', function($query, $keyword) {                    
                $query->whereRaw("nisn LIKE ?", ["%{$keyword}%"]);
            })
            ->filterColumn('ecard', function($query, $keyword) {                    
                $query->whereRaw("ecard LIKE ?", ["%{$keyword}%"]);
            })
            ->filterColumn('namalengkap', function($query, $keyword) {                    
                $query->whereRaw("namalengkap LIKE ?", ["%{$keyword}%"]);
            })
            ->filterColumn('namapanggilan', function($query, $keyword) {                    
                $query->whereRaw("namapanggilan LIKE ?", ["%{$keyword}%"]);
            })
            ->addColumn('tpmasuk', function ($row) {
                return $row->tpmasuk ? $row->tpmasuk->tp : '-';
            })
            ->addColumn('statussiswa', function ($row) {
                return $row->statussiswa ? $row->statussiswa->statussiswa : '-';
            })
            ->addColumn('kompetensi', function ($row) {
                return $row->kompetensi ? $row->kompetensi->kompetensi : '-';
            })
            ->addColumn('tempatlahir', function ($row) {
                return ($row->tempatlahir ? $row->tempatlahir->kabupaten : '-') . (', <br>') .
                    ($row->tgllahir ? $row->tgllahir : '');
            })
            ->addColumn('jk', function ($row) {
                return $row->jk ? $row->jk->jk : '-';
            })
            ->addColumn('agama', function ($row) {
                return $row->agama ? $row->agama->agama : '-';
            })
            ->addColumn('statusanak', function ($row) {
                return $row->statusanak ? $row->statusanak->statusanak : '-';
            })
            ->addColumn('jmlsdr', function ($row) {
                return $row->jmlsdrkandung . ' | ' . $row->jmlsdrtiri . ' | ' . $row->jmlsdrangkat;
            })
            ->addColumn('desa', function ($row) {
                return ($row->desa ? $row->desa->desa : '-') . (', <br>') .
                    ($row->desa->kecamatan ? $row->desa->kecamatan->kecamatan : '-') . (', <br>') .
                    ($row->desa->kecamatan->kabupaten ? $row->desa->kecamatan->kabupaten->kabupaten : '-') . (', <br>') .
                    ($row->desa->kecamatan->kabupaten->propinsi ? $row->desa->kecamatan->kabupaten->propinsi->propinsi : '-');
            })
            ->addColumn('tinggal', function ($row) {
                return $row->tinggal ? $row->tinggal->tinggal : '-';
            })
            ->addColumn('gd', function ($row) {
                return $row->gd ? $row->gd->gd : '-';
            })

            ->addColumn('desaayah', function ($row) {
                return ($row->desaayah ? $row->desaayah->desa : '-') . (', <br>') .
                    ($row->desaayah->kecamatan ? $row->desaayah->kecamatan->kecamatan : '-') . (', <br>') .
                    ($row->desaayah->kecamatan->kabupaten ? $row->desaayah->kecamatan->kabupaten->kabupaten : '-') . (', <br>') .
                    ($row->desaayah->kecamatan->kabupaten->propinsi ? $row->desaayah->kecamatan->kabupaten->propinsi->propinsi : '-');
            })
            ->addColumn('tempatlahirayah', function ($row) {
                return ($row->tempatlahirayah ? $row->tempatlahirayah->kabupaten : '-') . (', <br>') .
                    ($row->tgllahirayah) . (', <br>') . ($row->umurayah) . (' thn');
            })
            ->addColumn('pekerjaanayah', function ($row) {
                return ($row->pekerjaanayah ? $row->pekerjaanayah : '-') . ('<br>') . 
                       (Number::currency($row->penghasilanayah ?? 0, in: 'IDR', locale: 'id')) . (' <br>') . 
                       (Number::currency($row->pengeluaranayah ?? 0, in: 'IDR', locale: 'id')); 
            })
            ->editColumn('hidupayah', function ($row) {
                $hidup = ($row->hidupayah ? $row->hidupayah : 'Y') . (', <br>');
                if($row->hidupayah=='N'){
                    $tgl = ($row->tglmeninggalayah ? $row->tglmeninggalayah : '-');
                }else{
                    $tgl = '-';
                }
                return $hidup . $tgl;
            })

            ->addColumn('desaibu', function ($row) {
                return ($row->desaibu ? $row->desaibu->desa : '-') . (', <br>') .
                    ($row->desaibu->kecamatan ? $row->desaibu->kecamatan->kecamatan : '-') . (', <br>') .
                    ($row->desaibu->kecamatan->kabupaten ? $row->desaibu->kecamatan->kabupaten->kabupaten : '-') . (', <br>') .
                    ($row->desaibu->kecamatan->kabupaten->propinsi ? $row->desaibu->kecamatan->kabupaten->propinsi->propinsi : '-');
            })
            ->addColumn('tempatlahiribu', function ($row) {
                return ($row->tempatlahiribu ? $row->tempatlahiribu->kabupaten : '-') . (', <br>') .
                    ($row->tgllahiribu) . (', <br>') . ($row->umuribu) . (' thn');
            })
            ->addColumn('pekerjaanibu', function ($row) {
                return ($row->pekerjaanibu ? $row->pekerjaanibu : '-') . ('<br>') . 
                       (Number::currency($row->penghasilanibu ?? 0, in: 'IDR', locale: 'id')) . (' <br>') . 
                       (Number::currency($row->pengeluaranibu ?? 0, in: 'IDR', locale: 'id'));    
            })
            ->editColumn('hidupibu', function ($row) {
                $hidup = ($row->hidupibu ? $row->hidupibu : 'Y') . (', <br>');
                if($row->hidupibu=='N'){
                    $tgl = ($row->tglmeninggalibu ? $row->tglmeninggalibu : '-');
                }else{
                    $tgl = '-';
                }
                return $hidup . $tgl;
            })

            ->addColumn('desawali', function ($row) {
                return ($row->desawali ? $row->desawali->desa : '-') . (', <br>') .
                    ($row->desawali->kecamatan ? $row->desawali->kecamatan->kecamatan : '-') . (', <br>') .
                    ($row->desawali->kecamatan->kabupaten ? $row->desawali->kecamatan->kabupaten->kabupaten : '-') . (', <br>') .
                    ($row->desawali->kecamatan->kabupaten->propinsi ? $row->desawali->kecamatan->kabupaten->propinsi->propinsi : '-');
            })
            ->addColumn('tempatlahirwali', function ($row) {
                return ($row->tempatlahirwali ? $row->tempatlahirwali->kabupaten : '-') . (', <br>') .
                    ($row->tgllahirwali) . (', <br>') . ($row->umurwali) . (' thn');
            })
            ->editColumn('hidupwali', function ($row) {
                $hidup = ($row->hidupwali ? $row->hidupwali : 'Y') . (', <br>');
                if($row->hidupwali=='N'){
                    $tgl = ($row->tglmeninggalwali ? $row->tglmeninggalwali : '-');
                }else{
                    $tgl = '-';
                }
                return $hidup . $tgl;
            })

            ->addColumn('desawali', function ($row) {
                return ($row->desawali ? $row->desawali->desa : '-') . (', <br>') .
                    ($row->desawali->kecamatan ? $row->desawali->kecamatan->kecamatan : '-') . (', <br>') .
                    ($row->desawali->kecamatan->kabupaten ? $row->desawali->kecamatan->kabupaten->kabupaten : '-') . (', <br>') .
                    ($row->desawali->kecamatan->kabupaten->propinsi ? $row->desawali->kecamatan->kabupaten->propinsi->propinsi : '-');
            })
            ->addColumn('tempatlahirwali', function ($row) {
                return ($row->tempatlahirwali ? $row->tempatlahirwali->kabupaten : '-') . (', <br>') .
                    ($row->tgllahirwali) . (', <br>') . ($row->umurwali) . (' thn');
            })
            ->addColumn('pekerjaanwali', function ($row) {
                return ($row->pekerjaanwali ? $row->pekerjaanwali : '-') . ('<br>') . 
                       (Number::currency($row->penghasilanwali ?? 0, in: 'IDR', locale: 'id')) . (' <br>') . 
                       (Number::currency($row->pengeluaranwali ?? 0, in: 'IDR', locale: 'id')); 
            })
            ->addColumn('tpkeluar', function ($row) {
                return $row->tpkeluar ? $row->tpkeluar->tp : '-';
            })

            ->addColumn('alasankeluar', function ($row) {
                return $row->alasankeluar ? $row->alasankeluar->alasankeluar : '-';
            })

            ->addColumn('alasansetelahkeluar', function ($row) {
                return $row->alasansetelahkeluar ? $row->alasansetelahkeluar->alasansetelahkeluar : '-';
            })
            ->addColumn('nomorijasahlulus', function ($row) {
                return ($row->nomorijasahlulus ? $row->nomorijasahlulus : '') . (', <br>') .
                    ($row->tglijasahlulus ? $row->tglijasahlulus : '');
            })
            ->editColumn('penghasilankerja', function ($row) {
                return (Number::currency($row->penghasilankerja ?? 0, in: 'IDR', locale: 'id'));
            })
            ->addColumn('fotoktp', function ($row) {
                return $row->fotoktp ? '<img class="mb-4" style="width: 90px; height: 120px;" src="'. route('front.index') . '/storage/'. $row->fotoktp.'">' : '';
            })
            ->addColumn('fotoawal', function ($row) {
                return $row->fotoawal ? '<img class="mb-4" style="width: 90px; height: 120px;" src="'. route('front.index') . '/storage/'. $row->fotoawal.'">' : '';
            })
            ->addColumn('fotoakhir', function ($row) {
                return $row->fotoakhir ? '<img class="mb-4" style="width: 90px; height: 120px;" src="'. route('front.index') . '/storage/'. $row->fotoakhir.'">' : '';
            })
            
            ->addColumn('action', function ($row) {
                return '<a href="#" title="Edit Data" class="btn btn-success btn-xs item_edit" data0="edit" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="#" title="Hapus Data" class="btn btn-danger btn-xs item_destroy" data0="destroy" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>' .
                       '<a href="#" title="Print Data" class="btn btn-warning btn-xs item_print" data0="print" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-printer-fill fs-6"></i></a>';
            })
            
            ->addColumn('action2', function ($row) {
                return '<a href="#" title="Edit Data" class="btn btn-success btn-xs item_edit" data0="edit" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="#" title="Hapus Data" class="btn btn-danger btn-xs item_destroy" data0="destroy" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
            })
            ->addColumn('beasiswa', function ($row) {
                return '<a href="#" title="Lihat Data Beasiswa ' . $row->namalengkap . '" class="btn btn-info btn-xs item_lihat" data0="lihat" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-eye fs-6"></i></a>';
            })

            ->rawColumns(['action', 'action2', 'tempatlahir', 'desa', 
                'desaayah','tempatlahirayah', 'pekerjaanayah', 'hidupayah',
                'desaibu','tempatlahiribu', 'pekerjaanibu', 'hidupibu',
                'desawali','tempatlahirwali', 'pekerjaanwali', 'hidupwali',
                'nomorijasahlulus', 'beasiswa', 'penghasilankerja',
                'fotoktp','fotoawal','fotoakhir'
                ])


            ->make(true);

            return $data;
        }
       
    }

    public function showbeasiswa(Request $request)
    {
        $iddatasiswa1 = session('iddatasiswa1');
        $datax = Beasiswa::with(['tp','datasiswa','kelas'])->where('iddatasiswa','=',$iddatasiswa1);
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->dari.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->dari.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }
    }

    public function showkabupaten(Request $request)
    {
        $datax = Kabupaten::with('propinsi')
            ->orderBy('idpropinsi', 'asc')
            ->orderBy('kabupaten', 'asc');
            
        
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                ->filterColumn('kabupaten', function($query, $keyword) {                    
                    $query->whereRaw("kabupaten LIKE ?", ["%{$keyword}%"]);
                })
                ->addColumn('kode', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kode . '" class="text-decoration-none  text-body item_carikode" data1="'. $row->id.'">' . $row->kode . '</a>';    
                    return $hasil;
                })
                ->addColumn('kabupaten', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kabupaten . '" class="text-decoration-none  text-body item_carikabupaten" data1="'. $row->id.'">' . $row->kabupaten . '</a>';    
                    return $hasil;
                })
                ->addColumn('propinsi', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->propinsi->propinsi . '" class="text-decoration-none  text-body item_caripropinsi" data1="'. $row->id.'">' . $row->propinsi->propinsi . '</a>';    
                    return $hasil;
                })
                
                ->rawColumns([
                    'kode',  
                    'kabupaten',
                    'propinsi',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }
    }

    public function showdesa(Request $request)
    {
        
        $datax = Desa::select(['id','kode','desa','idkecamatan'])
            ->with('kecamatan');

        if ($request->ajax()) {
            $data = DataTables::of($datax)
                
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                //order
                ->orderColumn('desa', function (Builder $query, $order) {
                    $query->orderBy('desa', $order);
                })
                //searching
                ->filterColumn('desa', function($query, $keyword) {                    
                    $query->whereRaw("desa LIKE ?", ["%{$keyword}%"]);
                })
                
                ->editColumn('kode', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kode . '" class="text-decoration-none  text-body item_carikode" data1="'. $row->id.'" data2="'. $row->kode.'" data3="'. $row->desa.'" data4="'. $row->kecamatan->kecamatan.'" data5="'. $row->kecamatan->kabupaten->kabupaten.'" data6="'. $row->kecamatan->kabupaten->propinsi->propinsi.'">' . $row->kode . '</a>';    
                    return $hasil;
                })
                ->editColumn('desa', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->desa . '" class="text-decoration-none  text-body item_caridesa" data1="'. $row->id.'" data2="'. $row->kode.'" data3="'. $row->desa.'" data4="'. $row->kecamatan->kecamatan.'" data5="'. $row->kecamatan->kabupaten->kabupaten.'" data6="'. $row->kecamatan->kabupaten->propinsi->propinsi.'">' . $row->desa . '</a>';    
                    return $hasil;
                })
                ->addColumn('kecamatan', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kecamatan->kecamatan . '" class="text-decoration-none  text-body item_carikecamatan" data1="'. $row->id.'" data2="'. $row->kode.'" data3="'. $row->desa.'" data4="'. $row->kecamatan->kecamatan.'" data5="'. $row->kecamatan->kabupaten->kabupaten.'" data6="'. $row->kecamatan->kabupaten->propinsi->propinsi.'">' . $row->kecamatan->kecamatan . '</a>';    
                    return $hasil;
                })
                ->addColumn('kabupaten', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kecamatan->kabupaten->kabupaten . '" class="text-decoration-none  text-body item_carikabupaten" data1="'. $row->id.'" data2="'. $row->kode.'" data3="'. $row->desa.'" data4="'. $row->kecamatan->kecamatan.'" data5="'. $row->kecamatan->kabupaten->kabupaten.'" data6="'. $row->kecamatan->kabupaten->propinsi->propinsi.'">' . $row->kecamatan->kabupaten->kabupaten . '</a>';    
                    return $hasil;
                })
                ->addColumn('propinsi', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kecamatan->kabupaten->propinsi->propinsi . '" class="text-decoration-none  text-body item_caripropinsi" data1="'. $row->id.'" data2="'. $row->kode.'" data3="'. $row->desa.'" data4="'. $row->kecamatan->kecamatan.'" data5="'. $row->kecamatan->kabupaten->kabupaten.'" data6="'. $row->kecamatan->kabupaten->propinsi->propinsi.'">' . $row->kecamatan->kabupaten->propinsi->propinsi . '</a>';    
                    return $hasil;
                })
                
                ->rawColumns([
                    'kode',  
                    'desa',  
                    'kecamatan',  
                    'kabupaten',
                    'propinsi',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Datasiswa::where('id', '=', $id)
            ->with([
                    'tpmasuk', 
                    'statussiswa',
                    'kompetensi', 
                    'tempatlahir', 
                    'jk', 
                    'agama', 
                    'statusanak', 
                    'desa', 
                    'tinggal', 
                    'gd', 
                    'tempatlahirayah', 'agamaayah', 'pendidikanayah','desaayah',
                    'tempatlahiribu', 'agamaibu', 'pendidikanibu', 'desaibu',
                    'tempatlahirwali', 'agamawali', 'pendidikanwali','desawali',
                    'tpkeluar',
                    'alasankeluar',
                    'alasansetelahkeluar',
                ])
            ->get();
        return json_encode(array('data' => $data));       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $tampil = Datasiswa::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $fotoktp = $item->fotoktp;            
            $fotoawal = $item->fotoawal;            
            $fotoakhir = $item->fotoakhir;            
        }

        if($fotoktp){
            storage::delete($fotoktp);
        }
        if($fotoawal){
            storage::delete($fotoawal);
        }
        if($fotoakhir){
            storage::delete($fotoakhir);
        }

        $data = Datasiswa::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    public function kirimsyarat(Request $request)
    {
        $idtp = $request['idtp1'];
        session([
            'idtp' => $idtp,
        ]);
    }
    public function kirimid(Request $request)
    {
        $iddatasiswa1 = $request['iddatasiswa1'];
        $nisn1 = $request['nisn1'];
        session([
            'iddatasiswa1' => $iddatasiswa1,
            'nisn1' => $nisn1,
        ]);
    }
    public function kirimiddatasiswa(Request $request)
    {
        $iddatasiswa1 = $request['id1'];
        session([
            'iddatasiswa1' => $iddatasiswa1,
        ]);
    }

    function listtpmasuk()
    {
        $tampil = Tp::orderBy('tp', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->tp . "</option>";
        }
    }

    function liststatussiswa()
    {
        $tampil = Statussiswa::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->statussiswa . "</option>";
        }
    }

    
    function listjk()
    {
        $tampil = Jk::orderBy('jk', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->jk . "</option>";
        }
    }
    function listagama()
    {
        $tampil = Agama::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->agama . "</option>";
        }
    }
    function listtempatlahir()
    {
        $tampil = Kabupaten::with('propinsi')->orderBy('kabupaten', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->kabupaten . " - " . $baris->propinsi->propinsi . "</option>";
        }
    }

    function listkompetensi()
    {
        $tampil = Kompetensi::with('program')->where('aktif','=','Y')
        ->orderBy('kompetensi','asc')       
        ->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->kompetensi . " - " . $baris->program->program . "</option>";
        }
    }
    function showkompetensi(Request $request)
    {
        $datax = Kompetensi::with('program')->where('aktif','=','Y')
        ->orderBy('kode2','asc');       
        // ->get();

        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                ->addColumn('kode', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kode . '" class="text-decoration-none  text-body item_carikode" data1="'. $row->id.'">' . $row->kode . '</a>';    
                    return $hasil;
                })
                ->addColumn('kode2', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kode2 . '" class="text-decoration-none  text-body item_carikode2" data1="'. $row->id.'">' . $row->kode2 . '</a>';    
                    return $hasil;
                })
                ->addColumn('kompetensi', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kompetensi . '" class="text-decoration-none  text-body item_carikompetensi" data1="'. $row->id.'">' . $row->kompetensi . '</a>';    
                    return $hasil;
                })
                ->addColumn('program', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->program->program . '" class="text-decoration-none  text-body item_cariprogram" data1="'. $row->id.'">' . $row->program->program . '</a>';    
                    return $hasil;
                })
                ->addColumn('bidang', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->program->bidang->bidang . '" class="text-decoration-none  text-body item_caribidang" data1="'. $row->id.'">' . $row->program->bidang->bidang . '</a>';    
                    return $hasil;
                })
                
                ->rawColumns([
                    'kode',  
                    'kode2',  
                    'kompetensi',
                    'program',
                    'bidang',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }

    }


    function liststatusanak()
    {
        $tampil = Statusanak::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->statusanak . "</option>";
        }
    }
    function listdesa_ori()
    {
        $tampil = Desa::select(['id','desa'])
            ->orderBy('Desa', 'asc')
            ->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->desa . "</option>";
        }
    }

    function listdesa_bukanori()
    {
        // Gunakan cache agar query database tidak terbebani setiap waktu
        $htmlDesa = Cache::remember('list_desa_html', 86400, function () {
            $tampil = Desa::select(['id', 'desa'])
                ->orderBy('desa', 'asc')
                ->get();

            // Antisipasi jika database ternyata masih kosong
            if ($tampil->isEmpty()) {
                return '<option value="">Data desa belum tersedia</option>';
            }

            $output = '';
            foreach ($tampil as $baris) {
                $output .= "<option value='" . $baris->id . "'>" . e($baris->desa) . "</option>";
            }
            
            return $output;
        });

        echo $htmlDesa;
    }

    function listdesa()
    {
        try {
            // Menyimpan HTML ke dalam cache selama 24 jam (86400 detik)
            $htmlDesa = Cache::remember('list_desa_html', 86400, function () {
                
                // CATATAN: Pastikan huruf kapital 'id', 'desa', atau 'Desa' 
                // sudah sesuai dengan nama kolom asli di tabel PHPMyAdmin Anda.
                $tampil = Desa::select(['id', 'desa'])->limit(10)
                    ->orderBy('desa', 'asc') 
                    ->get();

                if ($tampil->isEmpty()) {
                    return '<option value="">Data desa tidak ditemukan di database</option>';
                }

                $output = '';
                foreach ($tampil as $baris) {
                    // Pastikan juga nama properti ($baris->desa) sesuai huruf kapitalnya
                    $output .= "<option value='" . $baris->id . "'>" . e($baris->desa) . "</option>";
                }
                
                return $output;
            });

            echo $htmlDesa;

        } catch (\Exception $e) {
            // Jika ada kode yang salah/error, kirim pesan error aslinya ke browser
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    function listtinggal()
    {
        $tampil = Tinggal::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->tinggal . "</option>";
        }
    }
    function listgd()
    {
        $tampil = Gd::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->gd . "</option>";
        }
    }

    function listpendidikan()
    {
        $tampil = Pendidikan::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->pendidikan . "</option>";
        }
    }
    function listalasankeluar()
    {
        $tampil = Alasankeluar::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->alasankeluar . "</option>";
        }
    }
    function listalasansetelahkeluar()
    {
        $tampil = Alasansetelahkeluar::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->alasansetelahkeluar . "</option>";
        }
    }

    function listkelas()
    {
        $tampil = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelas . "</option>";
        }
    }

    public function kirim(Request $request)
    {
        
        $validatedData = $request->validate([
            'idtp1' => 'required',
            'idkelas1' => 'required',
        ]);
        $siswakelas2 = Siswakelas::select('iddatasiswa')->where('idtp','=',$request['idtp1']);
        $jmlsiswa = Datasiswa::select('id')->where('aktif','=','Y')
            ->where('idtpmasuk','=',$request['idtp1'])
            ->whereNotIn('id', $siswakelas2)->count();
        
        if($jmlsiswa<>'0'){
            
            $tampil = Datasiswa::select('id')->where('aktif','=','Y')
                ->where('idtpmasuk','=',$request['idtp1'])
                ->whereNotIn('id', $siswakelas2)->get();
            foreach ($tampil as $item) {
                $data = [
                    'iddatasiswa' => $item->id,
                    'idtp' => $validatedData['idtp1'],
                    'idkelas' => $validatedData['idkelas1'],
                    'keterangan' => $request['keterangan1'],            
                ];
                Siswakelas::create($data);
            }
        }

        //update datasiswa.idkompetensi
        $iddatasiswa = Siswakelas::select('iddatasiswa')
            ->where('idtp','=',$validatedData['idtp1'])
            ->where('idkelas','=',$request['idkelas1']);
        $idkompetensi = Kelas::select('idkompetensi')->where('id','=',$request['idkelas1'])->value('idkompetensi');
        $dataku = [
            'idkompetensi' => $idkompetensi,
        ];
        Datasiswa::whereIn('id', $iddatasiswa)->update($dataku);

        return json_encode('data');
        
    }

    public function printdatainduk()
    {
        $id = session('iddatasiswa1');

        $datasiswa = Datasiswa::where('id', '=', $id)
            ->with([
                    'tpmasuk', 
                    'statussiswa',
                    'kompetensi', 
                    'tempatlahir', 
                    'jk', 
                    'agama', 
                    'statusanak', 
                    'desa', 
                    'tinggal', 
                    'gd', 
                    'tempatlahirayah', 'agamaayah', 'pendidikanayah','desaayah',
                    'tempatlahiribu', 'agamaibu', 'pendidikanibu', 'desaibu',
                    'tempatlahirwali', 'agamawali', 'pendidikanwali','desawali',
                    'tpkeluar',
                    'alasankeluar',
                    'alasansetelahkeluar',
                ])
            ->get();
        $idtp = session('idtp');
        $jmlrec = Siswakelas::where('iddatasiswa','=',$id)
                ->count();
        if($jmlrec<>'0'){
            $siswakelas = Siswakelas::limit(1)
                ->with(['datasiswa','tp','kelas'])
                ->where('iddatasiswa','=',$id)
                ->where('idtp','=',$idtp)
                ->get();
            foreach ($siswakelas as $item) {
                $kelas = $item->kelas->kelas ?? '-';
                $kompetensi = $item->kelas->kompetensi->kompetensi ?? '-';
                $program = $item->kelas->kompetensi->program->program ?? '-';
                $bidang = $item->kelas->kompetensi->program->bidang->bidang ?? '-';
            }
        }else{
            $kelas = '-';
            $kompetensi = '-';
            $program = '-';
            $bidang = '-';
        }
        
        $beasiswa = Beasiswa::where('iddatasiswa','=',$id)->orderBy('tanggal','asc')->with(['tp','kelas','kelas'])->skip(0)->first();
        $beasiswa0 = $beasiswa ? 'Tahun ' . Carbon::parse($beasiswa->tanggal)->locale('id')->isoFormat('YYYY') . ' / Kls ' . $beasiswa->kelas->tingkat->label . ' dari ' . $beasiswa->dari : 'Tahun ........ / Kls ........ dari ........';
        $beasiswa = Beasiswa::where('iddatasiswa','=',$id)->orderBy('tanggal','asc')->with(['tp','kelas','kelas'])->skip(1)->first();
        $beasiswa1 = $beasiswa ? 'Tahun ' . Carbon::parse($beasiswa->tanggal)->locale('id')->isoFormat('YYYY') . ' / Kls ' . $beasiswa->kelas->tingkat->label . ' dari ' . $beasiswa->dari : 'Tahun ........ / Kls ........ dari ........';
        $beasiswa = Beasiswa::where('iddatasiswa','=',$id)->orderBy('tanggal','asc')->with(['tp','kelas','kelas'])->skip(2)->first();
        $beasiswa2 = $beasiswa ? 'Tahun ' . Carbon::parse($beasiswa->tanggal)->locale('id')->isoFormat('YYYY') . ' / Kls ' . $beasiswa->kelas->tingkat->label . ' dari ' . $beasiswa->dari : 'Tahun ........ / Kls ........ dari ........';

        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk cetak <b>data Induk</b>.';
        $page = 'sips01::master.print.datasiswa_datainduk';
        $link = '/sips01/master/print/datasiswa_datainduk';
        $subtitle = 'Master';
        $caption = 'Print Data Induk';
        $jmlhal = 2;
        
        $pdf = Pdf::loadView($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => $datasiswa,
            'aplikasi' => Aplikasi::get(),
            'kelas' => $kelas,
            'kompetensi' => $kompetensi,
            'program' => $program,
            'bidang' => $bidang,
            'beasiswa0' => $beasiswa0,
            'beasiswa1' => $beasiswa1,
            'beasiswa2' => $beasiswa2,


        ])->setOptions(['defaultFont' => 'sans-serif', 'defaultFont' => 'sans-serif' ])->set_option('isHtml5ParserEnabled', true); 
        $pdf->set_paper(array(0, 0, 841.89, 1190.55), 'landscape');
        
        return $pdf->stream('buku_induk_' . session('nisn1').'.pdf');

        // static $PAPER_SIZES = array(
        //     "4a0" => array(0, 0, 4767.87, 6740.79),
        //     "2a0" => array(0, 0, 3370.39, 4767.87),
        //     "a0" => array(0, 0, 2383.94, 3370.39),
        //     "a1" => array(0, 0, 1683.78, 2383.94),
        //     "a2" => array(0, 0, 1190.55, 1683.78),
        //     "a3" => array(0, 0, 841.89, 1190.55),
        //     "a4" => array(0, 0, 595.28, 841.89),
        //     "a5" => array(0, 0, 419.53, 595.28),
        //     "a6" => array(0, 0, 297.64, 419.53),
        //     "a7" => array(0, 0, 209.76, 297.64),
        //     "a8" => array(0, 0, 147.40, 209.76),
        //     "a9" => array(0, 0, 104.88, 147.40),
        //     "a10" => array(0, 0, 73.70, 104.88),
        //     "b0" => array(0, 0, 2834.65, 4008.19),
        //     "b1" => array(0, 0, 2004.09, 2834.65),
        //     "b2" => array(0, 0, 1417.32, 2004.09),
        //     "b3" => array(0, 0, 1000.63, 1417.32),
        //     "b4" => array(0, 0, 708.66, 1000.63),
        //     "b5" => array(0, 0, 498.90, 708.66),
        //     "b6" => array(0, 0, 354.33, 498.90),
        //     "b7" => array(0, 0, 249.45, 354.33),
        //     "b8" => array(0, 0, 175.75, 249.45),
        //     "b9" => array(0, 0, 124.72, 175.75),
        //     "b10" => array(0, 0, 87.87, 124.72),
        //     "c0" => array(0, 0, 2599.37, 3676.54),
        //     "c1" => array(0, 0, 1836.85, 2599.37),
        //     "c2" => array(0, 0, 1298.27, 1836.85),
        //     "c3" => array(0, 0, 918.43, 1298.27),
        //     "c4" => array(0, 0, 649.13, 918.43),
        //     "c5" => array(0, 0, 459.21, 649.13),
        //     "c6" => array(0, 0, 323.15, 459.21),
        //     "c7" => array(0, 0, 229.61, 323.15),
        //     "c8" => array(0, 0, 161.57, 229.61),
        //     "c9" => array(0, 0, 113.39, 161.57),
        //     "c10" => array(0, 0, 79.37, 113.39),
        //     "ra0" => array(0, 0, 2437.80, 3458.27),
        //     "ra1" => array(0, 0, 1729.13, 2437.80),
        //     "ra2" => array(0, 0, 1218.90, 1729.13),
        //     "ra3" => array(0, 0, 864.57, 1218.90),
        //     "ra4" => array(0, 0, 609.45, 864.57),
        //     "sra0" => array(0, 0, 2551.18, 3628.35),
        //     "sra1" => array(0, 0, 1814.17, 2551.18),
        //     "sra2" => array(0, 0, 1275.59, 1814.17),
        //     "sra3" => array(0, 0, 907.09, 1275.59),
        //     "sra4" => array(0, 0, 637.80, 907.09),
        //     "letter" => array(0, 0, 612.00, 792.00),
        //     "legal" => array(0, 0, 612.00, 1008.00),
        //     "ledger" => array(0, 0, 1224.00, 792.00),
        //     "tabloid" => array(0, 0, 792.00, 1224.00),
        //     "executive" => array(0, 0, 521.86, 756.00),
        //     "folio" => array(0, 0, 612.00, 936.00),
        //     "commercial #10 envelope" => array(0, 0, 684, 297),
        //     "catalog #10 1/2 envelope" => array(0, 0, 648, 864),
        //     "8.5x11" => array(0, 0, 612.00, 792.00),
        //     "8.5x14" => array(0, 0, 612.00, 1008.0),
        //     "11x17" => array(0, 0, 792.00, 1224.00),
        // );
        
    }
    


}
