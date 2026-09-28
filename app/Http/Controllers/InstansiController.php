<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Instansi;
// use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class InstansiController extends Controller
{
    public function index()
    {

        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk mengubah <b>Informasi Instansi</b>.';
        $page = 'admin.dashboards.instansi';
        $link = '/admin/instansi';
        $subtitle = 'Setting Web';
        $caption = 'Instansi';
        $jmlhal = 2;

        return view($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Instansi::get(),
            'aplikasi' => Aplikasi::get()
        ]);
    }

    public function show()
    {
        $data = Instansi::get();
        return json_encode(array('data' => $data));
    }

    public function update(Request $request)
    {

        $tampil = Instansi::where('id', '<>', 0)->get();
        foreach ($tampil as $item) {
            $fotoks = $item->fotoks;
            $logo = $item->logo;
            $strukturorganisasi = $item->strukturorganisasi;
        }

        $excerptprofil1 = Str::limit(strip_tags($request['profil1']),200); 

        if ($request->hasFile('fotoks1')) {
            $validatefotoks = $request->validate([
                'fotoks1' => 'file|max:2048',
            ]);
            if ($validatefotoks) {
                if ($fotoks) {
                    Storage::delete($fotoks);
                    $fotoks1 = $request->file('fotoks1')->store('admin-instansi-fotoks');
                } else {
                    $fotoks1 = $request->file('fotoks1')->store('admin-instansi-fotoks');
                }
            } else {
                $fotoks1 = $fotoks;
            }
        } else {
            $fotoks1 = $fotoks;
        }

        if ($request->hasFile('logo1')) {
            $validatelogo = $request->validate([
                'logo1' => 'file|max:2048',
            ]);
            if ($validatelogo) {
                if ($logo) {
                    storage::delete($logo);
                    $logo1 = $request->file('logo1')->store('admin-instansi-logo');
                } else {
                    $logo1 = $request->file('logo1')->store('admin-instansi-logo');
                }
            } else {
                $logo1 = $logo;
            }
        } else {
            $logo1 = $logo;
        }

        if ($request->hasFile('strukturorganisasi1')) {
            $validatestrukturorganisasi = $request->validate([
                'strukturorganisasi1' => 'file|max:2048',
            ]);
            if ($validatestrukturorganisasi) {
                if ($strukturorganisasi) {
                    storage::delete($strukturorganisasi);
                    $strukturorganisasi1 = $request->file('strukturorganisasi1')->store('admin-instansi-strukturorganisasi');
                } else {
                    $strukturorganisasi1 = $request->file('strukturorganisasi1')->store('admin-instansi-strukturorganisasi');
                }
            } else {
                $strukturorganisasi1 = $strukturorganisasi;
            }
        } else {
            $strukturorganisasi1 = $strukturorganisasi;
        }

        $validatedData = $request->validate([
            'nama1' => 'required',
            'namasingkat1' => 'required',
        ]);

        //untuk input tabel instansi
        $data = [
            'nama' => $validatedData['nama1'],
            'namasingkat' => $validatedData['namasingkat1'],
            'alamat' => $request['alamat1'],
            'desa' => $request['desa1'],
            'kecamatan' => $request['kecamatan1'],
            'kabupaten' => $request['kabupaten1'],
            'propinsi' => $request['propinsi1'],
            'kodepos' => $request['kodepos1'],
            'email' => $request['email1'],
            'facebook' => $request['facebook1'],
            'instagram' => $request['instagram1'],
            'twitter' => $request['twitter1'],
            'whatsapp' => $request['whatsapp1'],
            'website' => $request['website1'],
            'kontakperson' => $request['kontakperson1'],
            'nomorkontak' => $request['nomorkontak1'],
            'jabatankontak' => $request['jabatankontak1'],
            'kepsek' => $request['kepsek1'],
            'nipkepsek' => $request['nipkepsek1'],
            'fotoks' => $fotoks1,
            'sambutanks' => $request['sambutanks1'],
            'bendahara' => $request['bendahara1'],
            'nipbendahara' => $request['nipbendahara1'],
            'kotattd' => $request['kotattd1'],
            'logo' => $logo1,
            'motto' => $request['motto1'],
            'lokasimap' => $request['lokasimap1'],
            'visi' => $request['visi1'],
            'misi' => $request['misi1'],
            'tujuan' => $request['tujuan1'],
            'sejarah' => $request['sejarah1'],
            'profil' => $request['profil1'],
            'excerptprofil'=> $excerptprofil1,
            'awalanprofil' => $request['awalanprofil1'],
            'videoprofil' => $request['videoprofil1'],
            'strukturorganisasi' => $strukturorganisasi1,
            'keterangan' => $request['keterangan1'],
        ];

        Instansi::where('id', '<>', 0)->update($data);

        return json_encode('data');
    }

    public function edit($id)
    {
        // $data = Instansi::where('id', '=', $id)->get();
        // return json_encode(array('data' => $data));
    }

    public function destroy($id)
    {
        // $data = Instansi::where('id', '=', $id)->delete();
        // return json_encode(array('data' => $data));
    }
}

