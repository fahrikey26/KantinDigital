<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class KantinCon extends Controller
{
    public function tampil()
    {
        $jmlkaryawan = DB::table('karyawan')->count();

        $poinkaryawan = DB::table('karyawan')
        ->select('karyawan.point')
        ->where('id_karyawan',Auth::user()->id_karyawan)
        ->first();

        $jmlkantin = DB::table('kantin')->count();

        $jmlmenu = DB::table('menu')->count();

        $jmltransaksi = DB::table('transaksi')->count();

        $kantin = DB::table('kantin')->get();

        return view('admin.kantin', ['poinkaryawan'=>$poinkaryawan,'kantin' => $kantin, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbkantin
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        $jmlkantin = DB::table('kantin')->count();
        if($jmlkantin>=10){
            $idkantin2="Kan0".$jmlkantin+1;
        }
        else{
            $idkantin2="Kan00".$jmlkantin+1;
        }
        DB::table('kantin')->insert([
            'id_kantin' => $idkantin2,
            'nama_kantin' => $request->nama,
            'pemilik' => $request->pemilik,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('users')->insert([
            'name' => $request->pemilik,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $filename,
            'role' => 'pedagang',
            'id_karyawan'=> $idkantin2,
            'created_at' => date('Y-m-d H:i:s')
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
        DB::table('menu')->where('id_kantin', $id)->delete();
        DB::table('users')->where('id_karyawan', $id)->delete();
        // passing data kantin yang didapat ke view edit.blade.php
        return redirect('/kantin/tampil');
    }
}
