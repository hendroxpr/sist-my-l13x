<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Modules\Sips01\Models\Bulan;
use Modules\Sips01\Models\Tp;
use Yajra\DataTables\Facades\DataTables;

class BulanController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Bulan</b>.';
        $page = 'sips01::master.bulan';
        $link = '/sips01/master/bulan';
        $subtitle = 'Master';
        $caption = 'Bulan';
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
            'tabel' => Bulan::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $idtp = $request['idtp1'];

        $tampil = Tp::where('id', '=', $idtp)->get();
        foreach ($tampil as $baris) {
            $tp = $baris->tp;
        }

        $thn1 = substr($tp, 0, 4);
        $thn2 = substr($tp, -4, 4);

        $namabulanx =[' ', 'Juli ', 'Agustus ', 'September ', 'Oktober ', 'Nopember ', 'Desember ', 'Januari ', 'Februari ', 'Maret ', 'April ', 'Mei ', 'Juni '];
		$bulanx =[' ', '-07-', '-08-', '-09-', '-10-', '-11-', '-12-', '-01-', '-02-', '-03-', '-04-', '-05-', '-06-'];
		$tglakhirx =[' ', '31', '31', '30', '31', '30', '31', '31', '28', '31', '30', '31', '30'];
        
        $i = 1;    
        while($i <= 12) { 

            if (intval($thn2)%4==0){
                $x = intval(substr($bulanx[$i],1,2));
                if($x=='2'){
                    $tgl='29';
                }else{
                    $tgl = $tglakhirx[$i]; 
                }
            }else{
                $tgl = $tglakhirx[$i]; 
            }

            if($i<=6){
                $namabulan=$namabulanx[$i].$thn1;
                $thn=$thn1;
            }else{
                $namabulan=$namabulanx[$i].$thn2;
                $thn=$thn2;
            }

            $bulan = substr($bulanx[$i],1,2);
            $bln = $bulanx[$i];
            $tglawal = $thn . $bln . '01';
            $tglakhir = $thn . $bln . $tgl;
            
            $data = [
                'idtp' => $idtp,            
                'bulan' => $bulan,
                'namabulan' => $namabulan,
                'tglawal' => $tglawal,
                'tglakhir' => $tglakhir,
            ];
            Bulan::create($data);
            $i++;
        } 
        
        // return json_encode('data');
    }

    /**
     * Store a newly created resource in storage.
     * @return 
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
        $idtp = session('idtp');
        $datax = Bulan::where('idtp','=',$idtp)->with('tp')->get();
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->idtp.'" data3="'. $row->tglawal.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->idtp.'" data3="'. $row->tglawal.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
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
    public function edit($id)
    {
        $data = Bulan::where('id', '=', $id)->get();
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
        $data = Bulan::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    function listtp()
    {
        $tampil = Tp::orderBy('tp', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->tp . "</option>";
        }
    }

    public function kirimsyarat(Request $request)
    {
        $idtp = $request['idtp1'];
        session([
            'idtp' => $idtp,
        ]);
    }
}
