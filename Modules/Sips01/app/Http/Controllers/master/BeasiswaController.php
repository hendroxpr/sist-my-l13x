<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Beasiswa;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Tp;
use Yajra\DataTables\Facades\DataTables;

class BeasiswaController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Beasiswa</b>.';
        $page = 'sips01::master.beasiswa';
        $link = '/sips01/master/beasiswa';
        $subtitle = 'Master';
        $caption = 'Beasiswa';
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
            'tabel' => Beasiswa::SimplePaginate($jmlhal)->withQueryString(),
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
            'idtp1' => 'required',
            'idkelas1' => 'required',
            'iddatasiswa1' => 'required',
            'beasiswa1' => 'required',
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'idtp' => $validatedData['idtp1'],
            'idkelas' => $validatedData['idkelas1'],
            'iddatasiswa' => $validatedData['iddatasiswa1'],
            'beasiswa' => $validatedData['beasiswa1'],
            'nomor' => $request['nomor1'],
            'tanggal' => $request['tanggal1'],
            'dari' => $request['dari1'],
            'ttd' => $request['ttd1'],
            'keterangan' => $request['keterangan1'],
        ];
        
        if ($id == '0') {
            Beasiswa::create($data);
        } else {
            Beasiswa::where('id', '=', $id)->update($data);
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
        $idtp = session('idtp');
        $datax = Beasiswa::with(['tp','datasiswa','kelas'])->where('idtp','=',$idtp);
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->dari.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->dari.'" data4="'. $row->keterangan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
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
        $data = Beasiswa::where('id', '=', $id)->get();
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

    function listkelas($id)
    {
        $idkelas = Siswakelas::select('idkelas')->where('idtp','=',$id);
        $data = Kelas::whereIn('id',$idkelas)->orderBy('kelas', 'asc')->get();
        return json_encode(array('data' => $data));
    }
    function listdatasiswa($id)
    {
        $idtp = session('idtp');
        $iddatasiswa = Siswakelas::select('iddatasiswa')->where('idkelas','=',$id)->where('idtp','=',$idtp);
        $data = Datasiswa::whereIn('id',$iddatasiswa)->orderBy('namalengkap', 'asc')->get();
        return json_encode(array('data' => $data));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Beasiswa::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    public function kirimsyarat(Request $request)
    {
        session([
            'idtp' => $request['idtp1']
        ]);
    }

}
