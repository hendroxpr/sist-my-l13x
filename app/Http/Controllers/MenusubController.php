<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Menusub;
use App\Models\Menuutama;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MenusubController extends Controller
{
    public function index()
    {
        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Sub Menu</b>.';
        $page = 'admin.dashboards.menusub';
        $link = '/admin/menusub';
        $subtitle = 'Setting Menu';
        $caption = 'Sub Menu';
        $jmlhal = 2;

        return view($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Menusub::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get()
        ]);
    }

    public function show(Request $request)
    {
        $idmenuutama = session('idmenuutama');
        $idaplikasi = session('idaplikasi');

        if ($request->ajax()) {
            $datax = Menusub::where([['idaplikasi', '=', $idaplikasi], ['idmainmenu', '=', $idmenuutama]])
            ->orderBy('slug', 'asc')
            ->orderBy('urutan', 'asc')
            ->get();

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
        $id1a = $request['idaplikasi1'];
        $id1b = $request['idmenuutama1'];
        if ($id1a < 10) {
            $id1a = '0' . $id1a;
        }
        if ($id1b < 10) {
            $id1b = '0' . $id1b;
        }

        $namamenu = $request['menu1'];

        $slug = $id1a . '-' . $id1b . '-' .  Str::slug($request['menu1']);

        $validatedData = $request->validate([
            'idaplikasi1' => 'required',
            'idmenuutama1' => 'required',
            'menu1' => 'required',
            'aktif1' => 'required',
            'admin1' => 'required',
            'user1' => 'required',
            'entry1' => 'required',
        ]);
        
        //untuk input tabel menusub yang asli
        $data = [
            'link' => $request['link1'],
            'idaplikasi' => $validatedData['idaplikasi1'],
            'idmainmenu' => $validatedData['idmenuutama1'],
            'namamenu' => $namamenu,
            'slug' => $slug,
            'aktif' => $validatedData['aktif1'],
            'adminmenu' => $validatedData['admin1'],
            'usermenu' => $validatedData['user1'],
            'entrymenu' => $validatedData['entry1'],
            'urutan' => $request['urutan1']
        ];

        if ($id == '0') {
            Menusub::create($data);
        } else {
            Menusub::where('id', '=', $id)->update($data);
        }
        return json_encode('data');
    }

    public function edit($id)
    {
        $data = Menusub::where('id', '=', $id)->get();
        return json_encode(array('data' => $data));
    }

    public function destroy($id)
    {
        $data = Menusub::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }

    function listaplikasi()
    {
        $idaplikasi1 = auth()->user()->kunci1;
        $idaplikasi2 = auth()->user()->kunci2;
        $tampil = Aplikasi::where([['id', '>=', $idaplikasi1], ['id', '<=', $idaplikasi2]])
            ->orderBy('urutan', 'asc')->get();

        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->aplikasi . "</option>";
        }
    }

    function listmenuutama()
    {
        $tampil = Menuutama::orderBy('urutan', 'asc')->get();

        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->namamenu . "</option>";
        }
    }

    public function kirimsyarat(Request $request)
    {
        $idmenuutama = $request['idmenuutama1'];
        $idaplikasi = $request['idaplikasi1'];
        session([
            'idmenuutama' => $idmenuutama,
            'idaplikasi' => $idaplikasi,
        ]);
    }
}