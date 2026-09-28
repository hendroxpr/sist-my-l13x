<?php

namespace Modules\Evot01\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Evot01\Imports\PemilihImport;
use Modules\Evot01\Models\Pemilih;
use Yajra\DataTables\Facades\DataTables;

class PemilihController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Daftar Pemilih</b>.';
        $page = 'evot01::master.pemilih';
        $link = '/evot01/master/pemilih';
        $subtitle = 'Master';
        $caption = 'Daftar Pemilih';
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
            'tabel' => Pemilih::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }
 
    /**
     */
   
     public function importData(Request $request)
    {
        if ($request->hasFile('file1x')) {
             $validateFile = $request->validate([
                'file1x' => 'required|mimes:xlsx,xls,csv|max:2048', // Sesuai dengan formData.append('file1x', file1x)
            ]);
            
            if($validateFile){
                try{
                    //lokasi excel sementara
                    $filex = $request->file('file1x')->store('evot01-pemilih-excel');
                    //import data excel dan simpan datanya ke model pemilih.php  
                    Excel::import(new PemilihImport(), $filex);
                    //delete excel
                    Storage::delete($filex);
                    //update pemilih

                } catch (\Exception $e) {
                    // Kirim response JSON gagal jika terjadi error database/format file
                    return response()->json([
                        'success' => false,
                        'message' => 'Gagal melakukan import: ' . $e->getMessage()
                    ], 500);
                }
            }
        }
    }

    public function create(Request $request)
    {
        $id = $request['id1'];

        $validatedData = $request->validate([
            'nama1' => 'required',
            'users1' => 'required',
            'passwords1' => 'required',
        ]);
          
        //untuk input tabel yang asli
        $data = [            
            'nama' => $validatedData['nama1'],
            'users' => $validatedData['users1'],
            'passwords' => $validatedData['passwords1'],
            'kelas' => $request['kelas1'],            
        ];

        if ($id == '0') {
            Pemilih::create($data);
        } else {
            Pemilih::where('id', '=', $id)->update($data);
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
            Pemilih::orderBy('kelas','asc')                
            );

        $data = $datax
            ->addIndexColumn()

            ->addColumn('statusx', function ($row) {
                $pilihx = $row->pilihan;
                if ($pilihx==0){
                    return '<button type="button" class="btn bg-warning rounded-100">' . $row->status . '</button> ';
                }else{
                    return '<button type="button" class="btn bg-success rounded-100">' . $row->status . '</button> ';
                }
                       
            })
            ->addColumn('action', function ($row) {
                return '<a href="#" title="Edit Data" class="btn btn-success btn-xs item_edit" data1="' . $row->id . '" data2="'. $row->nama.'" data3="'. $row->users.'" data4="'. $row->passwords.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="#" title="Hapus Data" class="btn btn-danger btn-xs item_destroy" data1="' . $row->id . '" data2="'. $row->nama.'" data3="'. $row->users.'" data4="'. $row->passwords.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
            })

            ->rawColumns([
                'action','statusx'
                ])

            ->make(true);

            return $data;

    }

    
    public function edit($id)
    {
        $data = Pemilih::where('id', '=', $id)->get();
        return json_encode(array('data' => $data));      

    }

    /**
     */
    public function update(Request $request)
    {
        // 
    }

    /**
     */
    public function destroy($id)
    {
        $data = Pemilih::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }
    public function destroyall($id)
    {
        $data =  Pemilih::where('id', '>', $id)->delete();
        return json_encode(array('data' => $data));
    }

}
