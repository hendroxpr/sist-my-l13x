<?php

namespace Modules\Sips01\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Kelompokmapel;
use Modules\Sips01\Models\Mapel;
use Yajra\DataTables\Facades\DataTables;

class MapelController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Mata Pelajaran</b>.';
        $page = 'sips01::master.mapel';
        $link = '/sips01/master/mapel';
        $subtitle = 'Master';
        $caption = 'Mata Pelajaran';
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
            'tabel' => Mapel::SimplePaginate($jmlhal)->withQueryString(),
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

        $slug = Str::slug($request['mapel1']);

        $validatedData = $request->validate([
            'kode1' => 'required',
            'mapel1' => 'required',
            'idkelompokmapel1' => 'required',
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'kode' => $validatedData['kode1'],
            'slug' => $slug,
            'mapel' => $validatedData['mapel1'],
            'idkelompokmapel' => $validatedData['idkelompokmapel1'],
            'keterangan' => $request['keterangan1'],
            'urutan' => $request['urutan1'],
        ];
        
        if ($id == '0') {
            Mapel::create($data);
        } else {
            Mapel::where('id', '=', $id)->update($data);
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
        $datax = Mapel::with('kelompokmapel')->orderBy('idkelompokmapel','asc')->orderBy('kode','asc');
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->mapel.'" data3="'. $row->kode.'" data4="'. $row->idkelompokmapel.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->mapel.'" data3="'. $row->kode.'" data4="'. $row->idkelompokmapel.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
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
        $data = Mapel::where('id', '=', $id)->get();
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
        $data = Mapel::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    function listkelompokmapel()
    {
        $tampil = Kelompokmapel::orderBy('urutan', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelompokmapel . "(" . $baris->kode . ")</option>";
        }
    }



}

