<?php

namespace Modules\Evot01\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Modules\Evot01\Models\Periode;
use Yajra\DataTables\Facades\DataTables;

class PeriodeController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Periode EVot</b>.';
        $page = 'evot01::master.periode';
        $link = '/evot01/master/periode';
        $subtitle = 'Master';
        $caption = 'Periode EVot';
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
            'tabel' => Periode::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }
 
    /**
     */
   
    public function create(Request $request)
    {
        $id = $request['id1'];

        $validatedData = $request->validate([
            'tahun1' => 'required',
            'tanggal1' => 'required',
            'namavote1' => 'required',
        ]);
          
        //untuk input tabel yang asli
        $data = [            
            'tahun' => $validatedData['tahun1'],
            'tanggal' => $validatedData['tanggal1'],
            'namavote' => $validatedData['namavote1'],
            
        ];

        if ($id == '0') {
            Periode::create($data);
        } else {
            Periode::where('id', '=', $id)->update($data);
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

        $datax = Periode::get();
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function ($row) {
                return '<a href="#" title="Edit Data" class="btn btn-success btn-xs item_edit" data1="' . $row->id . '" data2="'. $row->namavote.'" data3="'. $row->tanggal.'" data4="'. $row->tahun.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="#" title="Hapus Data" class="btn btn-danger btn-xs item_destroy" data1="' . $row->id . '" data2="'. $row->namavote.'" data3="'. $row->tanggal.'" data4="'. $row->tahun.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';                
                })
                ->rawColumns([
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }

    }

    
    public function edit($id)
    {
        $data = Periode::where('id', $id)->first(); 
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // 
    }

    /**
     */
    public function destroy($id)
    {
        $data = Periode::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

}
