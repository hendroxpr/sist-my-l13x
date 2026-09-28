<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Modules\Sips01\Models\Tp;
use Yajra\DataTables\Facades\DataTables;

class TpController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Tahun Pelajaran</b>.';
        $page = 'sips01::master.tp';
        $link = '/sips01/master/tp';
        $subtitle = 'Master';
        $caption = 'Tahun Pelajaran';
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
            'tabel' => Tp::SimplePaginate($jmlhal)->withQueryString(),
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

        $validatedData = $request->validate([
            'tp1' => 'required',
            'tglawal1' => 'required',
            'tglakhir1' => 'required',
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'tp' => $validatedData['tp1'],
            'tglawal' => $validatedData['tglawal1'],
            'tglakhir' => $validatedData['tglakhir1'],
            'keterangan' => $request['keterangan1'],
        ];

        if ($id == '0') {
            Tp::create($data);
        } else {
            Tp::where('id', '=', $id)->update($data);
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
        $datax = Tp::get();
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->tp.'" data3="'. $row->tglawal.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->tp.'" data3="'. $row->tglawal.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
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
        $data = Tp::where('id', '=', $id)->get();
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
        $data = Tp::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }
}
