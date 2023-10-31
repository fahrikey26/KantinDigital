<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class TransaksiCon extends Controller
{
    public function tampil()
    {
        $jmlkaryawan = DB::table('karyawan')->count();
        $jmlkantin = DB::table('kantin')->count();
        $jmlmenu = DB::table('menu')->count();
        $jmltransaksi = DB::table('transaksi')->count();
        $transaksi = DB::table('transaksi')->get();
        return view('admin.transaksi', ['transaksi' => $transaksi, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbtransaksi

        DB::table('transaksi')->insert([
            'id_transaksi' => $request->idtransaksi,
            'id_karyawan' => $request->idkaryawan,
            'id_menu' => $request->idmenu,
            'created_at' => date('Y-m-d')
        ]);
        // alihkan halaman ke route transaksi
        Session::flash('message', 'Input Berhasil.');
        return redirect('/transaksi/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data transaksi

        DB::table('transaksi')->where('id_transaksi', $request->idtransaksi)->update([
            'id_karyawan' => $request->idkaryawan,
            'id_menu' => $request->idmenu,
            'created_at' => date('Y-m-d')
        ]);

        // alihkan halaman ke halaman transaksi
        return redirect('/transaksi/tampil');
    }

    public function delete($id)
    {
        // mengambil data transaksi berdasarkan id yang dipilih
        DB::table('transaksi')->where('id_transaksi', $id)->delete();
        // passing data transaksi yang didapat ke view edit.blade.php
        return redirect('/transaksi/tampil');
    }
}
