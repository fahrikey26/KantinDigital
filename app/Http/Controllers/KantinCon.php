<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class KantinCon extends Controller
{
    public function tampil()
    {
        $jmlkaryawan = DB::table('karyawan')->count();
        $jmlkantin = DB::table('kantin')->count();
        $jmlmenu = DB::table('menu')->count();
        $jmltransaksi = DB::table('transaksi')->count();
        $kantin = DB::table('kantin')->get();
        return view('admin.kantin', ['kantin' => $kantin, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbkantin
        DB::table('kantin')->insert([
            'id_kantin' => $request->idkantin,
            'nama_kantin' => $request->nama,
            'pemilik' => $request->pemilik,
            'created_at' => date('Y-m-d')
        ]);
        // alihkan halaman ke route kantin
        Session::flash('message', 'Input Berhasil.');
        return redirect('/kantin/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data kantin

        DB::table('kantin')->where('id_kantin', $request->idkantin)->update([
            'nama_kantin' => $request->nama,
            'pemilik' => $request->pemilik,
            'created_at' => date('Y-m-d')
        ]);

        // alihkan halaman ke halaman kantin
        return redirect('/kantin/tampil');
    }

    public function delete($id)
    {
        // mengambil data kantin berdasarkan id yang dipilih
        DB::table('kantin')->where('id_kantin', $id)->delete();
        // passing data kantin yang didapat ke view edit.blade.php
        return redirect('/kantin/tampil');
    }
}
