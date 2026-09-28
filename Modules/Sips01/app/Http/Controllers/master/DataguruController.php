<?php

namespace Modules\Sips01\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Modules\Sips01\Models\Agama;
use Modules\Sips01\Models\Dataguru;
use Modules\Sips01\Models\Desa;
use Modules\Sips01\Models\Jk;
use Modules\Sips01\Models\Kabupaten;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Pangkat;
use Modules\Sips01\Models\Pendidikan;
use Modules\Sips01\Models\Statuspegawai;
use Modules\Sips01\Models\Statusprofesi;
use Yajra\DataTables\Exports\DataTablesCollectionExport;
use Yajra\DataTables\Facades\DataTables;

class DataguruController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Data Guru</b>.';
        $page = 'sips01::master.dataguru';
        $link = '/sips01/master/dataguru';
        $subtitle = 'Master';
        $caption = 'Data Guru';
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
            'tabel' => Dataguru::SimplePaginate($jmlhal)->withQueryString(),
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

        $tampil = Dataguru::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $foto = $item->foto;            
        }

        if ($id == '0') {
            if ($request->hasFile('foto1')) {
                $validatefoto = $request->validate([
                    'foto1' => 'file|max:2048',
                ]);
                if ($validatefoto) {
                    $foto1 = $request->file('foto1')->store('Sips01-dataguru-foto');
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
                        $foto1 = $request->file('foto1')->store('Sips01-dataguru-foto');
                    } else {
                        $foto1 = $request->file('foto1')->store('Sips01-dataguru-foto');
                    }
                } else {
                    $foto1 = $foto;
                }
            } else {
                $foto1 = $foto;
            }
        }

        $validatedData = $request->validate([
            'nama1' => 'required',
            'ecard1' => 'required',
            'nip1' => 'required',
            'nuptk1' => 'required',
        ]);
          
        //untuk input tabel yang asli
        $data = [
            //identitas
            'nama' => $validatedData['nama1'],
            'ecard' => $validatedData['ecard1'],
            'nip' => $validatedData['nip1'],
            'nuptk' => $validatedData['nuptk1'],
            'idpangkat' => $request['idpangkat1'],
            'idstatusprofesi' => $request['idstatusprofesi1'],
            'jabatan' => $request['jabatan1'],
            'jabatan2' => $request['jabatan21'],
            'idstatuspegawai' => $request['idstatuspegawai1'],
            //datadiri
            'idpendidikan' => $request['idpendidikan1'],
            'jurusan' => $request['jurusan1'],
            'idjk' => $request['idjk1'],
            'idagama' => $request['idagama1'],
            'idtempatlahir' => $request['idtempatlahir1'],
            'tgllahir' => $request['tgllahir1'],
            'alamat' => $request['alamat1'],
            'telp' => $request['telp1'],
            //sosialmedia
            'email' => $request['email1'],
            'wa' => $request['wa1'],
            'twitter' => $request['twitter1'],
            'facebook' => $request['facebook1'],
            'ig' => $request['ig1'],
            'line' => $request['line1'],
            'web' => $request['web1'],
            'blog' => $request['blog1'],
            //lain-lain
            'tglmasuk' => $request['tglmasuk1'],
            'tglkeluar' => $request['tglkeluar1'],
            'aktif' => $request['aktif1'],
            'keterangan' => $request['keterangan1'],
            //image
            'foto' => $foto1,
        ];

        if ($id == '0') {
            Dataguru::create($data);
        } else {
            Dataguru::where('id', '=', $id)->update($data);
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

        $datax = Dataguru::with(['tempatlahir','pendidikan','statuspegawai','jk','agama','pangkat','statusprofesi'])
            ->get();
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                ->addColumn('foto', function ($row) {
                    return $row->foto ? '<img class="mb-4" style="width: 50px" src="'. route('front.index') . '/storage/'. $row->foto.'">' : '';
                })
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->nama.'" data3="'. $row->nip.'" data4="'. $row->nuptk.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->nama.'" data3="'. $row->nip.'" data4="'. $row->nuptk.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    'foto',  
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }
    }

    public function showkabupaten(Request $request)
    {
        $datax = Kabupaten::with('propinsi')
            ->orderBy('idpropinsi', 'asc')
            ->orderBy('kabupaten', 'asc')
            ->get();
        
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                ->addColumn('kode', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kode . '" class="text-decoration-none  text-body item_carikode" data1="'. $row->id.'">' . $row->kode . '</a>';    
                    return $hasil;
                })
                ->addColumn('kabupaten', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kabupaten . '" class="text-decoration-none  text-body item_carikabupaten" data1="'. $row->id.'">' . $row->kabupaten . '</a>';    
                    return $hasil;
                })
                ->addColumn('propinsi', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->propinsi->propinsi . '" class="text-decoration-none  text-body item_caripropinsi" data1="'. $row->id.'">' . $row->propinsi->propinsi . '</a>';    
                    return $hasil;
                })
                
                ->rawColumns([
                    'kode',  
                    'kabupaten',
                    'propinsi',
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
        $data = Dataguru::where('id', '=', $id)->get();
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
        $tampil = Dataguru::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $foto = $item->foto;            
        }

        if ($foto) {
            storage::delete($foto);            
        }
       
        $data = Dataguru::where([['id', '=', $id], ['id', '<>', 1]])->delete();
        return json_encode(array('data' => $data));
    }

    function listpangkat()
    {
        $tampil = Pangkat::orderBy('pangkat', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->pangkat . "</option>";
        }
    }
    function liststatusprofesi()
    {
        $tampil = Statusprofesi::orderBy('statusprofesi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->statusprofesi . "</option>";
        }
    }
    function liststatuspegawai()
    {
        $tampil = Statuspegawai::orderBy('statuspegawai', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->statuspegawai . "</option>";
        }
    }
    function listpendidikan()
    {
        $tampil = Pendidikan::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->pendidikan . "</option>";
        }
    }
    function listjk()
    {
        $tampil = Jk::orderBy('jk', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->jk . "</option>";
        }
    }
    function listagama()
    {
        $tampil = Agama::orderBy('id', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->agama . "</option>";
        }
    }
    function listtempatlahir()
    {
        $tampil = Kabupaten::with('propinsi')->orderBy('kabupaten', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>". $baris->kabupaten . " - " . $baris->propinsi->propinsi . "</option>";
        }
    }

    function listkelas()
    {
        $tampil = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelas . "</option>";
        }
    }

}
