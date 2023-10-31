<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class KaryawanCon extends Controller
{
    public function tampil()
    {
        $jmlkaryawan = DB::table('karyawan')->count();
        $jmlkantin = DB::table('kantin')->count();
        $jmlmenu = DB::table('menu')->count();
        $jmltransaksi = DB::table('transaksi')->count();
        $karyawan = DB::table('karyawan')->get();
        return view('admin.karyawan', ['karyawan' => $karyawan, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbkaryawan
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);

        DB::table('karyawan')->insert([
            'id_karyawan' => $request->idkaryawan,
            'nama_karyawan' => $request->nama,
            'foto' => $filename,
            'point' => $request->poin,
            'created_at' => date('Y-m-d')
        ]);
        DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $filename,
            'role' => 'karyawan',
            'created_at' => date('Y-m-d')
        ]);
        // alihkan halaman ke route karyawan
        Session::flash('message', 'Input Berhasil.');
        return redirect('/karyawan/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data karyawan
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        DB::table('karyawan')->where('id_karyawan', $request->idkaryawan)->update([
            'nama_karyawan' => $request->nama,
            'foto' => $filename,
            'point' => $request->poin,
            'updated_at' => date('Y-m-d')
        ]);

        // alihkan halaman ke halaman karyawan
        return redirect('/karyawan/tampil');
    }

    public function delete($id)
    {
        // mengambil data karyawan berdasarkan id yang dipilih
        DB::table('karyawan')->where('id_karyawan', $id)->delete();
        // passing data karyawan yang didapat ke view edit.blade.php
        return redirect('/karyawan/tampil');
    }
}
