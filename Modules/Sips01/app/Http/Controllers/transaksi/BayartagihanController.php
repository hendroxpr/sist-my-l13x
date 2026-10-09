<?php

namespace Modules\Sips01\Http\Controllers\Transaksi;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Sips01\Models\Agama;
use Modules\Sips01\Models\Bulan;
use Modules\Sips01\Models\Dataguru;
use Modules\Sips01\Models\Datasiswa;
use Modules\Sips01\Models\Jenistagihan;
use Modules\Sips01\Models\Kelas;
use Modules\Sips01\Models\Parametertagihan;
use Modules\Sips01\Models\Siswakelas;
use Modules\Sips01\Models\Tagihan;
use Modules\Sips01\Models\Tp;
use Modules\Sips01\Models\Walikelas;
use Yajra\DataTables\Facades\DataTables;

class BayartagihanController extends Controller
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
        $remark = 'Halaman ini digunakan untuk transaksi <b>Bayar Tagihan</b>.<br>
        Keterangan : | Belum Dilaporkan |
        |<span style="background-color: rgb(141, 255, 141);"> Sudah Lapor </span>|
        |<span style="background-color: rgb(255, 126, 126);"> Sudah Approval </span>|';
        $page = 'sips01::transaksi.bayartagihan';
        $link = '/sips01/transaksi/bayartagihan';
        $subtitle = 'Transaksi';
        $caption = 'Bayar Tagihan';
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
    public function create(Request $request)
    {
        $id = $request['id1'];
        
        //untuk input tabel yang asli 

        $data = [                      
            'idtp' => $request['idtp1'],
            'iddatasiswa' => $request['iddatasiswa1'],
            'idjenistagihan' => $request['idjenistagihan1'],
            'idbulan' => $request['idbulan1'],
            'iddataguru' => $request['iddataguru1'],
            'idusers' => auth()->user()->id,
            'nomorb1' => $request['nomorb11'],
            'nomorbukti1' => $request['nomorbukti1'],
            'tgltransaksi' => $request['tgltransaksi1'],
            'targetbayar' => $request['targetbayar1'],
            'sudahbayar' => $request['sudahbayar1'],
            'bayar' => $request['bayar1'],
            'kurangbayar' => $request['kurangbayar1'],
            'keterangan' => $request['keterangan1'],
        ];

        if ($id == '0') {
            Tagihan::create($data);
        } else {
            Tagihan::where('id', '=', $id)->update($data);
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
        $idkelas = session('idkelas');
        $iddatasiswa = session('iddatasiswa');
        $kelas=Kelas::select('kelas')            
            ->where('id','=',$idkelas)
            ->value('kelas');
            
        $datax = Tagihan::select('*')->selectRaw('? as kelas', [$kelas])
            ->orderBy('idjenistagihan', 'asc')
            ->orderBy('tgltransaksi', 'asc')
            ->with(['datasiswa','jenistagihan','bulan', 'tp', 'dataguru'])
            ->where([['idtp','=',$idtp],['iddatasiswa','=',$iddatasiswa]]);

        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn()
                // ->filterColumn('nis', function($query, $keyword) {                    
                //     $query->whereRaw("(select nis from datasiswa where id=siswakelas.iddatasiswa) LIKE ?", ["%{$keyword}%"]);
                // })

                // ->orderColumn('nis', function ($query, $direction) {
                //     $query->orderByRaw('(select nis from datasiswa where id=siswakelas.iddatasiswa) ' . $direction);
                // })
                
                    ->addColumn('kelas', function ($row) {
                        return number_format($row->targetbayar ?? 0);
                    })
                    ->addColumn('targetbayar', function ($row) {
                        return number_format($row->targetbayar ?? 0);
                    })
                    ->addColumn('sudahbayar', function ($row) {
                        return number_format($row->sudahbayar ?? 0);
                    })
                    ->addColumn('bayar', function ($row) {
                        return number_format($row->bayar ?? 0);
                    })
                    ->addColumn('kurangbayar', function ($row) {
                        return number_format($row->kurangbayar ?? 0);
                    })
                    ->addColumn('action', function ($row) {
                        $tgltransaksi = Carbon::parse($row->tgltransaksi)->format('Y-m-d');
                        $tglsekarang = Carbon::now()->timezone('Asia/Jakarta')->format('Y-m-d');
                        $hasil1 = '<a href="#" title="Print Data" class="btn btn-warning btn-xs item_print" data0="print" data1="' . $row->id . '" data2="'. $row->tgltransaksi.'" data3="'. $row->jenistagihan->jenistagihan.'" data4="'. $row->nomorbukti1.'" data5="'. $row->bayar.'"><i style="font-size:18px" class="bi bi-printer-fill fs-6"></i></a>';
                        $hasil2 = '<a href="javascript:void(0)" title="Edit Data" class="btn btn-success btn-sm item_edit" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-pencil-square fs-6"></i></a> ' .
                                  '<a href="javascript:void(0)" title="Hapus Data" class="btn btn-danger btn-sm item_destroy" data1="' . $row->id . '" data2="'. $row->datasiswa->namalengkap.'" data3="'. $row->datasiswa->nis.'" data4="'. $row->datasiswa->nisn.'"><i style="font-size:18px" class="bi bi-trash fs-6"></i></a>';
                        if($tgltransaksi==$tglsekarang){
                            if($row->nomorlapor>0){
                                $hasil = $hasil1;
                            }else{
                                $hasil = $hasil1 . $hasil2;
                            }
                        }else{
                            $hasil = $hasil1;
                        }    
                        return $hasil;
                   })
                  
                ->rawColumns([
                    'targetbayar',
                    'sudahbayar',
                    'bayar',
                    'kurangbayar',
                    'ecard',
                    'nis',
                    'nisn',
                    'namalengkap',
                    'action',
                    
                ])


                ->make(true);

                return $data;

        }
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Tagihan::where('id', '=', $id)->get();
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
        $data = Tagihan::where('id', '=', $id)->delete();
        return json_encode(array('data' => $data));
    }
    
    function listtp()
    {
        
        $tampil = Tp::orderBy('tp', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->tp . "</option>";
        }
    }
    
    function listbulan()
    {
        $idtp = session('idtp');
        $tampil = Bulan::where('idtp','=',$idtp)->orderBy('tglawal', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->namabulan . "</option>";
        }
    }

    public function showdatasiswa(Request $request)
    {
        
        $idtp = session('idtp');
        $datax = Siswakelas::where('idtp','=',$idtp)
            ->with(['datasiswa','tp','kelas']);
    
        if ($request->ajax()) {
            $data = DataTables::of($datax)
                ->addIndexColumn()
                ->filterColumn('nis', function($query, $keyword) {                    
                    $query->whereRaw("(select nis from datasiswa where id=siswakelas.iddatasiswa) LIKE ?", ["%{$keyword}%"]);
                })
                ->filterColumn('nisn', function($query, $keyword) {                    
                    $query->whereRaw("(select nisn from datasiswa where id=siswakelas.iddatasiswa) LIKE ?", ["%{$keyword}%"]);
                })
                ->filterColumn('ecard', function($query, $keyword) {                    
                    $query->whereRaw("(select ecard from datasiswa where id=siswakelas.iddatasiswa) LIKE ?", ["%{$keyword}%"]);
                })
                ->filterColumn('namalengkap', function($query, $keyword) {                    
                    $query->whereRaw("(select namalengkap from datasiswa where id=siswakelas.iddatasiswa) LIKE ?", ["%{$keyword}%"]);
                })
                ->filterColumn('kelas', function($query, $keyword) {                    
                    $query->whereRaw("(select kelas from kelas where id=siswakelas.idkelas) LIKE ?", ["%{$keyword}%"]);
                })

                ->orderColumn('nis', function ($query, $direction) {
                    $query->orderByRaw('(select nis from datasiswa where id=siswakelas.iddatasiswa) ' . $direction);
                })
                ->orderColumn('nisn', function ($query, $direction) {
                    $query->orderByRaw('(select nisn from datasiswa where id=siswakelas.iddatasiswa) ' . $direction);
                })
                ->orderColumn('ecard', function ($query, $direction) {
                    $query->orderByRaw('(select ecard from datasiswa where id=siswakelas.iddatasiswa) ' . $direction);
                })
                ->orderColumn('namalengkap', function ($query, $direction) {
                    $query->orderByRaw('(select namalengkap from datasiswa where id=siswakelas.iddatasiswa) ' . $direction);
                })
                ->orderColumn('kelas', function ($query, $direction) {
                    $query->orderByRaw('(select kelas from kelas where id=siswakelas.idkelas) ' . $direction);
                })

                ->addColumn('ecard', function ($row) {
                    return '<a href="javascript:void(0)" title="'. ($row->datasiswa ? $row->datasiswa->ecard : '-') .'" class="text-decoration-none text-body item_ecard " data1="' . $row->id . '" data2="'. $row->datasiswa->nis. '" data3="'. $row->datasiswa->nisn. '" data4="'. $row->datasiswa->namalengkap.'" data5="'. $row->datasiswa->ecard.'" data6="'. $row->idkelas.'"  data7="'. $row->iddatasiswa.'">'.($row->datasiswa ? $row->datasiswa->ecard : '-').'</a> ';
                })
                ->addColumn('nis', function ($row) {
                    return '<a href="javascript:void(0)" title="'. ($row->datasiswa ? $row->datasiswa->nis : '-') .'" class="text-decoration-none text-body item_nis " data1="' . $row->id . '" data2="'. $row->datasiswa->nis. '" data3="'. $row->datasiswa->nisn. '" data4="'. $row->datasiswa->namalengkap.'" data5="'. $row->datasiswa->ecard.'" data6="'. $row->idkelas.'"  data7="'. $row->iddatasiswa.'">'.($row->datasiswa ? $row->datasiswa->nis : '-').'</a> ';
                })
                ->addColumn('nisn', function ($row) {
                    return '<a href="javascript:void(0)" title="'. ($row->datasiswa ? $row->datasiswa->nisn : '-') .'" class="text-decoration-none text-body item_nisn " data1="' . $row->id . '" data2="'. $row->datasiswa->nis. '" data3="'. $row->datasiswa->nisn. '" data4="'. $row->datasiswa->namalengkap.'" data5="'. $row->datasiswa->ecard.'" data6="'. $row->idkelas.'"  data7="'. $row->iddatasiswa.'">'.($row->datasiswa ? $row->datasiswa->nisn : '-').'</a> ';
                })
                ->addColumn('namalengkap', function ($row) {
                    return '<a href="javascript:void(0)" title="'. ($row->datasiswa ? $row->datasiswa->namalengkap : '-') .'" class="text-decoration-none text-body item_namalengkap " data1="' . $row->id . '" data2="'. $row->datasiswa->nis. '" data3="'. $row->datasiswa->nisn. '" data4="'. $row->datasiswa->namalengkap.'" data5="'. $row->datasiswa->ecard.'" data6="'. $row->idkelas.'"  data7="'. $row->iddatasiswa.'">'.($row->datasiswa ? $row->datasiswa->namalengkap : '-').'</a> ';
                })
                ->addColumn('kelas', function ($row) {
                    return '<a href="javascript:void(0)" title="'. ($row->kelas ? $row->kelas->kelas : '-') .'" class="text-decoration-none text-body item_kelas " data1="' . $row->id . '" data2="'. $row->datasiswa->nis. '" data3="'. $row->datasiswa->nisn. '" data4="'. $row->datasiswa->namalengkap.'" data5="'. $row->datasiswa->ecard.'" data6="'. $row->idkelas.'"  data7="'. $row->iddatasiswa.'">'.($row->kelas ? $row->kelas->kelas : '-').'</a> ';
                })
                

                ->rawColumns([
                    'ecard','nis','nisn','namalengkap','kelas'
                ])


                ->make(true);

                return $data;

        }

    }
    
    function listkelas()
    {
        $tampil = Kelas::orderBy('idtingkat', 'asc')->orderBy('idkompetensi', 'asc')->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "'>" . $baris->kelas . "</option>";
        }
    }
    function listdataguru()
    {
        $tampil = Dataguru::with(['tempatlahir','pendidikan','statuspegawai','jk','agama','pangkat','statusprofesi'])
        ->orderBy('nama','asc')       
        ->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->id . "' disabled>" . $baris->nama . "</option>";
        }
    }
    
    function listjenistagihan()
    {
        $idkelas = session('idkelas');
        $tingkat = Kelas::where('id','=',$idkelas)->get();
        foreach ($tingkat as $baris) {
            $idtingkat = $baris->idtingkat;
        }
        $idtp = session('idtp');
        
        $tampil = Parametertagihan::where([['idtp','=',$idtp],['idtingkat','=',$idtingkat]])
            ->with(['tp', 'jenistagihan', 'dataguru', 'tingkat'])->get();
        foreach ($tampil as $baris) {
            echo "<option value='" . $baris->idjenistagihan ."'>" . $baris->jenistagihan->jenistagihan ."</option>";
            // echo "<option value='" . $baris->idjenistagihan . '-'.$baris->targettahun.'-'.$baris->targetbulan.'-'.$baris->dataguru->id."'>" . $baris->jenistagihan->jenistagihan ."</option>";
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
        
        $id1 = $request['id1'];
        $iddatasiswax = $request['iddatasiswa1'];
        if($iddatasiswax==''){
            $iddatasiswa = '0';
        }else{
            $iddatasiswa = $request['iddatasiswa1'];
        }
        $idtp = $request['idtp1'];
        $idkelas = $request['idkelas1'];
        $tampil = Datasiswa::where('id','=',$iddatasiswa)->get();
        
        session([
            'id' => $id1,
            'idtp' => $idtp,
            'idkelas' => $idkelas,
            'iddatasiswa' => $iddatasiswa,
            'ecard' => $tampil[0]->ecard ?? '',
            'nis' => $tampil[0]->nis ?? '',
            'nisn' => $tampil[0]->nisn ?? '',
            'namalengkap' => $tampil[0]->namalengkap ?? '',
            
        ]);
        
        return json_encode(array('data' => $tampil)); 
        
    }
    public function cariid(Request $request)
    {
        
        // $idtp = session('idtp');            
        $idtp = $request['idtp1'];           
        $cari = $request['cari1'];
        $cariid = Datasiswa::select('id')
            ->where('ecard','=',$cari)
            ->Orwhere('nis','=',$cari)
            ->Orwhere('nisn','=',$cari);
            
        $siswakelas = Siswakelas::select('iddatasiswa')
            ->whereIn('iddatasiswa',$cariid)
            ->where('idtp','=',$idtp);            
        $siswakelasx = Siswakelas::select('iddatasiswa')
            ->whereIn('iddatasiswa',$cariid)
            ->where('idtp','=',$idtp)
            ->count();

        $tampil=Siswakelas::select('idkelas')
            ->whereIn('iddatasiswa',$cariid)
            ->where('idtp','=',$idtp)
            ->get();
        foreach ($tampil as $baris) {
            $idkelas = $baris->idkelas;
        }
        
        $data = Datasiswa::select('*')->selectRaw($siswakelasx . ' as jmlx')->selectRaw($idkelas . ' as idkelas')
                ->whereIn('id',$siswakelas)
                ->where(function($q) use ($request){
                    $cari = $request['cari1'];
                    $q                    
                    ->where('ecard','=',$cari)
                    ->Orwhere('nis','=',$cari)
                    ->Orwhere('nisn','=',$cari);
                })
                
                ->with([
                    'tpmasuk', 
                    'statussiswa',
                    'kompetensi', 
                    'tempatlahir', 
                    'jk', 
                    'agama', 
                    'statusanak', 
                    'desa', 
                    'tinggal', 
                    'gd', 
                    'tempatlahirayah', 'agamaayah', 'pendidikanayah','desaayah',
                    'tempatlahiribu', 'agamaibu', 'pendidikanibu', 'desaibu',
                    'tempatlahirwali', 'agamawali', 'pendidikanwali','desawali',
                    'tpkeluar',
                    'alasankeluar',
                    'alasansetelahkeluar',
                ])->get();
         
        return json_encode(array('data' => $data));

    }

    public function nomorbukti(Request $request)
    {
        
        $tgltransaksi1=$request['tgltransaksi1'];
        $iddatasiswa1=$request['iddatasiswa1'];
        $idjenistagihan1=$request['idjenistagihan1'];
        $idkelas1=$request['idkelas1'];
        $idtp1 = $request['idtp1'];

        $tgl1 = Carbon::parse($tgltransaksi1)->format('Ymd');
        $ym1 = Carbon::parse($tgltransaksi1)->format('Ym');
        $d1 = Carbon::parse($tgltransaksi1)->format('d');
        $m1 = Carbon::parse($tgltransaksi1)->format('m');
        $y1 = Carbon::parse($tgltransaksi1)->format('Y');
        
        $jmldata = Tagihan::where('idjenistagihan','=',$idjenistagihan1)
            ->whereYear('tgltransaksi', $y1)
            ->whereMonth('tgltransaksi', $m1)
            ->count();
        if ($jmldata==0){
            $nomor = 1;    
        }else{
            $nomor = Tagihan::select('nomorb1')->where('idjenistagihan','=',$idjenistagihan1)
                ->whereYear('tgltransaksi', $y1)
                ->whereMonth('tgltransaksi', $m1)
                ->max('nomorb1')+1;
        }  

        if ($nomor<10){
            $no='0000'.$nomor;
        }else if($nomor<100){
            $no='000'.$nomor;
        }else if($nomor<1000){
            $no='00'.$nomor;
        }else if($nomor<10000){
            $no='0'.$nomor;
        }else{
            $no=''.$nomor;
        }

        $tampil=Jenistagihan::where('id','=',$idjenistagihan1)->get();
        foreach ($tampil as $baris) {
            $kode = $baris->kode;
        }

        $tampil=Kelas::where('id','=',$idkelas1)->with(['tingkat','kompetensi'])->get();
        foreach ($tampil as $baris) {
            $tingkat = $baris->tingkat->tingkat;
            $idtingkat = $baris->idtingkat;
        }

        //nomor kwitansi contoh : PTS1.10.202301.00005
        $nbx = $kode . '.' . $tingkat . '.' . $ym1 . '.' . $no;  
        $nomorbukti = "'$nbx'";

        $sudahbayar = Tagihan::select('bayar')
            ->where('idtp','=',$idtp1)
            ->where('iddatasiswa','=',$iddatasiswa1)
            ->where('idjenistagihan','=',$idjenistagihan1)
            ->sum('bayar');
 
        $tampil = Parametertagihan::where([['idtp','=',$idtp1],['idtingkat','=',$idtingkat],['idjenistagihan','=',$idjenistagihan1]])
            ->with(['tp', 'jenistagihan', 'dataguru', 'tingkat'])->get();
        foreach ($tampil as $baris) {
            $iddataguru = $baris->iddataguru;
            $targetbayar = $baris->targettahun;
        }

        $data = Agama::limit(1)
                ->selectRaw($nomorbukti . ' as nomorbukti')
                ->selectRaw($sudahbayar . ' as sudahbayar')
                ->selectRaw($nomor . ' as nomorb1')
                ->selectRaw($iddataguru . ' as iddataguru')
                ->selectRaw($targetbayar . ' as targetbayar')
                ->get();
         
        return json_encode(array('data' => $data));
        
    }

    public function printkwintansi()
    {
        
        $meminstansi = session('memnamasingkat');
        $remark = 'Halaman ini digunakan untuk menampilkan, menambah, mengubah dan menghapus <b>Print Kwitansi</b>.';
        $page = 'sips01::transaksi.print.bayartagihan_printkwitansi';
        $link = '/sips01/transaksi/print/bayartagihan_printkwitansi';
        $subtitle = 'transaksi';
        $caption = 'Print Kwintansi';
        $jmlhal = 2;

        $id = session('id');
        $iddatasiswa = session('iddatasiswa');
        $idkelas = session('idkelas');
        $kelas = Kelas::select('kelas')
            ->where('id','=',$idkelas)
            ->get();

        $tagihan = Tagihan::select('*')                        
            ->with(['datasiswa','jenistagihan','bulan', 'tp', 'dataguru'])
            ->where('id','=',$id)
            ->get();
        $nisn = $tagihan[0]->datasiswa->nisn;

        $pdf = Pdf::loadView($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Siswakelas::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get(),
            'tagihan' => $tagihan,
            'kelas' => $kelas,


        ])->setOptions(['defaultFont' => 'sans-serif', 'defaultFont' => 'sans-serif' ])->set_option('isHtml5ParserEnabled', true); 
        $pdf->set_paper(array(0, 0, 612.00, 936.00), 'portrait');
        
        return $pdf->stream('kwitansi_pembayaran_' . $nisn .'.pdf');

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
