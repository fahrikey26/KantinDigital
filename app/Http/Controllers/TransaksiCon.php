<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Session;

class TransaksiCon extends Controller
{
    public function tampil()
    {
        //banyak karyawan
        $jmlkaryawan = DB::table('karyawan')->count();

        //banyak kantin
        $jmlkantin = DB::table('kantin')->count();

        if(Auth::user()->role == 'admin'){
            //jumlah point keseluruhan
            $jumlahpoin = DB::table('transaksi')
            ->sum('transaksi.jumlahpoin');

            //banyak menu
            $jmlmenu = DB::table('menu')->count();

            //data nama kantin dengan join
            $menu = DB::table('menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();

            //banyak transaksi
            $jmltransaksi = DB::table('transaksi')->count();

            //data nama karyawan dan nama menu dengan join
            $transaksi = DB::table('transaksi')
            ->select('transaksi.jumlahpoin','menu.nama_menu','menu.point','karyawan.nama_karyawan','transaksi.created_at','transaksi.id_transaksi','transaksi.banyak','transaksi.id_karyawan','transaksi.id_menu')
            ->join('menu','menu.id_menu','=','transaksi.id_menu')
            ->join('karyawan','karyawan.id_karyawan','=','transaksi.id_karyawan')
            ->get();

            $poinkaryawan = DB::table('karyawan')
            ->select('karyawan.point')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->first();
        }

        elseif(Auth::user()->role == 'karyawan'){
            $jmltransaksi = DB::table('transaksi')
            ->where('transaksi.id_karyawan',Auth::user()->id_karyawan)
            ->count();

            $transaksi = DB::table('transaksi')
            ->select('transaksi.jumlahpoin','menu.nama_menu','menu.point','karyawan.nama_karyawan','transaksi.created_at','transaksi.id_transaksi','transaksi.banyak','transaksi.id_karyawan','transaksi.id_menu')
            ->where('transaksi.id_karyawan',Auth::user()->id_karyawan)
            ->join('menu','menu.id_menu','=','transaksi.id_menu')
            ->join('karyawan','karyawan.id_karyawan','=','transaksi.id_karyawan')
            ->get();

            $poinkaryawan = DB::table('karyawan')
            ->select('karyawan.point')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->first();

            //jumlah point yang karyawan tertentu pakai
            $jumlahpoin = DB::table('transaksi')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->sum('transaksi.jumlahpoin');

            //banyak menu yang dimiliki kantin tertentu
            $jmlmenu = DB::table('menu')
            ->where('id_kantin',Auth::user()->id_karyawan)
            ->count();

            //data nama menu pada kantin tertentu dengan join
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

            $transaksi = DB::table('transaksi')
            ->select('karyawan.nama_karyawan','transaksi.jumlahpoin','menu.nama_menu','menu.point','kantin.nama_kantin','transaksi.created_at','transaksi.id_transaksi','transaksi.banyak','transaksi.id_karyawan','transaksi.id_menu')
            ->where('kantin.id_kantin',Auth::user()->id_karyawan)
            ->join('menu','menu.id_menu','=','transaksi.id_menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->join('karyawan','karyawan.id_karyawan','=','transaksi.id_karyawan')
            ->get();

            $poinkaryawan = DB::table('karyawan')
            ->select('karyawan.point')
            ->where('id_karyawan',Auth::user()->id_karyawan)
            ->first();

            //jumlah point yang karyawan tertentu pakai
            $jumlahpoin = DB::table('transaksi')
            ->where('kantin.id_kantin',Auth::user()->id_karyawan)
            ->join('menu','menu.id_menu','=','transaksi.id_menu')
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->sum('transaksi.jumlahpoin');

            //banyak menu yang dimiliki kantin tertentu
            $jmlmenu = DB::table('menu')
            ->where('id_kantin',Auth::user()->id_karyawan)
            ->count();

            //data nama menu pada kantin tertentu dengan join
            $menu = DB::table('menu')
            ->where('menu.id_kantin',Auth::user()->id_karyawan)
            ->join('kantin','kantin.id_kantin','=','menu.id_kantin')
            ->get();
        }

        return view('admin.transaksi', ['jumlahpoin'=>$jumlahpoin,'poinkaryawan'=>$poinkaryawan,'transaksi' => $transaksi, 'jmlkaryawan' => $jmlkaryawan,'jmlkantin' => $jmlkantin,'jmlmenu' => $jmlmenu,'jmltransaksi' => $jmltransaksi]);
    }

    public function storeinput(Request $request)
    {
        $poinkaryawan=DB::table('karyawan')
        ->select('karyawan.point')
        ->where('id_karyawan', Auth::user()->id_karyawan)
        ->first();
        $poinjajan=$request->poin * $request->banyak;

        if($poinkaryawan->point>=$poinjajan){

            // insert data ke table tbtransaksi
            $jmltransaksi = DB::table('transaksi')->count();

            if($jmltransaksi>=10){
                $jmltransaksi2="Trans0".$jmltransaksi+1;
            }
            else{
                $jmltransaksi2="Trans00".$jmltransaksi+1;
            }
            DB::table('transaksi')->insert([
                'id_transaksi' => $jmltransaksi2,
                'id_karyawan' => Auth::user()->id_karyawan,
                'id_menu' => $request->idmenu,
                'banyak' => $request->banyak,
                'jumlahpoin' => $poinjajan,
                'created_at' => date('Y-m-d H:i:s')
            ]);

            $sisapoin=$poinkaryawan->point - $poinjajan;
            DB::table('karyawan')
            ->where('id_karyawan', Auth::user()->id_karyawan)
            ->update([
                'point' => $sisapoin,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            // alihkan halaman ke route transaksi
            Session::flash('message2', 'Jajan Berhasil.');
        }
        else{
            Session::flash('message', 'Poin Anda Kurang.');
        }
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
