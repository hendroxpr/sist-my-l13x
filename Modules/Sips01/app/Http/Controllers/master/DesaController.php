<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Desa;
use Modules\Sips01\Models\Kabupaten;
use Modules\Sips01\Models\Kecamatan;
use Modules\Sips01\Models\Propinsi;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Desa/Kelurahan</b>.';
        $page = 'sips01::master.desa';
        $link = '/sips01/master/desa';
        $subtitle = 'Master';
        $caption = 'Desa / Kelurahan';
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
            'tabel' => Desa::SimplePaginate($jmlhal)->withQueryString(),
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
        $idkecamatan = $request['idkecamatan1'];

        $slug = $idkecamatan.'-'.Str::slug($request['desa1']);

        $validatedData = $request->validate([
            'kode1' => 'required',
            'desa1' => 'required',
            'idkecamatan1' => 'required',
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'kode' => $validatedData['kode1'],
            'slug' => $slug,
            'desa' => $validatedData['desa1'],
            'idkecamatan' => $validatedData['idkecamatan1'],
            'inisial' => $request['inisial1'],
            'ibukota' => $request['ibukota1'],
        ];

        if ($id == '0') {
            Desa::create($data);
        } else {
            Desa::where('id', '=', $id)->update($data);
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
        $id = session('idkecamatan');
        $datax = Desa::where('idkecamatan','=',$id)->get();
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->desa.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->desa.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
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
        $data = Desa::where('id', '=', $id)->get();
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
        $data = Desa::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }
    
    function listpropinsi()
    {
        $tampil = Propinsi::orderBy('propinsi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->propinsi . "(" . $baris->kode . ")</option>";
        }
    }
    
    function listkabupaten($id)
    {
        $data = Kabupaten::where('idpropinsi', '=', $id)->get();
        return json_encode(array('data' => $data));
    }
    function listkecamatan($id)
    {
        $data = Kecamatan::where('idkabupaten', '=', $id)->get();
        return json_encode(array('data' => $data));
    }

    public function kirimsyarat(Request $request)
    {
        $idpropinsi = $request['idpropinsi1'];
        $idkabupaten = $request['idkabupaten1'];
        $idkecamatan = $request['idkecamatan1'];
        session([
            'idpropinsi' => $idpropinsi,
            'idkabupaten' => $idkabupaten,
            'idkecamatan' => $idkecamatan,
        ]);
    }

}
