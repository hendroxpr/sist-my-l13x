<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    public function index()
    {

        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Manajemen User</b>.';
        $page = 'admin.dashboards.users';
        $link = '/admin/users';
        $subtitle = 'Setting Web';
        $caption = 'Manajemen User';
        $jmlhal = 2;

        return view($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Users::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
        ]);
    }

    public function show(Request $request)
    {
        $levels = auth()->user()->levels;
        if ($levels == 1) {
            $id1 = auth()->user()->id;
            $id2 = 99999999;
        } else {
            $id1 = auth()->user()->id;
            $id2 = auth()->user()->id;
        }

        $idaplikasi1 = auth()->user()->kunci1;
        $idaplikasi2 = auth()->user()->kunci2;
       
        if ($request->ajax()) {
            $datax = Users::with('aplikasi')
            ->where([['users.id', '>=', $id1], ['users.id', '<=', $id2]])
            ->where([['users.kunci1', '>=', $idaplikasi1], ['users.kunci2', '<=', $idaplikasi2]])
            ->orderBy('name','asc')
            ->get();
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                ->addColumn('aplikasi', function($row){
                    $kunci1 = $row->kunci1;
                    $kunci2 = $row->kunci2;
                    $tampil = Aplikasi::where('id','=',$kunci1)->get();
                    foreach ($tampil as $item) {
                        $apl = $item->aplikasi;
                    }
                    if($kunci1==$kunci2){
                        $hasil = $apl;
                    }else{
                        $hasil = 'Semua Aplikasi';
                    }
                    return $hasil;
                })
                ->addColumn('levels', function($row){
                    $levelx = $row->levels;
                    if($levelx=='1'){
                        $hasil = 'Admin';
                    }else if($levelx=='2'){
                        $hasil = 'User';
                    }else{
                        $hasil = 'Entry';
                    }
                    return $hasil;
                })
                ->addColumn('foto', function ($row) {
                    return $row->foto ? '<img class="mb-4" style="width: 100%" src="'. route('front.index') . '/storage/'. $row->foto.'">' : '';
                })
                ->addColumn('action', function($row){
                    $levels = auth()->user()->levels;
                    if($levels=='1'){
                        $aksi = '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->name.'" data3="'. $row->email.'" data4="'. $row->status.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                           '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->name.'" data3="'. $row->email.'" data4="'. $row->status.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    }else{
                        $aksi = '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->name.'" data3="'. $row->email.'" data4="'. $row->status.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a>'; 
                    }
                    return $aksi;
                })
                ->rawColumns([
                    'aplikasi',
                    'levels',
                    'foto',
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }
             

    }

    public function create(Request $request)
    {
        $id = $request['id1'];

        $tampil = Users::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $foto = $item->foto;
            $created_at = $item->created_at;
            $password = $item->password;
            $kunci1 = $item->kunci1;
            $kunci2 = $item->kunci2;
        }

        if ($id == '0') {
            $idaplikasi1 = $request['idaplikasi1'];
            $idaplikasi2 = $request['idaplikasi1'];
        } else {
            $idaplikasi1 = $kunci1;
            $idaplikasi2 = $kunci2;
        }

        $name1 = $request['name1'];
        $slug1 = Str::slug($request['name1']);
        $request['email1'] = Str::lower($request['email1']);
        $request['slug1'] = $slug1;

        if ($id == '0') {
            if ($request->hasFile('foto1')) {
                $validatefoto = $request->validate([
                    'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
                if ($validatefoto) {
                    $foto1 = $request->file('foto1')->store('admin-users-foto');
                } else {
                    $foto1 = '';
                }
            } else {
                $foto1 = '';
            }

            $validatedData = $request->validate([
                'slug1' => 'required|min:3|max:255|unique:users,slug',
                'email1' => 'required|min:3|max:255|unique:users,email',
                'password1' => 'required|min:3|max:255',
                'levels1' => 'required',
            ]);
            $email_verified_at1 = Carbon::now();
            $created_at1 = Carbon::now();
            $updated_at1 = Carbon::now();
            $password1 = Hash::make($validatedData['password1']);
        } else {
            if ($request->hasFile('foto1')) {
                $validatefoto = $request->validate([
                    'foto1' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                ]);
                if ($validatefoto) {
                    if ($foto) {
                        Storage::delete($foto);
                        $foto1 = $request->file('foto1')->store('admin-users-foto');
                    } else {
                        $foto1 = $request->file('foto1')->store('admin-users-foto');
                    }
                } else {
                    $foto1 = $foto;
                }
            } else {
                $foto1 = $foto;
            }

            $validatedData = $request->validate([
                'slug1' => 'required|min:3|max:255|unique:users,slug,' . $id,
                'email1' => 'required|min:3|max:255|unique:users,email,' . $id,
                'levels1' => 'required',
            ]);
            $email_verified_at1 = Carbon::now();
            $created_at1 = $created_at;
            $updated_at1 = Carbon::now();

            if ($request['password1']) {
                $password1 = Hash::make($request['password1']);
            } else {
                $password1 = $password;
            }
        }

        //untuk input users
        $data = [
            'name' => $name1,
            'slug' => $slug1,
            'email' => $validatedData['email1'],
            'email_verified_at' => $email_verified_at1,
            'password' => $password1,
            'namadepan' => $request['namadepan1'],
            'namatengah' => $request['namatengah1'],
            'namabelakang' => $request['namabelakang1'],
            'created_at' => $created_at1,
            'updated_at' => $updated_at1,
            'levels' => $validatedData['levels1'],
            'countdown' => $request['countdown1'],
            'foto' => $foto1,
            'kunci1' => $idaplikasi1,
            'kunci2' => $idaplikasi2,
            'blokir' => $request['blokir1'],
            'status' => $request['status1'],
        ];

        if ($id == '0') {
            Users::create($data);
        } else {
            Users::where('id', '=', $id)->update($data);
        }
        return json_encode('data');
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

    public function edit($id)
    {
        $data = Users::where('id', '=', $id)->get();
        return json_encode(array('data' => $data));
    }

    public function destroy($id)
    {
        
        $tampil = Users::where('id', '=', $id)->get();
        foreach ($tampil as $item) {
            $foto = $item->foto;            
        }

        if ($foto) {
            storage::delete($foto);            
        }
       
        $data = Users::where([['id', '=', $id], ['id', '<>', 1]])->delete();
        return json_encode(array('data' => $data));
    }
}
