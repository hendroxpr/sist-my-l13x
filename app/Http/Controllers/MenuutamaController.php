<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Menuutama;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MenuutamaController extends Controller
{
    public function index()
    {

        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Menu Utama</b>.';
        $page = 'admin.dashboards.menuutama';
        $link = '/admin/menuutama';
        $subtitle = 'Setting Menu';
        $caption = 'Menu Utama';
        $jmlhal = 2;

        return view($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Menuutama::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get()
        ]);
    }

    public function show(Request $request)
    {
        // $data = Menuutama::get();
        // return json_encode(array('data' => $data));
        
        if ($request->ajax()) {
            $datax = Menuutama::get();
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->namamenu.'" data3="'. $row->aktif.'" data4="'. $row->urutan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->namamenu.'" data3="'. $row->aktif.'" data4="'. $row->urutan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }
             

    }

    public function create(Request $request)
    {
        $id = $request['id1'];

        $namamenu = $request['menu1'];
        $slug = Str::slug($request['menu1']);

        $validatedData = $request->validate([
            'menu1' => 'required',
            'aktif1' => 'required',
            'admin1' => 'required',
            'user1' => 'required',
            'entry1' => 'required',
        ]);

        //untuk input tabel MAINMENU yang asli
        $data = [
            'namamenu' => $namamenu,
            'slug' => $slug,
            'aktif' => $validatedData['aktif1'],
            'adminmenu' => $validatedData['admin1'],
            'usermenu' => $validatedData['user1'],
            'entrymenu' => $validatedData['entry1'],
            'urutan' => $request['urutan1']
        ];

        if ($id == '0') {
            Menuutama::create($data);
        } else {
            Menuutama::where('id', '=', $id)->update($data);
        }
        return json_encode('data');
    }

    public function edit($id)
    {
        $data = Menuutama::where('id', '=', $id)->get();
        return json_encode(array('data' => $data));
    }

    public function destroy($id)
    {
        $data = Menuutama::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }
}
