<?php

namespace App\Http\Controllers;

use App\Models\Aplikasi;
use App\Models\Users;

class AdminController extends Controller
{
    public function index()
    {
        $meminstansi = session('memnamasingkat');
        $remark = 'Menu Dashboards/beranda';
        $page = 'admin.dashboards.beranda';
        $link = '/admin';
        $subtitle = 'Dashboard';
        $caption = 'Beranda';
        $jmlhal = 2;

        return view($page, [
            'title' => $meminstansi . ' | ' . $subtitle . ' | ' . $caption,
            'subtitle' => $subtitle,
            'caption' => $caption,
            'link' => $link,
            'remark' => $remark,
            'jmlhal' => $jmlhal,
            'tabel' => Users::SimplePaginate($jmlhal)->withQueryString(),
            'aplikasi' => Aplikasi::get()
        ]);
    }
}
