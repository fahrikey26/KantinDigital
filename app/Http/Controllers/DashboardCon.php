<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class DashboardCon extends Controller
{
    public function index()
    {
        $jmlkaryawan = DB::table('karyawan')->count();
        $jmlkantin = DB::table('kantin')->count();
        $jmlmenu = DB::table('menu')->count();
        $jmltransaksi = DB::table('transaksi')->count();
        Session::flash('message', 'Selamat datang ');
        Session::flash('message2', 'Welcome');
        return view('admin.index', ['jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }
}
