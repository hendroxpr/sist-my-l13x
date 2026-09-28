<?php

namespace Modules\Sips01\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Alasankeluar;
use Modules\Sips01\Models\Alasansetelahkeluar;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Tp;
use Modules\Sips01\Models\Walikelas;
use Yajra\DataTables\Facades\DataTables;

class SiswakeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // $product = new Product;
        // $product->setConnection('mysql_second');
        // $something = $product->find(1);
        // return $something;

        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk merubah <b>Siswa Keluar/Lulus</b>.';
        $page = 'sips01::transaksi.siswakeluar';
        $link = '/sips01/transaksi/siswakeluar';
        $subtitle = 'Transaksi';
        $caption = 'Siswa Keluar';
        $jmlhal = 2;

        $idtp = session('idtp');    
        $idkelas = session('idkelas');

        if($idtp==''){
            session(['idtp' => 0]);            
        }else{
            session(['idtp' => $idtp]);
        }
        if($idkelas==''){
            session(['idkelas' => 0]);
        }else{
            session(['idkelas' => $idkelas]);
        }

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
            'tabel' => Siswakelas::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */

    
    public function create(Request $request)
    {
        $id = $request['id1'];
        $idtp = $request['idtp1'];
        $idkelas = $request['idkelas1'];

        $iddatasiswa = Siswakelas::select('iddatasiswa')
            ->where('idtp','=',$idtp)
            ->where('idkelas','=',$idkelas);
        
        //untuk input tabel yang asli
        $data = [
            'idtpkeluar' => $request['idtpkeluar1'],
            'tglkeluar' => $request['tglkeluar1'],
            'idalasankeluar' => $request['idalasankeluar1'],
            'idalasansetelahkeluar' => $request['idalasansetelahkeluar1'],
            'aktif' => $request['aktif1'],
            'nomorijasahlulus' => $request['nomorijasahlulus1'],
            'tglijasahlulus' => $request['tglijasahlulus1'],
            'nomorskhunlulus' => $request['nomorskhunlulus1'],
            'tglskhunlulus' => $request['tglskhunlulus1'],
            'keteranganlulus' => $request['keteranganlulus1'],
            //selesai1
            'sekolahlanjut' => $request['sekolahlanjut1'],
            'jurusanlanjut' => $request['jurusanlanjut1'],
            'kerjadi' => $request['kerjadi1'],
            'tglmulaikerja' => $request['tglmulaikerja1'],
            'namaperusahaan' => $request['namaperusahaan1'],
            'penghasilankerja' => $request['penghasilankerja1'],
            
        ];

        if ($id == '0') {
            Datasiswa::whereIn('id',$iddatasiswa)->update($data);
        } else {
            Datasiswa::where('id', '=', $id)->update($data);
        }

        return json_encode($data);
    }
   
    /**
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

        $id = session('idtp');
        $idkelas = session('idkelas');
        $datax = Siswakelas::with(['tp','kelas','datasiswa'])
        ->where('idtp','=',$id)
        ->where('idkelas','=',$idkelas);
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                ->addColumn('tpmasuk', function($row){
                    return $row->datasiswa->idtpmasuk ? $row->datasiswa->tpmasuk->tp : '';
                })
                ->addColumn('tpkeluar', function($row){
                    return ($row->datasiswa->aktif =='N') ? ($row->datasiswa->idtpkeluar ? $row->datasiswa->tpkeluar->tp : '' ) : '';
                })
                ->addColumn('alasankeluar', function($row){
                    return ($row->datasiswa->aktif =='N') ? ($row->datasiswa->idalasankeluar ? $row->datasiswa->alasankeluar->alasankeluar : '' ) : '';
                })
                ->addColumn('alasansetelahkeluar', function($row){
                    return ($row->datasiswa->aktif =='N') ? ($row->datasiswa->idalasansetelahkeluar ? $row->datasiswa->alasansetelahkeluar->alasansetelahkeluar : '' ) : '';
                })
                ->addColumn('penghasilankerja', function($row){
                    if($row->datasiswa->namaperusahaan){
                        $penghasilankerja = number_format($row->datasiswa->penghasilankerja, 2, ',', '.');
                    }else{
                        $penghasilankerja = '';
                    }
                    return $penghasilankerja;
                })

                ->addColumn('action', function($row){
                    return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->iddatasiswa . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a>';
                })

                ->rawColumns([
                    'tpmasuk',
                    'tpkeluar',
                    'alasankeluar',
                    'alasansetelahkeluar',
                    'penghasilankerja',
                    'action',
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

    function listtp()
    {
        $tampil = Tp::orderBy('tp', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->tp . "</option>";
        }
    }
    
    function listkelas()
    {
        $tampil = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelas . "</option>";
        }
    }
    function listalasankeluar()
    {
        $tampil = Alasankeluar::get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->alasankeluar . "</option>";
        }
    }
    function listalasansetelahkeluar()
    {
        $tampil = Alasansetelahkeluar::get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->alasansetelahkeluar . "</option>";
        }
    }
    function showwalikelas()
    {
        $idtp = session('idtp');    
        $idkelas = session('idkelas');

        if($idtp==''){
            $idtp=0;
        }else{
            $idtp = session('idtp');
        }
        if($idkelas==''){
            $idkelas=0;
        }else{
            $idkelas = session('idkelas');
        }
        
        $data = Walikelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])->with(['tp','kelas','dataguru'])->get();
        return json_encode(array('data' => $data));
        
    }

    public function kirimsyarat(Request $request)
    {
        $idtp = $request['idtp1'];
        $idkelas = $request['idkelas1'];

        session([
            'idtp' => $idtp,
            'idkelas' => $idkelas,
        ]);
    }
    

    

}
