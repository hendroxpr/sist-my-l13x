<?php

namespace Modules\Sips01\Http\Controllers\transaksi;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Dudi;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Magang;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Tp;
use Modules\Sips01\Models\Walikelas;
use Yajra\DataTables\Facades\DataTables;

class MagangController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Siswa Magang</b>.';
        $page = 'sips01::transaksi.magang';
        $link = '/sips01/transaksi/magang';
        $subtitle = 'Transaksi';
        $caption = 'Siswa Magang';
        $jmlhal = 2;

        $idtp = session('idtp');    
        $idkelas = session('idkelas');

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
            'tabel' => Siswakelas::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'menu' => $menu,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createxxx(Request $request)
    {
        $id = $request['id1'];
        
        $validatedData = $request->validate([
            'iddudi1' => 'required',
            'iddatasiswa1' => 'required',
        ]);

        //untuk input tabel yang asli
        $data = [
            'iddatasiswa' => $validatedData['iddatasiswa1'],
            'iddudi' => $validatedData['iddudi1'],
            'tglmulai' => $request['tglmulai1'],            
            'tglakhir' => $request['tglakhir1'],            
            'lama' => $request['lama1'],            
            'keterangan' => $request['keterangan1'],            
        ];

        if ($id == '0') {
            Magang::create($data);
        } else {
            Magang::where('id', '=', $id)->update($data);
        }
        
        return json_encode('data');
    }
   
    public function create(Request $request)
    {
       
        $id = $request['id1'];

        $validatedData = $request->validate([
            'iddudi1' => 'required',
            'iddatasiswa1' => 'required',
        ]);
        //untuk input tabel yang asli
        $data = [
            'iddatasiswa' => $validatedData['iddatasiswa1'],
            'iddudi' => $validatedData['iddudi1'],
            'tglmulai' => $request['tglmulai1'],            
            'tglakhir' => $request['tglakhir1'],            
            'lama' => $request['lama1'],            
            'keterangan' => $request['keterangan1'],
        ];
        
        if ($id == '0') {
            Magang::create($data);
        } else {
            Magang::where('id', '=', $id)->update($data);
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
        $iddatasiswa = Siswakelas::select('iddatasiswa')
            ->where('idtp','=',$id)
            ->where('idkelas','=',$idkelas);
        
        $datax = Magang::with(['datasiswa','dudi'])
            ->whereIn('iddatasiswa',$iddatasiswa);

        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }


    }

    public function showdatasiswa(Request $request)
    {
        $id = session('idtp');
        $idkelas = session('idkelas');
        $iddatsiswa = Siswakelas::select('iddatasiswa')
            ->with(['tp','kelas','datasiswa'])
            ->where('idtp','=',$id)
            ->where('idkelas','=',$idkelas);

        $datax = Datasiswa::whereIn('id', $iddatsiswa);
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->editColumn('ecard', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->ecard . '" class="text-decoration-none  text-body item_cariecard" data1="'. $row->id.'" data2="'. $row->ecard.'" data3="'. $row->nis.'" data4="'. $row->nisn.'" data5="'. $row->namalengkap.'">' . $row->ecard . '</a>';    
                    return $hasil;
                })
                ->editColumn('nis', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->nis . '" class="text-decoration-none  text-body item_carinis" data1="'. $row->id.'" data2="'. $row->ecard.'" data3="'. $row->nis.'" data4="'. $row->nisn.'" data5="'. $row->namalengkap.'">' . $row->nis . '</a>';    
                    return $hasil;
                })
                ->editColumn('nisn', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->nisn . '" class="text-decoration-none  text-body item_carinisn" data1="'. $row->id.'" data2="'. $row->ecard.'" data3="'. $row->nis.'" data4="'. $row->nisn.'" data5="'. $row->namalengkap.'">' . $row->nisn . '</a>';    
                    return $hasil;
                })
                ->editColumn('namalengkap', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->namalengkap . '" class="text-decoration-none  text-body item_carinamalengkap" data1="'. $row->id.'" data2="'. $row->ecard.'" data3="'. $row->nis.'" data4="'. $row->nisn.'" data5="'. $row->namalengkap.'">' . $row->namalengkap . '</a>';    
                    return $hasil;
                })

                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->namalengkap.'" data3="'. $row->nis.'" data4="'. $row->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    'ecard',
                    'nis',
                    'nisn',
                    'namalengkap',
                    'action',
                    ]) // Memastikan HTML tombol dirender
                ->make(true);
                return $data;
        }


    }

    public function showdudi(Request $request)
    {

        $datax = Dudi::select('*');
        
        if ($request->ajax()) {
            
            $data = DataTables::of($datax)
                ->addIndexColumn() // Menambahkan nomor urut (DT_RowIndex)
                
                ->editColumn('dudi', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->dudi . '" class="text-decoration-none  text-body item_caridudi" data1="'. $row->id.'" data2="'. $row->dudi.'" data3="'. $row->alamat.'" data4="'. $row->kegiatan.'">' . $row->dudi . '</a>';    
                    return $hasil;
                })
                ->editColumn('alamat', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->alamat . '" class="text-decoration-none  text-body item_carialamat" data1="'. $row->id.'" data2="'. $row->dudi.'" data3="'. $row->alamat.'" data4="'. $row->kegiatan.'">' . $row->alamat . '</a>';    
                    return $hasil;
                })
                ->editColumn('kegiatan', function($row){
                    $hasil = '<a href="javascript:void(0)" title="' . $row->kegiatan . '" class="text-decoration-none  text-body item_carialamat" data1="'. $row->id.'" data2="'. $row->dudi.'" data3="'. $row->alamat.'" data4="'. $row->kegiatan.'">' . $row->kegiatan . '</a>';    
                    return $hasil;
                })

                ->addColumn('action', function($row){
                    
                return '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->dudi.'" data3="'. $row->alamat.'" data4="'. $row->kegiatan.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                       '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->dudi.'" data3="'. $row->alamat.'" data4="'. $row->kegiatan.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                    
                })
                ->rawColumns([
                    'dudi',
                    'alamat',
                    'kegiatan',
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
        $data = Magang::where('id', '=', $id)->with(['datasiswa','dudi'])->get();
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
        $data = Magang::where('id', '=', $id)->delete();
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

        session([
            'idtp' => $idtp,
            'idkelas' => $idkelas,
        ]);
    }
    public function import(Request $request)
    {

        $idtp = $request['idtp1'];
        $siswakelas = Siswakelas::select('iddatasiswa')->where('idtp','=',$idtp);
        $tampil=Datasiswa::select('id')
            ->where('aktif','=','Y')
            ->where('idtpmasuk','=',$idtp)
            ->whereNotIn('id', $siswakelas)
            ->get();
        //untuk input tabel yang asli
        foreach ($tampil as $item) {
            $data = [
                'iddatasiswa' => $item->id,
                'idtp' => $request['idtp1'],
                'idkelas' => $request['idkelas1'],
                'keterangan' => $request['keterangan1'],            
            ];
            Siswakelas::create($data);
        }

        //update datasiswa.idkompetensi
        $iddatasiswa = Siswakelas::select('iddatasiswa')
            ->where('idtp','=',$idtp)
            ->where('idkelas','=',$request['idkelas1']);
        $idkompetensi = Kelas::select('idkompetensi')->where('id','=',$request['idkelas1'])->value('idkompetensi');
        $dataku = [
            'idkompetensi' => $idkompetensi,
        ];
        Datasiswa::whereIn('id', $iddatasiswa)->update($dataku);    

        return json_encode('data');
        
    }

    public function print()
    {
        
        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Siswa Kelas</b>.';
        $page = 'sips01::master.print.siswakelas_daftarhadir';
        $link = '/sips01/master/print.siswakelas_daftarhadir';
        $subtitle = 'Master';
        $caption = 'Print Siswa Kelas';
        $jmlhal = 2;

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
        
        $walikelas = Walikelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])->with(['tp','kelas','dataguru'])->get();
        
        $siswakelas = Siswakelas::where([['idtp','=',$idtp],['idkelas','=',$idkelas]])->with(['datasiswa','tp','kelas'])->get();
        
        foreach ($siswakelas as $item) {
            $kelas = Str::slug($item->kelas->kelas);
        }

        $namafile = 'daftarhadir_' . $kelas . '.pdf';  

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
        $pdf->set_paper(array(0, 0, 612.00, 936.00), 'portrait');
        
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
