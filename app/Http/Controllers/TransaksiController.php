<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(5);
        return view('kasir.transaksi.index', compact('transaksis'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kasir.transaksi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'nama_menu'=> 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'nama_pegawai' => 'required',
        ]);
        Transaksi::create($request->all());
     
        return redirect()->route('transaksi.index')->with('success','Berhasil Menyimpan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        return view('kasir.transaksi.edit',compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'nama_pelanggan' => 'required',
            'nama_menu' => 'required',
            'jumlah' => 'required',
            'total_harga' => 'required',
            'nama_pegawai' => 'required',
        ]);
            
        $transaksi->update($request->all());
    
        return redirect()->route('transaksi.index')->with('success','Berhasil Update !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
        {
         $kategori = Transaksi::findOrFail($id);
         if($kategori){
             $kategori->delete();
             return redirect()->route('transaksi.index');
         }
         return redirect()->route('transaksi.index')->with('success','Berhasil Hapus !');
         }
    //  public function delete($id)
    // {
    //     $transaksi = Transaksi::find($id);
    //     $transaki->delete();
    //     return redirect()->route('transaksi.index')->with('success','Berhasil Hapus !'); 
    // }
}
