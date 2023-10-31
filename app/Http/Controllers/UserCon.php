<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class UserCon extends Controller
{
    public function tampil()
    {

        $jmlkaryawan = DB::table('karyawan')->count();
        $jmlkantin = DB::table('kantin')->count();
        $jmlmenu = DB::table('menu')->count();
        $jmltransaksi = DB::table('transaksi')->count();
        $user = DB::table('users')->get();
        return view('admin.user', ['user' => $user, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        // insert data ke table tbuser
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);

        DB::table('users')->insert([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $filename,
            'created_at' => date('Y-m-d')
        ]);
        // alihkan halaman ke route user
        Session::flash('message', 'Input Berhasil.');
        return redirect('/user/tampil');
    }

    public function storeupdate(Request $request)
    {
        // update data user
        $file = $request->file('foto');
        $filename = $request->nama . "." . $file->getClientOriginalExtension();
        $file->move(public_path('assets/img'), $filename);
        if (!empty($request->password)) {
        DB::table('users')->where('id', $request->iduser)->update([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'foto' => $filename,
            'created_at' => date('Y-m-d')
        ]);
        }
        else{
            DB::table('users')->where('id', $request->iduser)->update([
                'name' => $request->nama,
                'email' => $request->email,
                'foto' => $filename,
                'created_at' => date('Y-m-d')
            ]);
        }

        // alihkan halaman ke halaman user
        return redirect('/user/tampil');
    }

    public function delete($id)
    {
        // mengambil data user berdasarkan id yang dipilih
        DB::table('users')->where('id', $id)->delete();
        // passing data user yang didapat ke view edit.blade.php
        return redirect('/user/tampil');
    }
}
