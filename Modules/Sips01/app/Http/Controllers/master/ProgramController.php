<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Bidang;
use Modules\Sips01\Models\Program;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Program Keahlian</b>.';
        $page = 'sips01::master.program';
        $link = '/sips01/master/program';
        $subtitle = 'Master';
        $caption = 'Program Keahlian';
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
            'tabel' => Program::SimplePaginate($jmlhal)->withQueryString(),
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

        $slug = Str::slug($request['program1']);

        $validatedData = $request->validate([
            'idbidang1' => 'required',
            'kode1' => 'required',
            'program1' => 'required',
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'idbidang' => $validatedData['idbidang1'],
            'kode' => $validatedData['kode1'],
            'slug' => $slug,
            'program' => $validatedData['program1'],
            'urutan' => $request['urutan1'],
            'keterangan' => $request['keterangan1'],
        ];

        if ($id == '0') {
            Program::create($data);
        } else {
            Program::where('id', '=', $id)->update($data);
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
        $idbidang = session('idbidang');
        $datax = Program::where('idbidang','=',$idbidang)->with('bidang')
        ->orderBy('urutan','asc')       
        ->get();

        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->program.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->program.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
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
        $data = Program::where('id', '=', $id)->get();
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
        $data = Program::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    function listbidang()
    {
        $tampil = Bidang::orderBy('bidang', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->bidang . "(" . $baris->kode . ")</option>";
        }
    }

    public function kirimsyarat(Request $request)
    {
        $idbidang = $request['idbidang1'];
        session([
            'idbidang' => $idbidang,
        ]);
    }


}
