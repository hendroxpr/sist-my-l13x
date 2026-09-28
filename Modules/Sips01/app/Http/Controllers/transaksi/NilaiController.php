<?php

namespace Modules\Sips01\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Sips01\Imports\MemabsensiImport;
use Modules\Sips01\Imports\MemnilaiImport;
use Modules\Sips01\Models\Absensi;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Mapel;
use Modules\Sips01\Models\MemAbsensi;
use Modules\Sips01\Models\Memnilai;
use Modules\Sips01\Models\Nilai;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Tp;
use Modules\Sips01\Models\Walikelas;
use Yajra\DataTables\Facades\DataTables;

class NilaiController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Nilai Siswa</b>.';
        $page = 'sips01::transaksi.nilai';
        $link = '/sips01/transaksi/nilai';
        $subtitle = 'Transaksi';
        $caption = 'Daftar Nilai';
        $jmlhal = 2;

        $idtp = session('idtp');    
        $idkelas = session('idkelas');
        $idmapel = session('idmapel');
        $semester = session('semester');

        if($idtp==''){
            session(['idtp' => 0]);            
        }else{
            session(['idtp' => $idtp]);
        }
        if($idkelas==''){
            session(['idkelas' => 0]);
        }else{
            session(['idkelas' => $idkelas]);
        }
        if($idmapel==''){
            session(['idmapel' => 0]);
        }else{
            session(['idmapel' => $idmapel]);
        }
        if($semester==''){
            session(['semester' => 1]);
        }else{
            session(['semester' => $semester]);
        }

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
            'tabel' => Nilai::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }

    public function importnilai(Request $request){
        
        if ($request->hasFile('file1')) {
             $validateFile = $request->validate([
                'file1' => 'required|mimes:xlsx,xls,csv|max:2048', // Sesuai dengan formData.append('file1', file1)
                'idtp1'    => 'required',
                'idmapel1'  => 'required',
                'semester1' => 'required',
            ]);
            
            if($validateFile){
                try{
                    $params = [
                        'idtp'   => $request['idtp1'],
                        'idmapel'  => $request['idmapel1'],
                        'smt' => $request['semester1'],
                    ];
                    //lokasi excel sementara
                    $filex = $request->file('file1')->store('Sips01-nilai-excel');
                    //import data excel dan simpan datanya ke model MemnilaiImport.php  
                    Excel::import(new MemnilaiImport, $filex);
                    //delete excel
                    Storage::delete($filex);
                    //update memdatasiswa
                    Memnilai::where('id','<>','0')->update($params);
                    
                    $totalrecord = Memnilai::select('id')->count();
                    $jr = 0;
                    //buka Memnilai
                    $tampil = Memnilai::get();
                    foreach ($tampil as $item) {
                        $iddatasiswa = $item->iddatasiswa;            
                        $idmapel = $item->idmapel;            
                        $smt = $item->smt;            
                        $jr = $jr + 1; 
                        
                        $data = [
                            'iddatasiswa' => $item->iddatasiswa,
                            'idtp' => $item->idtp,
                            'idmapel' => $item->idmapel,
                            'smt' => $item->smt,
                            'nilai' => $item->nilai,
                            'kkm' => $item->kkm,
                            'hitung' => $item->hitung,
                            'keterangan' => $item->keterangan,
                        ];

                        $cari = Nilai::where('iddatasiswa', '=', $iddatasiswa)
                            ->where('idmapel', '=', $idmapel)
                            ->where('smt', '=', $smt)
                            ->count();
                        if($cari==0){
                            Nilai::create($data);
                        }else{
                            Nilai::where('iddatasiswa', '=', $iddatasiswa)
                            ->where('idmapel', '=', $idmapel)
                            ->where('smt', '=', $smt)
                            ->update($data);
                        } 

                    }
                    //hapus data

                    if ($jr >= $totalrecord){
                        Memnilai::where('id','>',0)
                        ->delete();
                    }
                    
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

    public function importabsensi(Request $request){
        
        if ($request->hasFile('file1')) {
             $validateFile = $request->validate([
                'file1' => 'required|mimes:xlsx,xls,csv|max:2048', // Sesuai dengan formData.append('file1', file1)
                'idtp1'    => 'required',
                'semester1' => 'required',
            ]);
            
            if($validateFile){
                try{
                    $params = [
                        'idtp'   => $request['idtp1'],
                        'smt' => $request['semester1'],
                    ];
                    //lokasi excel sementara
                    $filex = $request->file('file1')->store('Sips01-absensi-excel');
                    //import data excel dan simpan datanya ke model MemnilaiImport.php  
                    Excel::import(new MemabsensiImport, $filex);
                    //delete excel
                    Storage::delete($filex);
                    //update memdatasiswa
                    MemAbsensi::where('id','<>','0')->update($params);
                    
                    
                    $totalrecord = MemAbsensi::select('id')->count();
                    $jr = 0;
                    //buka MemAbsensi
                    $tampil = MemAbsensi::get();
                    foreach ($tampil as $item) {
                        $iddatasiswa = $item->iddatasiswa;            
                        $smt = $item->smt;            
                        $jr = $jr + 1; 
                        
                        $data = [
                            'iddatasiswa' => $item->iddatasiswa,
                            'idtp' => $item->idtp,
                            'smt' => $item->smt,
                            'sakit' => $item->sakit,
                            'izin' => $item->izin,
                            'alpa' => $item->alpa,
                            'status' => $item->status,
                            'kelas' => $item->kelas,
                        ];

                        $cari = Absensi::where('iddatasiswa', '=', $iddatasiswa)
                            ->where('smt', '=', $smt)
                            ->count();
                        if($cari==0){
                            Absensi::create($data);
                        }else{
                            Absensi::where('iddatasiswa', '=', $iddatasiswa)
                            ->where('smt', '=', $smt)
                            ->update($data);
                        } 

                    }
                    //hapus data

                    if ($jr >= $totalrecord){
                        MemAbsensi::where('id','>',0)
                        ->delete();
                    }
                    

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
        ]);
        
        //untuk input tabel yang asli
        $data = [
            'iddatasiswa' => $validatedData['iddatasiswa1'],
            'idtp' => $validatedData['idtp1'],
            'idkelas' => $validatedData['idkelas1'],
            'keterangan' => $request['keterangan1'],            
        ];

        if ($id == '0') {
            Siswakelas::create($data);
        } else {
            Siswakelas::where('id', '=', $id)->update($data);
        }

        // update datasiswa.idkompetensi
        $iddatasiswa = Siswakelas::select('iddatasiswa')
            ->where('idtp','=',$validatedData['idtp1'])
            ->where('idkelas','=',$request['idkelas1']);
        $idkompetensi = Kelas::select('idkompetensi')->where('id','=',$request['idkelas1'])->value('idkompetensi');
        $dataku = [
            'idkompetensi' => $idkompetensi,
        ];
        Datasiswa::whereIn('id', $iddatasiswa)->update($dataku);

        return json_encode('data');
    }
   
    /**
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
        // $datasiswa = Datasiswa::select('id')->where('aktif','=','Y');        
        // $idtp = session('idtp');    
        // $idkelas = session('idkelas');
        // $data = Siswakelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])
        //     ->whereIn('iddatasiswa', $datasiswa)
        //     ->with(['datasiswa','tp','kelas'])->get();
        // return json_encode(array('data' => $data));

        $id = session('idtp');
        $idkelas = session('idkelas');
        $datax = Siswakelas::with(['tp','kelas','datasiswa'])
        ->where('idtp','=',$id)
        ->where('idkelas','=',$idkelas);
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('nilai', function($row){
                    $hasil = Nilai::select('nilai')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['idmapel','=',session('idmapel')],['smt','=',session('semester')]])
                        ->value('nilai');
                return $hasil;
                })
                ->addColumn('kkm', function($row){
                    $hasil = Nilai::select('kkm')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['idmapel','=',session('idmapel')],['smt','=',session('semester')]])
                        ->value('kkm');
                return $hasil;
                })
                ->addColumn('keterangan', function($row){
                    $hasil = Nilai::select('keterangan')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['idmapel','=',session('idmapel')],['smt','=',session('semester')]])
                        ->value('keterangan');
                return $hasil;
                })
                ->addColumn('sakit', function($row){
                    $hasil = Absensi::select('sakit')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['smt','=',session('semester')]])
                        ->value('sakit');
                return $hasil;
                })
                ->addColumn('izin', function($row){
                    $hasil = Absensi::select('izin')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['smt','=',session('semester')]])
                        ->value('izin');
                return $hasil;
                })
                ->addColumn('alpa', function($row){
                    $hasil = Absensi::select('alpa')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['smt','=',session('semester')]])
                        ->value('alpa');
                return $hasil;
                })
                ->addColumn('status', function($row){
                    $hasilx = Absensi::select('status')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['smt','=',session('semester')]])
                        ->value('status');
                    $x = session('semester') % 2;
                    if($x=='0'){
                        $hasil = $hasilx;
                    }else{
                        $hasil = '';
                    }
                return $hasil;
                })
                ->addColumn('kelas', function($row){
                    $hasilx = Absensi::select('kelas')
                        ->where([['iddatasiswa','=', $row->iddatasiswa],['idtp','=', session('idtp') ],['smt','=',session('semester')]])
                        ->value('kelas');
                    $x = session('semester') % 2;
                    if($x=='0'){
                        $hasil = $hasilx;
                    }else{
                        $hasil = '';
                    }
                return $hasil;
                })
                ->addColumn('action', function($row){                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                })
                ->addColumn('action2', function($row){                    
                return '<a href="#" title="Print Data" class="btn btn-primary btn-xs item_print" data0="print" data1="' . $row->iddatasiswa . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-printer-fill fs-6"></i></a>';
                })
                ->rawColumns([
                    'sakit',
                    'izin',
                    'alpa',
                    'status',
                    'kelas',
                    'nilai',
                    'kkm',
                    'keterangan',
                    'action',
                    'action2',
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
        $data = Siswakelas::where('id', '=', $id)->with(['datasiswa','tp','kelas'])->get();
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
        $data = Siswakelas::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }
    
    function listtp()
    {
        $tampil = Tp::orderBy('tp', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->tp . "</option>";
        }
    }
    
    function listkelas()
    {
        $tampil = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelas . "</option>";
        }
    }
    function listmapel()
    {
        $tampil = Mapel::with('kelompokmapel')->orderBy('urutan', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->mapel . " (" . $baris->kelompokmapel->kelompokmapel .  ")</option>";
        }
    }
    function showwalikelas()
    {
        $idtp = session('idtp');    
        $idkelas = session('idkelas');

        if($idtp==''){
            $idtp=0;
        }else{
            $idtp = session('idtp');
        }
        if($idkelas==''){
            $idkelas=0;
        }else{
            $idkelas = session('idkelas');
        }
        
        $data = Walikelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])->with(['tp','kelas','dataguru'])->get();
        return json_encode(array('data' => $data));
        
    }

    public function kirimsyarat(Request $request)
    {
        $idtp = $request['idtp1'];
        $idkelas = $request['idkelas1'];
        $idmapel = $request['idmapel1'];
        $semester = $request['semester1'];

        session([
            'idtp' => $idtp,
            'idkelas' => $idkelas,
            'idmapel' => $idmapel,
            'semester' => $semester,
        ]);
    }

    public function kirimid(Request $request)
    {
        $iddatasiswa1 = $request['iddatasiswa1'];
        $nisn1 = $request['nisn1'];
        session([
            'iddatasiswa1' => $iddatasiswa1,
            'nisn1' => $nisn1,
        ]);
    }

    public function printnilai()
    {
        
        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Daftar Nilai Hasil Belajar Siswa</b>.';
        $page = 'sips01::transaksi.print.nilai_daftarnilai';
        $link = '/sips01/transaksi/print.nilai_daftarnilai';
        $subtitle = 'Transaksi';
        $caption = 'Print Daftar Nilai Hasil Belajar';
        $jmlhal = 2;

        $idtp = session('idtp');    
        $idkelas = session('idkelas');
        $iddatasiswa = session('iddatasiswa1');

        if($idtp==''){
            $idtp=0;
        }else{
            $idtp = session('idtp');
        }
        if($idkelas==''){
            $idkelas=0;
        }else{
            $idkelas = session('idkelas');
        }
        $walikelas = Walikelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])->with(['tp','kelas','dataguru'])->get();
        $siswakelas = Siswakelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas],['iddatasiswa','=',$iddatasiswa]])->with(['datasiswa','tp','kelas'])->get();
        
        foreach ($siswakelas as $item) {
            $nisn = $item->datasiswa->nisn;
        }

        $namafile = 'daftarnilai_' . $nisn . '.pdf';  

        $pdf = Pdf::loadView($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Siswakelas::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'siswakelas' => $siswakelas,
            'walikelas' => $walikelas,


        ])->setOptions(['defaultFont' => 'sans-serif', 'defaultFont' => 'sans-serif' ])->set_option('isHtml5ParserEnabled', true); 
        $pdf->set_paper(array(0, 0, 841.89, 1190.55), 'landscape');
        
        return $pdf->stream($namafile);

        // static $PAPER_SIZES = array(
        //     "4a0" => array(0, 0, 4767.87, 6740.79),
        //     "2a0" => array(0, 0, 3370.39, 4767.87),
        //     "a0" => array(0, 0, 2383.94, 3370.39),
        //     "a1" => array(0, 0, 1683.78, 2383.94),
        //     "a2" => array(0, 0, 1190.55, 1683.78),
        //     "a3" => array(0, 0, 841.89, 1190.55),
        //     "a4" => array(0, 0, 595.28, 841.89),
        //     "a5" => array(0, 0, 419.53, 595.28),
        //     "a6" => array(0, 0, 297.64, 419.53),
        //     "a7" => array(0, 0, 209.76, 297.64),
        //     "a8" => array(0, 0, 147.40, 209.76),
        //     "a9" => array(0, 0, 104.88, 147.40),
        //     "a10" => array(0, 0, 73.70, 104.88),
        //     "b0" => array(0, 0, 2834.65, 4008.19),
        //     "b1" => array(0, 0, 2004.09, 2834.65),
        //     "b2" => array(0, 0, 1417.32, 2004.09),
        //     "b3" => array(0, 0, 1000.63, 1417.32),
        //     "b4" => array(0, 0, 708.66, 1000.63),
        //     "b5" => array(0, 0, 498.90, 708.66),
        //     "b6" => array(0, 0, 354.33, 498.90),
        //     "b7" => array(0, 0, 249.45, 354.33),
        //     "b8" => array(0, 0, 175.75, 249.45),
        //     "b9" => array(0, 0, 124.72, 175.75),
        //     "b10" => array(0, 0, 87.87, 124.72),
        //     "c0" => array(0, 0, 2599.37, 3676.54),
        //     "c1" => array(0, 0, 1836.85, 2599.37),
        //     "c2" => array(0, 0, 1298.27, 1836.85),
        //     "c3" => array(0, 0, 918.43, 1298.27),
        //     "c4" => array(0, 0, 649.13, 918.43),
        //     "c5" => array(0, 0, 459.21, 649.13),
        //     "c6" => array(0, 0, 323.15, 459.21),
        //     "c7" => array(0, 0, 229.61, 323.15),
        //     "c8" => array(0, 0, 161.57, 229.61),
        //     "c9" => array(0, 0, 113.39, 161.57),
        //     "c10" => array(0, 0, 79.37, 113.39),
        //     "ra0" => array(0, 0, 2437.80, 3458.27),
        //     "ra1" => array(0, 0, 1729.13, 2437.80),
        //     "ra2" => array(0, 0, 1218.90, 1729.13),
        //     "ra3" => array(0, 0, 864.57, 1218.90),
        //     "ra4" => array(0, 0, 609.45, 864.57),
        //     "sra0" => array(0, 0, 2551.18, 3628.35),
        //     "sra1" => array(0, 0, 1814.17, 2551.18),
        //     "sra2" => array(0, 0, 1275.59, 1814.17),
        //     "sra3" => array(0, 0, 907.09, 1275.59),
        //     "sra4" => array(0, 0, 637.80, 907.09),
        //     "letter" => array(0, 0, 612.00, 792.00),
        //     "legal" => array(0, 0, 612.00, 1008.00),
        //     "ledger" => array(0, 0, 1224.00, 792.00),
        //     "tabloid" => array(0, 0, 792.00, 1224.00),
        //     "executive" => array(0, 0, 521.86, 756.00),
        //     "folio" => array(0, 0, 612.00, 936.00),
        //     "commercial #10 envelope" => array(0, 0, 684, 297),
        //     "catalog #10 1/2 envelope" => array(0, 0, 648, 864),
        //     "8.5x11" => array(0, 0, 612.00, 792.00),
        //     "8.5x14" => array(0, 0, 612.00, 1008.0),
        //     "11x17" => array(0, 0, 792.00, 1224.00),
        // );
        
    }

}
