<?php

namespace Modules\Sips01\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Tp;
use Yajra\DataTables\Facades\DataTables;

class NaikkelasController extends Controller
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
        $remark = 'Halaman ini digunakan untuk proses <b>Naik Kelas</b>.';
        $page = 'sips01::transaksi.naikkelas';
        $link = '/sips01/transaksi/naikkelas';
        $subtitle = 'Transaksi';
        $caption = 'Naik Kelas';
        $jmlhal = 2;


        $idtp = session('idtp');    
        $idkelas = session('idkelas');
        $idtp2 = session('idtp2');    
        $idkelas2 = session('idkelas2');

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

        if($idtp2==''){
            session(['idtp2' => 0]);            
        }else{
            session(['idtp2' => $idtp2]);
        }
        if($idkelas2==''){
            session(['idkelas2' => 0]);
        }else{
            session(['idkelas2' => $idkelas2]);
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
    public function show1(Request $request)
    {
        $idtp = session('idtp');    
        $idkelas = session('idkelas');
        $datasiswa = Datasiswa::select('id')->where('aktif','=','Y');
        $datax = Siswakelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])
            ->whereIn('iddatasiswa', $datasiswa)
            ->with(['datasiswa','tp','kelas']);

        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }
    }
    public function show2(Request $request)
    {
        $idtp = session('idtp2');    
        $idkelas = session('idkelas2');
        $datasiswa = Datasiswa::select('id')->where('aktif','=','Y');
        $datax = Siswakelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])
            ->whereIn('iddatasiswa', $datasiswa)
            ->with(['datasiswa','tp','kelas']);
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
   
    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    
    function listtp()
    {
        $tampil = Tp::orderBy('tp', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->tp . "</option>";
        }
    }
    
    function listkelas()
    {
        $tampil = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelas . "</option>";
        }
    }
   
    public function kirimsyarat(Request $request)
    {
        $tp2 = $request['tp2'];
        $tampil = Tp::where('tp','=',$tp2)->get();
        foreach ($tampil as $baris) {
            $idtp2 = $baris->id;
        }

        $idtp = $request['idtp1'];
        $idkelas = $request['idkelas1'];
        $idkelas2 = $request['idkelas2'];
        session([
            'idtp' => $idtp,
            'idkelas' => $idkelas,
            'idtp2' => $idtp2,
            'tp' => $tp2,
            'idkelas2' => $idkelas2,
        ]);
    }
    public function proses(Request $request)
    {
        $tp2 = $request['tp2'];
        $ambil = Tp::where('tp','=',$tp2)->get();
        foreach ($ambil as $baris) {
            $idtp2 = $baris->id;
        }
        $datasiswa = Datasiswa::select('id')->where('aktif','=','Y');
        $siswakelas2 = Siswakelas::select('iddatasiswa')->where([['idtp','=',$idtp2]]); 

        $tampil=Siswakelas::where([['idtp','=',$request['idtp1']],['idkelas','=',$request['idkelas1']]])
            ->whereIn('iddatasiswa', $datasiswa)
            ->whereNotIn('iddatasiswa', $siswakelas2)->get();        
        foreach ($tampil as $baris) {
            $data = [
                'iddatasiswa' => $baris->iddatasiswa,
                'idtp' => $idtp2,
                'idkelas' => $request['idkelas2'],                            
            ];
            Siswakelas::create($data);
        }
            
        
    }

}
