<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pengeluaran;
use App\User;
use JWTAuth;

class PengeluaranController extends Controller
{
    public function index()
    {
        $data = Pengeluaran::all();
        return ($data);
    }

    public function show($id)
    {
        $data = Pengeluaran::find($id);
        return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $transaksi = new Pengeluaran();
        $user = JWTAuth::parseToken()->authenticate();

        $transaksi->username = $user->username;
        $transaksi->nama_transaksi = $request->nama_transaksi;
        $transaksi->jenis_pengeluaran = $request->jenis_pengeluaran;
        $transaksi->jumlah_pengeluaran = $request->jumlah_pengeluaran;
        $saldo_awal = $user->jml_saldo;

        if($request->jenis_pengeluaran == "kredit"){
            $saldo_akhir = $user->jml_saldo - $request->jumlah_pengeluaran;
        }
        elseif($request->jenis_pengeluaran == "debit"){
            $saldo_akhir = $user->jml_saldo + $request->jumlah_pengeluaran;
        }else{
            return "jenis Pengeluaran";
        }
        $transaksi->save();

        $user->jml_saldo = $saldo_akhir;
        $user->save();

        return "Username        : ".$user->username."
             Jenis Pembayaran    : ".$request->jenis_pengeluaran."
             Nama Transaksi   : ".$request->nama_transaksi."
             Saldo Awal : Rp.".$saldo_awal."
             Jumlah Pembayaran : Rp.".$request->jumlah_pengeluaran."
             Saldo Akhir : Rp.".$saldo_akhir;
    }

    /**
     * Store a newly created resource in storage.
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function edit(Request $request, $id)
    {
        $data = Pengeluaran::find($id);
        
        $data->username = $request->username;
        $data->jenis = $request->jenis;
        $data->nama_transaksi = $request->nama_transaksi;
        $data->jumlah = $request->jumlah;
        $data->save();

        return $data;
    }
}
