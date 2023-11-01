<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class DashboardCon extends Controller
{
    public function index()
    {
        $jmlkantin = DB::table('kantin')->count();

        $jmlkaryawan = DB::table('karyawan')->count();

        if(Auth::user()->role == 'admin'){
            $jmlmenu = DB::table('menu')->count();

            $menu = DB::table('menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();

            $poinkaryawan = DB::table('karyawan')
            ->select('karyawan.point')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->first();

            $jmltransaksi = DB::table('transaksi')->count();
        }

        elseif(Auth::user()->role == 'karyawan'){
            $jmlmenu = DB::table('menu')
            ->where('id_kantin',Auth::user()->id_karyawan)
            ->count();

            $menu = DB::table('menu')
            ->where('menu.id_kantin',Auth::user()->id_karyawan)
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();

            $poinkaryawan = DB::table('karyawan')
            ->select('karyawan.point')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->first();

            $jmltransaksi = DB::table('transaksi')
            ->where('transaksi.id_karyawan',Auth::user()->id_karyawan)
            ->count();
        }

        elseif(Auth::user()->role == 'pedagang'){
            $jmlmenu = DB::table('menu')
            ->where('id_kantin',Auth::user()->id_karyawan)
            ->count();

            $menu = DB::table('menu')
            ->where('menu.id_kantin',Auth::user()->id_karyawan)
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();

            $poinkaryawan = DB::table('karyawan')
            ->select('karyawan.point')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->first();

            $jmltransaksi = DB::table('transaksi')
            ->where('kantin.id_kantin',Auth::user()->id_karyawan)
            ->join('menu','menu.id_menu','=','transaksi.id_menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->count();
        }

        Session::flash('message', 'Selamat datang ');
        Session::flash('message2', 'Welcome');
        return view('admin.index', ['poinkaryawan'=>$poinkaryawan,'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }
}
