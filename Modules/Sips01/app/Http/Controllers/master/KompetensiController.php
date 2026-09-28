<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Bidang;
use Modules\Sips01\Models\Dataguru;
use Modules\Sips01\Models\Kompetensi;
use Modules\Sips01\Models\Program;
use Yajra\DataTables\Facades\DataTables;

class KompetensiController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Kompetensi Keahlian</b>.';
        $page = 'sips01::master.kompetensi';
        $link = '/sips01/master/kompetensi';
        $subtitle = 'Master';
        $caption = 'Kompetensi Keahlian';
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
            'tabel' => Kompetensi::SimplePaginate($jmlhal)->withQueryString(),
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

        $slug = Str::slug($request['kompetensi1']);


        $validatedData = $request->validate([
            'idprogram1' => 'required',
            'kode1' => 'required',
            'kompetensi1' => 'required',
        ]);

        $tampil = Kompetensi::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $logo = $item->logo;
        }
        
        if ($id == '0') {
            if ($request->hasFile('logo1')) {
                $validatelogo = $request->validate([
                    'logo1' => 'file|max:2048',
                ]);
                if ($validatelogo) {
                    $logo1 = $request->file('logo1')->store('Sips01-kompetensi-logo');
                } else {
                    $logo1 = '';
                }
            } else {
                $logo1 = '';
            }
            
        } else {
            if ($request->hasFile('logo1')) {
                $validatelogo = $request->validate([
                    'logo1' => 'file|max:2048',
                ]);
                if ($validatelogo) {
                    if ($logo) {
                        Storage::delete($logo);
                        $logo1 = $request->file('logo1')->store('Sips01-kompetensi-logo');
                    } else {
                        $logo1 = $request->file('logo1')->store('Sips01-kompetensi-logo');
                    }
                } else {
                    $logo1 = $logo;
                }
            } else {
                $logo1 = $logo;
            }
        }
        
        //untuk input tabel yang asli
        $data = [
            'idprogram' => $validatedData['idprogram1'],
            'kode' => $validatedData['kode1'],
            'slug' => $slug,
            'kompetensi' => $validatedData['kompetensi1'],
            'lama' => $request['lama1'],
            'kode2' => $request['kode21'],
            'iddataguru' => $request['iddataguru1'],
            'aktif' => $request['aktif1'],
            'materi' => $request['materi1'],
            'prestasi' => $request['prestasi1'],
            'profesi' => $request['profesi1'],
            'keterangan' => $request['keterangan1'],
            'logo' => $logo1,
        ];

        if ($id == '0') {
            Kompetensi::create($data);
        } else {
            Kompetensi::where('id', '=', $id)->update($data);
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
        $id = session('idprogram');
        $datax = Kompetensi::where('idprogram','=',$id)
            ->with(['program','dataguru'])
            ->orderBy('kode')
            ->get();
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('kakomli', function($row){
                    
                    return 'kakomli';
                })
                ->addColumn('logo', function ($row) {
                    return $row->logo ? '<img class="mb-4" style="width: 50px" src="'. route('front.index') . '/storage/'. $row->logo.'">' : '';
                })
                ->addColumn('materi', function ($row) {
                    return $row->materi ? '<a href="javascript:void(0)" title="Lihat Materi ' . $row->kompetensi . '" class="btn btn-info btn-sm item_materi" data1="' . $row->id . '" data2="'. $row->kompetensi.'" data3="'. $row->kode.'" data4="'. $row->materi.'"><i style="font-size:18px" class="bi bi-journal-text fs-6"></i></a> ' : '';
                })
                ->addColumn('prestasi', function ($row) {
                    return $row->prestasi ? '<a href="javascript:void(0)" title="Lihat Prestasi ' . $row->kompetensi . '" class="btn btn-info btn-sm item_prestasi" data1="' . $row->id . '" data2="'. $row->kompetensi.'" data3="'. $row->kode.'" data4="'. $row->prestasi.'"><i style="font-size:18px" class="bi bi-trophy fs-6"></i></a> ' : '';
                })
                ->addColumn('profesi', function ($row) {
                    return $row->profesi ? '<a href="javascript:void(0)" title="Lihat Profesi ' . $row->kompetensi . '" class="btn btn-info btn-sm item_profesi" data1="' . $row->id . '" data2="'. $row->kompetensi.'" data3="'. $row->kode.'" data4="'. $row->profesi.'"><i style="font-size:18px" class="bi bi-mortarboard-fill fs-6"></i></a> ' : '';
                })
                ->addColumn('keterangan', function ($row) {
                    return $row->keterangan ? '<a href="javascript:void(0)" title="Lihat Informasi ' . $row->kompetensi . '" class="btn btn-info btn-sm item_keterangan" data1="' . $row->id . '" data2="'. $row->kompetensi.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-info-circle fs-6"></i></a> ' : '';
                })
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->kompetensi.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->kompetensi.'" data3="'. $row->kode.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    'materi',
                    'prestasi',
                    'profesi',
                    'keterangan',
                    'logo',
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
        $data = Kompetensi::where('id', '=', $id)->get();
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
        $tampil = Kompetensi::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $logo = $item->logo;
        }

        if($logo){
            storage::delete($logo);
        }

        $data = Kompetensi::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    function listbidang()
    {
        $tampil = Bidang::orderBy('bidang', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->bidang . "(" . $baris->kode . ")</option>";
        }
    }
    
    function listprogram($id)
    {
        $data = Program::where('idbidang','=',$id)->orderBy('program', 'asc')->get();
        return json_encode(array('data' => $data));
    }
    
    function listdataguru()
    {
        $tampil = Dataguru::where([['idstatusprofesi','=',1],['aktif','=','Y']])->orderBy('nama', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->nama . "</option>";
        }
    }

    public function kirimsyarat(Request $request)
    {
        $idbidang = $request['idbidang1'];
        $idprogram = $request['idprogram1'];
        session([
            'idbidang' => $idbidang,
            'idprogram' => $idprogram,
        ]);
    }
}
