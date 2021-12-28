<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Listing;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listings = Listing::where('id_admin', Auth::id())->paginate(30);
        return view('mylisting', ['listings' => $listings]);
    }

    public function create(){
        return view('create');
    }

    public function proses_create(Request $request){
        $listing = new Listing;
        $listing->nama_listing = $request->nama_listing;
        $listing->jenis_listing = $request->jenis_listing;
        $listing->TipePenjualan = $request->TipePenjualan;
        $listing->statusTanah = $request->statusTanah;
        $listing->kota = $request->kota;
        $listing->wilayah = $request->wilayah;
        $listing->harga = $request->harga;
        $listing->kamar = $request->kamar;
        $listing->kamar_mandi = $request->kamar_mandi;
        $listing->luas = $request->luas;
        $listing->garasi = $request->garasi;
        $listing->desc = $request->desc;
        $listing->id_admin = Auth::id();

        
        //pembuatan ID Properti

        //jika data masih kosong
        if(count(Listing::all()) == 0){
            $listing->id_properti = 'ID00001';
        }
        
        $last_listing = Listing::orderBy('id_properti', 'desc')->first();
        $last_number = strtok($last_listing->id_properti, 'ID');
        $listing->id_properti = 'ID'.str_pad($last_number + 1,5,'0',STR_PAD_LEFT);

        $listing->save();

        return redirect('/home')->with(['message' => 'Listing Berhasil Dibuat!', 'alert-class' => 'alert-success']);
    }

    public function edit($id){
        $listing = Listing::where('id_properti', $id)->first();
        return view('edit', ['listing' => $listing]);
    }

    public function proses_edit(Request $request){
        $listing = Listing::where('id_properti', $request->id_properti)->first();
        $listing->nama_listing = $request->nama_listing;
        $listing->jenis_listing = $request->jenis_listing;
        $listing->TipePenjualan = $request->TipePenjualan;
        $listing->statusTanah = $request->statusTanah;
        $listing->kota = $request->kota;
        $listing->wilayah = $request->wilayah;
        $listing->harga = $request->harga;
        $listing->kamar = $request->kamar;
        $listing->kamar_mandi = $request->kamar_mandi;
        $listing->luas = $request->luas;
        $listing->garasi = $request->garasi;
        $listing->desc = $request->desc;

        $listing->save();

        return redirect('/home')->with(['message' => 'Perubahan Berhasil Disimpan!', 'alert-class' => 'alert-success']);
    }

    public function delete($id){
        $listing = Listing::where('id_properti', $id)->first();
        if($listing->id_admin == Auth::id()){
            $listing->delete();
            return redirect('/home')->with(['message' => 'Listing Berhasil Dihapus!', 'alert-class' => 'alert-success']);
        }

        else{
            return redirect('/home')->with(['message' => 'Anda Tidak Memiliki Kewenangan!', 'alert-class' => 'alert-danger']);
        }

        
    }

    public function testing(){
        //kasus 1
        $kasus1 = ratio('happy','happily');
        dd($kasus1);
    }
}
