<?php

namespace Modules\Evot01\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Evot01\Models\Kandidat;
use Yajra\DataTables\Facades\DataTables;

class KandidatController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Kandidat</b>.';
        $page = 'evot01::master.kandidat';
        $link = '/evot01/master/kandidat';
        $subtitle = 'Master';
        $caption = 'Kandidat';
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
            'tabel' => Kandidat::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }

    /**
     * create or update data
     */
    public function create(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $id = $request['id1'];
        
        $validatedData = $request->validate([
            'nomor1' => 'required',
            'nama1' => 'required',
        ]);

        $tampil = Kandidat::where('id', '=', $id)->get();
        foreach ($tampil as $item) {                        
            $foto = $item->foto;            
        }
        
        if ($id == '0') {
            if ($request->hasFile('foto1')) {
                $validatefoto = $request->validate([
                    'foto1' => 'file|max:2048',
                ]);
                if ($validatefoto) {
                    $foto1 = $request->file('foto1')->store('evot01-kandidat-foto');
                } else {
                    $foto1 = '';
                }
            } else {
                $foto1 = '';
            }
            
        } else {
            
            if ($request->hasFile('foto1')) {
                $validatefoto = $request->validate([
                    'foto1' => 'file|max:2048',
                ]);
                if ($validatefoto) {
                    if ($foto) {
                        Storage::delete($foto);
                        $foto1 = $request->file('foto1')->store('evot01-kandidat-foto');
                    } else {
                        $foto1 = $request->file('foto1')->store('evot01-kandidat-foto');
                    }
                } else {
                    $foto1 = $foto;
                }
            } else {
                $foto1 = $foto;
            }
        }
         
        //untuk input tabel yang asli
        $data = [
            'nomor' => $validatedData['nomor1'],
            'nama' => $validatedData['nama1'],
            'semboyan' => $request['semboyan1'],
            'visi' => $request['visi1'],
            'misi' => $request['misi1'],
            'foto' => $foto1,
        ];

        if ($id == '0') {
            Kandidat::create($data);
        } else {
            Kandidat::where('id', '=', $id)->update($data);
        }
       
        return json_encode('data');
    }

    /**
     */
    public function store(Request $request)
    {
        //
    }

    /**
     */
    public function show()
    {
        
        $datax = DataTables::of(
            Kandidat::orderBy('nomor','asc')
                ->with([
                     
                ])
            );

        $data = $datax
        ->addIndexColumn()
        
        ->addColumn('foto', function ($row) {
            return $row->foto ? '<img class="mb-4" style="width: 100px" src="'. route('front.index') . '/storage/'. $row->foto.'">' : '';
        })

        ->addColumn('action', function ($row) {
            return '<a href="#" title="Edit Data" class="btn btn-success btn-xs item_edit" data1="' . $row->id . '" data2="'. $row->nama.'" data3="'. $row->nomor.'" data4="'. $row->semboyan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                    '<a href="#" title="Hapus Data" class="btn btn-danger btn-xs item_destroy" data1="' . $row->id . '" data2="'. $row->nama.'" data3="'. $row->nomor.'" data4="'. $row->semboyan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
        })

        ->addColumn('visix', function ($row) {
            return '<a href="#" title="Visi ' . $row->nama . '" class="btn btn-success btn-xs item_visi" data1="' . $row->id . '" data2="'. $row->visi.'" data3="'. $row->nomor.'" data4="'. $row->visi.'"><i style="font-size:18px" class="bi bi-eye fs-6"></i></a> ';
                    
        })
        ->addColumn('misix', function ($row) {
            return '<a href="#" title="Misi ' . $row->nama . '" class="btn btn-success btn-xs item_misi" data1="' . $row->id . '" data2="'. $row->misi.'" data3="'. $row->nomor.'" data4="'. $row->misi.'"><i style="font-size:18px" class="bi bi-eye fs-6"></i></a> ';
                    
        })
        
        ->rawColumns([
            'foto','action','visix','misix'
            ])


        ->make(true);

        return $data;
    }

    /**
     */
    public function edit($id)
    {
        $data = Kandidat::where('id', '=', $id)->get();
        return response()->json(['data' => $data]); 
    }

    /**
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     */
    public function destroy($id)
    {
        $tampil = Kandidat::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $foto = $item->foto;
        }

        if($foto){
            storage::delete($foto);
        }

        $data = Kandidat::where('id', '=', $id)->delete();

        return json_encode(array('data' => $data));
    }

    
}
