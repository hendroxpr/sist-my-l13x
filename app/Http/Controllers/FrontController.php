<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Instansi;
use App\Models\Users;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Evot01\Models\Kandidat;
use Modules\Evot01\Models\Pemilih;
use Modules\Evot01\Models\Periode;
use Modules\Sips01\Models\Tp;

class FrontController extends Controller
{
   public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl = new DateTime('now');
        $d = $tgl->format('d');
        $m = $tgl->format('n');
        $y = $tgl->format('Y');
        $hari = $tgl->format('N');

        $mm = $tgl->format('m');

        session([            
            'navigasi' => 'home',
            'memtanggal' => $y . '-' . $mm . '-' . $d,
            'memtanggal2' => $y . '-' . $mm . '-' . $d,
            'memtahun' => $y,        //   
            'tgltransaksi1' => $y . '-' . $mm . '-' . $d,
            'idmenuutama' => 1,
            'idaplikasi' => 1,
        ]);

        $namabulanx = array(" ", "Januari ", "Februari ", "Maret ", "April ", "Mei ", "Juni ", "Juli ", "Agustus ", "September ", "Oktober ", "Nopember ", "Desember ");
        $namaharix = array(" ", "Senin ", "Selasa ", "Rabu ", "Kamis ", "Jum'at ", "Sabtu ", "Minggu");

        $tglsekarang = $namaharix[$hari] . ', ' . $d . ' ' . $namabulanx[$m] . ' ' . $y;

        $tp = Tp::where([['tglawal', '<=', session('memtanggal')], ['tglakhir', '>=', session('memtanggal')]])->get();
        foreach ($tp as $item) {
            session([
                'idtp' => $item->id, 
            ]);                       
        }

        //membuat session instansi
        $instansi = $this->tabelx('instansi');
        foreach ($instansi as $item) {
            session([
                'memnama' => $item->nama,
                'memnamasingkat' => $item->namasingkat,
                'memalamat' => $item->alamat,
                'memdesa' => $item->desa,
                'memkecamatan' => $item->kecamatan,
                'memkabupaten' => $item->kabupaten,
                'mempropinsi' => $item->propinsi,
                'memkodepos' => $item->kodepos,
                'mememail' => $item->email,
                'memfacebook' => $item->facebook,
                'meminstagram' => $item->instagram,
                'memtwitter' => $item->twitter,
                'memwebsite' => $item->website,
                'memkontakperson' => $item->kontakperson,
                'memnomorkontak' => $item->nomorkontak,
                'memjabatankontak' => $item->jabatankontak,
                'memkepsek' => $item->kepsek,
                'memnipkepsek' => $item->nipkepsek,
                'memfotoks' => $item->fotoks,
                'memsambutanks' => $item->sambutanks,
                'membendahara' => $item->bendahara,
                'memnipbendahara' => $item->nipbendahara,
                'memkotattd' => $item->kotattd,
                'memlogo' => $item->logo,
                'memmotto' => $item->motto,
                'memvisi' => $item->visi,
                'memmisi' => $item->misi,
                'memtujuan' => $item->tujuan,
                'memstrukturorganisasi' => $item->strukturorganisasi,
                'memketerangan' => $item->keterangan,
            ]);
        }

        return view('front.dashboards.beranda', [
            'title' => session('memnamasingkat'),
            'instansi' => $this->tabelx('instansi'),
            // 'posts01' => $this->tabelx('posts01'),
            // 'postspopuler01' => $this->tabelx('postspopuler01'),
            // 'poststerkini01' => $this->tabelx('poststerkini01'),
            // 'gurudanpegawai01' => $this->tabelx('gurudanpegawai01'),
            // 'kompetensi01' => $this->tabelx('kompetensi01'),
            'tglsekarang' => $tglsekarang,
            'caption' => '',
            'active' => 'xx'
        ]);
    } 

    public function tabelx($key)
    {
        
        $instansi = Instansi::get();    //0
        // $postsall01 = Posts::where('publish','=','Y')->orderBy('created_at', 'desc')->with('categories');
        // $posts01 = Posts::where('publish','=','Y')->orderBy('created_at', 'desc')->with('categories')->limit(10)->get();
        // $poststerkini01 = Posts::where('publish','=','Y')->orderBy('created_at', 'desc')->with('categories')->limit(3)->get();
        // $postspopuler01 = Posts::where('publish','=','Y')->orderBy('visitor', 'desc')->with('categories')->limit(10)->get();
        // $gurudanpegawai01 = Dataguru::where('aktif', '=', 'Y')->with(['tempatlahir', 'pendidikan', 'statuspegawai', 'jk', 'agama', 'pangkat', 'statusprofesi'])->get();
        // $guru01 = Dataguru::where([['aktif', '=', 'Y'],['idstatusprofesi', '=', 1]])->with(['tempatlahir', 'pendidikan', 'statuspegawai', 'jk', 'agama', 'pangkat', 'statusprofesi']);
        // $tendik01 = Dataguru::where([['aktif', '=', 'Y'],['idstatusprofesi', '=', 2]])->with(['tempatlahir', 'pendidikan', 'statuspegawai', 'jk', 'agama', 'pangkat', 'statusprofesi']);
        // $kompetensi01 = Kompetensi::where('aktif', '=', 'Y')->orderBy('kode2', 'asc')->with(['program', 'dataguru'])->get();
        // $kompetensi01satu = Kompetensi::where('aktif', '=', 'Y')->with(['program', 'dataguru']);
        // $alumni01 = Datasiswa::where('aktif', '=', 'N')->orderBy('idtpmasuk', 'desc')->orderBy('namalengkap', 'asc')
        //     ->with([
        //         'tpmasuk',
        //         'statussiswa',
        //         'kompetensi',
        //         'tempatlahir',
        //         'jk',
        //         'agama',
        //         'statusanak',
        //         'desa',
        //         'tinggal',
        //         'gd',
        //         'tempatlahirayah',
        //         'agamaayah',
        //         'pendidikanayah',
        //         'desaayah',
        //         'tempatlahiribu', 'agamaibu', 'pendidikanibu','desaibu',
        //         'tempatlahirwali',
        //         'agamawali',
        //         'pendidikanwali',
        //         'desawali',
        //         'tpkeluar',
        //         'alasankeluar',
        //         'alasansetelahkeluar',
        //     ]);

        //     $pesertadidik01 = Datasiswa::where('aktif', '=', 'Y')->orderBy('idtpmasuk', 'desc')->orderBy('namalengkap', 'asc')
        //     ->with([
        //         'tpmasuk',
        //         'statussiswa',
        //         'kompetensi',
        //         'tempatlahir',
        //         'jk',
        //         'agama',
        //         'statusanak',
        //         'desa',
        //         'tinggal',
        //         'gd',
        //         'tempatlahirayah',
        //         'agamaayah',
        //         'pendidikanayah',
        //         'desaayah',
        //         'tempatlahiribu', 'agamaibu', 'pendidikanibu','desaibu',
        //         'tempatlahirwali',
        //         'agamawali',
        //         'pendidikanwali',
        //         'desawali',
        //         'tpkeluar',
        //         'alasankeluar',
        //         'alasansetelahkeluar',
        //     ]);

           

        // $categoriesfoto01 = Categories::where([['type', '=', 2], ['jmlfoto', '>', 0]])->orderBy('tglawal', 'desc');
        // $categoriesvideo01 = Categories::where([['type', '=', 2], ['jmlvideo', '>', 0]])->orderBy('tglawal', 'desc');
        // $categoriespost01 = Categories::where([['type', '=', 1], ['jmlpost', '>', 0]])->orderBy('tglawal', 'desc');
        // $kategoriberita01 = Categories::where('type', '=', 1)->get();
        // $foto01 = Galleries::where([['type', '=', 1], ['publish', '=', 'Y']])->orderBy('created_at', 'desc');
        // $video01 = Galleries::where([['type', '=', 2], ['publish', '=', 'Y']])->orderBy('created_at', 'desc');
        // $tp01 = Tp::orderBy('tp', 'asc')->get();        
        // $kelas01 = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->with(['tingkat','kompetensi'])->get();

        $arr = [
            'instansi' => $instansi,    //0
            // 'postsall01' => $postsall01,
            // 'posts01' => $posts01,
            // 'poststerkini01' => $poststerkini01,    //0
            // 'postspopuler01' => $postspopuler01,
            // 'gurudanpegawai01' => $gurudanpegawai01,
            // 'guru01' => $guru01,
            // 'tendik01' => $tendik01,
            // 'kompetensi01' => $kompetensi01,
            // 'kompetensi01satu' => $kompetensi01satu,
            // 'alumni01' => $alumni01,
            // 'pesertadidik01' => $pesertadidik01,
            // 'categoriesfoto01' => $categoriesfoto01,
            // 'categoriesvideo01' => $categoriesvideo01,
            // 'categoriespost01' => $categoriespost01,
            // 'kategoriberita01' => $kategoriberita01,
            // 'foto01' => $foto01,
            // 'video01' => $video01,
            // 'tp01' => $tp01,
            // 'kelas01' => $kelas01,
            
        ];
        return $arr[$key];
    }

    public function loginform()
    {
        
        date_default_timezone_set('Asia/Jakarta');

        $tgl = new DateTime('now');
        $d = $tgl->format('d');
        $m = $tgl->format('n');
        $y = $tgl->format('Y');
        $hari = $tgl->format('N');

        $mm = $tgl->format('m');

        session([            
            'navigasi' => 'home',
            'memtanggal' => $y . '-' . $mm . '-' . $d,
            'memtanggal2' => $y . '-' . $mm . '-' . $d,
            'memtahun' => $y,        //     
        ]);

        $namabulanx = array(" ", "Januari ", "Februari ", "Maret ", "April ", "Mei ", "Juni ", "Juli ", "Agustus ", "September ", "Oktober ", "Nopember ", "Desember ");
        $namaharix = array(" ", "Senin ", "Selasa ", "Rabu ", "Kamis ", "Jum'at ", "Sabtu ", "Minggu");

        $tglsekarang = $namaharix[$hari] . ', ' . $d . ' ' . $namabulanx[$m] . ' ' . $y;

        $tp = Tp::where([['tglawal', '<=', session('memtanggal')], ['tglakhir', '>=', session('memtanggal')]])->get();
        foreach ($tp as $item) {
            session([
                'idtp' => $item->id, 
            ]);                       
        }

        //membuat session instansi
        $instansi = $this->tabelx('instansi');
        foreach ($instansi as $item) {
            session([
                'memnama' => $item->nama,
                'memnamasingkat' => $item->namasingkat,
                'memalamat' => $item->alamat,
                'memdesa' => $item->desa,
                'memkecamatan' => $item->kecamatan,
                'memkabupaten' => $item->kabupaten,
                'mempropinsi' => $item->propinsi,
                'memkodepos' => $item->kodepos,
                'mememail' => $item->email,
                'memfacebook' => $item->facebook,
                'meminstagram' => $item->instagram,
                'memtwitter' => $item->twitter,
                'memwebsite' => $item->website,
                'memkontakperson' => $item->kontakperson,
                'memnomorkontak' => $item->nomorkontak,
                'memjabatankontak' => $item->jabatankontak,
                'memkepsek' => $item->kepsek,
                'memnipkepsek' => $item->nipkepsek,
                'memfotoks' => $item->fotoks,
                'memsambutanks' => $item->sambutanks,
                'membendahara' => $item->bendahara,
                'memnipbendahara' => $item->nipbendahara,
                'memkotattd' => $item->kotattd,
                'memlogo' => $item->logo,
                'memmotto' => $item->motto,
                'memvisi' => $item->visi,
                'memmisi' => $item->misi,
                'memtujuan' => $item->tujuan,
                'memstrukturorganisasi' => $item->strukturorganisasi,
                'memketerangan' => $item->keterangan,
            ]);
        }

        return view('front.dashboards.login', [
            'title' => session('memnamasingkat'),
            'caption' => '',
            'instansi' => Instansi::get(),
            'active' => 'xx'
        ]);
    }

    public function registerform()
    {
        return view('front.dashboards.register', [
            'title' => session('memnamasingkat'),
            'caption' => '',
            'instansi' => Instansi::get(),
            'active' => 'xx'
        ]);
    }

    public function authenticate(Request $request)
    {
        
        $request['email'] = Str::lower($request['email']);
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:100'
        ]);

        $cek = Users::where('email', '=', $request['email'])->get();
        foreach ($cek as $item) {
            $blokir = $item->blokir;
        }


        if (Auth::attempt($credentials)) {
            if ($blokir == 'N') {
                $request->session()->regenerate();
                $sesi = $request->session()->get('key');

                $jmllogin = auth()->user()->jmllogin + 1;
                $email = auth()->user()->email;
                $kunci1 = auth()->user()->kunci1;
                $level = auth()->user()->levels;


                // $token = $user->createToken('authToken')->plainTextToken;
                //update jmllogin+1
                Users::where('email', $email)->update(['jmllogin' => $jmllogin]);

                //update email_verified_at
                Users::where('email', '=', $email)->update(
                    [
                        'email_verified_at' => Carbon::now(),
                        'jmllogin' => $jmllogin,
                        'idsession' => $sesi
                    ]
                );

                $aplikasis = Aplikasi::where('id', '=', $kunci1)->get();
                foreach ($aplikasis as $item) {
                    $kode = $item->kode;
                    $aplikasi = $item->aplikasi;
                    $idaplikasi = $item->id;
                }

                //buat session
                session([
                    'awaljam' => Carbon::now(),
                    'kode' => $kode,
                    'aplikasi' => $aplikasi,
                    'idaplikasi' => $idaplikasi
                ]);
                return redirect()->intended('/admin');
            } else {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();
                alert()->warning('Login', 'Your account blocked ...');
                return redirect('/login');
            }
        } else {
            alert()->error('Login', 'Login failed ...');
            return redirect('/login');
        }
    }

    function listaplikasi()
    {
        $tampil = Aplikasi::orderBy('aplikasi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->aplikasi . "</option>";
        }
    }

    public function create(Request $request)
    {

        $name = $request['username2'];
        $request['username2'] = Str::slug($request['username2']);
        $request['email2'] = Str::lower($request['email2']);

        $validateData = $request->validate([
            'username2' => 'required|min:3|max:100|unique:users,slug',
            'email2' => 'required|min:5|max:100|email|unique:users,email',
            'password2' => 'required|min:3|max:100',
            'idaplikasi2' => 'required',
        ]);

        $data = [
            'name' => $name,
            'slug' => $validateData['username2'],
            'email' => $validateData['email2'],
            'password' => Hash::make($validateData['password2']),
            'namadepan' => $request['namadepan2'],
            'namatengah' => $request['namatengah2'],
            'namabelakang' => $request['namabelakang2'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'kunci1' => $request['idaplikasi2'],
            'kunci2' => $request['idaplikasi2'],
            'status' => $request['status2'],
            'levels' => 3,
            'blokir' => 'Y',
        ];

        $sudahada = Users::where(fn($q) => $q
            ->whereRaw('LOWER(name) = ?', [$request['username2']])
            ->orWhere('email', $request['email2']))
            ->count();

        if($sudahada>0){
            alert()->error('Register', 'Data has already been taken ...');    
        }else{
            Users::create($data);
            alert()->success('Register', 'Save successed ...');
            return redirect('/register');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        alert()->success('Logout', 'Logout successed ...');
        return redirect('/');
    }

    public function loginevotform()
    {
        return view('front.dashboards.loginevot', [
            'title' => session('memnamasingkat'),
            'caption' => '',
            'instansi' => Instansi::get(),
            'periode' => Periode::get(),
            'active' => 'xx'
        ]);
    }

    public function cekloginevot(Request $request)
    {
        $us1 = $request['user'];
        $pa1 = $request['password'];
        
        $cek = Pemilih::where('users', '=', $us1)
        ->where('passwords', '=', $pa1)        
        ->count();
        
        if($cek==0){
            alert()->warning('login', 'Maaf, User name atau password salah.....');
            return redirect('/loginevot');
        }else{
            $cek2 = Pemilih::where('users', '=', $us1)
            ->where('passwords', '=', $pa1)            
            ->where('pilihan', '=', 0)            
            ->count();

            $tampil = Pemilih::where('users', '=', $us1)
            ->where('passwords', '=', $pa1)            
            ->where('pilihan', '=', 0)            
            ->get();

            foreach ($tampil as $item) {
                $idpemilih = $item->id;
                $namapemilih = $item->nama;
            }
            
            if($cek2==0){
                session([                
                    'idpemilih' => 0,
                    'namapemilih' => '',
                ]);
                
                alert()->warning('login', 'Maaf, akun sudah digunakan .....');
                return redirect('/loginevot');  
            }else{
                session([                
                    'idpemilih' => $idpemilih,
                    'namapemilih' => $namapemilih,
                ]);

                return redirect('/pilkaos');
            }

        }
        
    }

    public function pilkaosform()
    {
        return view('front.dashboards.pilkaos', [
            'title' => session('memnamasingkat'),
            'caption' => '',
            'instansi' => Instansi::get(),
            'kandidat' => Kandidat::get(),
            'jmlkandidat' => Kandidat::count(),
            'periode' => Periode::get(),
            'active' => 'xx'
        ]);
    }
    public function cekpilkaos(Request $request)
    {
        $idx= $request['idx'];
        $nomorx = $request['nomorx'];
        $statusx = 'Sudah Voting';
        
        $data = [            
            'pilihan' => $nomorx,
            'status' => $statusx,
            
        ];

        Pemilih::where('id', '=', $idx)->update($data);


        alert()->warning('login', 'Terima kasih anda sudah berpartisipasi .....');
        return redirect('/loginevot');       
        
    }



}
