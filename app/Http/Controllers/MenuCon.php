<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class MenuCon extends Controller
{
    public function home()
    {
        $menu = DB::table('menu')->get();
        return view('utama', ['menu' => $menu]);
    }

    public function tampil()
    {
        $jmlkaryawan = DB::table('karyawan')->count();
        $jmlkantin = DB::table('kantin')->count();
        $jmlmenu = DB::table('menu')->count();
        $jmltransaksi = DB::table('transaksi')->count();
        $menu = DB::table('menu')->get();
        return view('admin.menu', ['menu' => $menu, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbmenu
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        DB::table('menu')->insert([
            'id_menu' => $request->idmenu,
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
