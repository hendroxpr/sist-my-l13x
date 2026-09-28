<?php

namespace Modules\Evot01\Http\Controllers\Laporan;

use App\Http\Controllers\Controller;
use App\Models\Aplikasi;
use App\Models\Menusub;
use Modules\Evot01\Models\Kandidat;
use Modules\Evot01\Models\Pemilih;
use Yajra\DataTables\Facades\DataTables;

class HasilvotingController extends Controller
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
        $remark = 'Halaman ini digunakan untuk menampilkan <b>Hasil Voting</b>.';
        $page = 'evot01::laporan.hasilvoting';
        $link = '/evot01/laporan/hasilvoting';
        $subtitle = 'Laporan';
        $caption = 'Hasil Voting';
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
     * Show the specified resource.
     */
    public function show()
    {
        
        $datax = DataTables::of(
            Kandidat::orderBy('nomor','asc')
                ->with([
                     
                ])
            );

        $data = $datax
        ->addIndexColumn()
        
        ->addColumn('foto', function ($row) {
            return $row->foto ? '<img class="mb-4" style="width: 100%" src="'. route('front.index') . '/storage/'. $row->foto.'">' : '';
        })

        ->addColumn('hasil', function ($row) {
            $hasilx = Pemilih::where('pilihan','=',$row->nomor)
            ->count();
            return $hasilx ? $hasilx : '0';
        })

        ->addColumn('persen', function ($row) {
            $total = Pemilih::count();
            $hasil = Pemilih::where('pilihan','=',$row->nomor)
            ->count();            
            $persen = $hasil / $total * 100;
            $persenx = number_format($persen,2) . '%';
            return $persenx ? $persenx : '0';
        })

        ->addColumn('progress', function ($row) {
            $total = Pemilih::count();
            $hasil = Pemilih::where('pilihan','=',$row->nomor)
            ->count(); 
           
            return '<progress style="width: 100%; height: 60px;" id="file" value="' . $hasil . '" max="' . $total . '"> ' . $hasil . '" </progress>';                   
                    
        })
        
        ->rawColumns([
            'hasil','persen','progress'
            ])


        ->make(true);

        return $data;
    }

   
    
}
