<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class MenuCon extends Controller
{
    public function home()
    {
        $menu = DB::table('menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->distinct()
            ->get();
        return view('utama', ['menu' => $menu]);
    }

    public function tampil()
    {
        $jmlkaryawan = DB::table('karyawan')->count();

        $poinkaryawan = DB::table('karyawan')
        ->select('karyawan.point')
        ->where('id_karyawan',Auth::user()->id_karyawan)
        ->first();

        $jmlkantin = DB::table('kantin')->count();

        if(Auth::user()->role == 'admin'){
            $jmlmenu = DB::table('menu')->count();

            $menu = DB::table('menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();

            $jmltransaksi = DB::table('transaksi')->count();

            $kantin = DB::table('kantin')->get();
        }

        elseif(Auth::user()->role == 'karyawan'){
            $jmltransaksi = DB::table('transaksi')
            ->where('transaksi.id_karyawan',Auth::user()->id_karyawan)
            ->count();

            $jmlmenu = DB::table('menu')
            ->where('id_kantin',Auth::user()->id_karyawan)
            ->count();

            $menu = DB::table('menu')
            ->where('menu.id_kantin',Auth::user()->id_karyawan)
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();
        }

        elseif(Auth::user()->role == 'pedagang'){
            $jmltransaksi = DB::table('transaksi')
            ->where('kantin.id_kantin',Auth::user()->id_karyawan)
            ->join('menu','menu.id_menu','=','transaksi.id_menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->count();

            $jmlmenu = DB::table('menu')
            ->where('id_kantin',Auth::user()->id_karyawan)
            ->count();

            $menu = DB::table('menu')
            ->where('menu.id_kantin',Auth::user()->id_karyawan)
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();

            $kantin = DB::table('kantin')
            ->select('kantin.id_kantin','kantin.nama_kantin')
            ->where('menu.id_kantin',Auth::user()->id_karyawan)
            ->join('menu','menu.id_kantin','=','kantin.id_kantin')
            ->distinct()
            ->get();
        }

        return view('admin.menu', ['kantin'=>$kantin,'poinkaryawan'=>$poinkaryawan,'menu' => $menu, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbmenu
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);

        $jmlmenu = DB::table('menu')->count();

        if($jmlmenu>=10){
            $idmenu="Menu0".$jmlmenu+1;
        }
        else{
            $idmenu="Menu00".$jmlmenu+1;
        }

        DB::table('menu')->insert([
            'id_menu' => $idmenu,
            'nama_menu' => $request->nama,
            'id_kantin' => $request->idkantin,
            'point' => $request->point,
            'foto' => $filename,
            'created_at' => date('Y-m-d')
        ]);

        // alihkan halaman ke route menu
        Session::flash('message', 'Input Berhasil.');
        return redirect('/menu/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data menu
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);

        DB::table('menu')->where('id_menu', $request->idmenu)->update([
            'nama_menu' => $request->nama,
            'id_kantin' => $request->idkantin,
            'point' => $request->point,
            'foto' => $filename,
            'created_at' => date('Y-m-d')
        ]);

        // alihkan halaman ke halaman menu
        return redirect('/menu/tampil');
    }

    public function delete($id)
    {
        // mengambil data menu berdasarkan id yang dipilih
        DB::table('menu')->where('id_menu', $id)->delete();
        // passing data menu yang didapat ke view edit.blade.php
        return redirect('/menu/tampil');
    }
}
