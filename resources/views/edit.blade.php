@extends('layouts.app')

@section('content')
<div class="card">
        <div class="card-header">Edit Listing - {{$listing->id_properti}}</div>

        <div class="card-body">
        <form action="/edit" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nama_listing" class="form-label">Nama Listing</label>
                <input type="text" class="form-control" id="nama_listing" name="nama_listing" value="{{$listing->nama_listing}}" required>
            </div>
            <div class="mb-3">
                <label for="jenis_listing" class="form-label">Jenis Listing</label>
                <select class="form-select" name="jenis_listing">
                    <option value="rumah" {{$listing->jenis_listing == "rumah" ? "selected" : ""}}>Rumah</option>
                    <option value="apartemen" {{$listing->jenis_listing == "apartemen" ? "selected" : ""}}>Apartemen</option>
                    <option value="tanah" {{$listing->jenis_listing == "tanah" ? "selected" : ""}}>Tanah</option>
                    <option value="ruko" {{$listing->jenis_listing == "ruko" ? "selected" : ""}}>Ruko</option>
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="TipePenjualan" class="form-label">Tipe Penjualan</label>
                        <select class="form-select" id="TipePenjualan" name="TipePenjualan">
                            <option value="jual" {{$listing->TipePenjualan == "jual" ? "selected" : ""}}>Jual</option>
                            <option value="sewa" {{$listing->TipePenjualan == "sewa" ? "selected" : ""}}>Sewa</option>
                        </select>
                    </div>    
                </div>
                <div class="col-6">
                <div class="mb-3">
                        <label for="statusTanah" class="form-label">Status Tanah</label>
                        <select class="form-select" id="statusTanah" name="statusTanah">
                            <option value="SHM - Surat Hak Milik" {{$listing->statusTanah == "SHM - Surat Hak Milik" ? "selected" : ""}}>SHM - Surat Hak Milik</option>
                            <option value="HGB - Hak Guna Bangunan" {{$listing->statusTanah == "HGB - Hak Guna Bangunan" ? "selected" : ""}}>HGB - Hak Guna Bangunan</option>
                            <option value="Hak Pakai" {{$listing->statusTanah == "Hak Pakai" ? "selected" : ""}}>Hak Pakai</option>
                        </select>
                    </div>     
                </div>
            </div>
            <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" value="{{$listing->kota}}" required>
            </div>
            <div class="mb-3">
                <label for="wilayah" class="form-label">Wilayah</label>
                <input type="text" class="form-control" id="wilayah" name="wilayah" value="{{$listing->wilayah}}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control" id="harga" name="harga" value="{{$listing->harga}}" required>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="kamar" class="form-label">Kamar</label>
                        <input type="number" class="form-control" id="kamar" name="kamar" value="{{$listing->kamar}}" required>
                    </div>    
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="kamar_mandi" class="form-label">Kamar Mandi</label>
                        <input type="number" class="form-control" id="kamar_mandi" name="kamar_mandi" value="{{$listing->kamar_mandi}}" required>
                    </div>    
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="luas" class="form-label">Luas</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="luas" name="luas" required value="{{$listing->luas}}">
                            <span class="input-group-text" id="basic-addon1">m<sup>2</sup></span>
                        </div>
                    </div>    
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="garasi" class="form-label">Garasi</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="garasi" name="garasi" required value="{{$listing->garasi}}">
                            <span class="input-group-text" id="basic-addon1">Mobil</span>
                        </div>
                    </div>   
                </div>
            </div>
            <div class="mb-3">
                    <div class="form-group">
                        <label>Deskripsi Tambahan</label>
                        <textarea style="border: solid 1px grey" class="form-control" name="desc" id="" cols="30" rows="20" required>{{$listing->desc}}</textarea>
                    </div>
                </div>
            <input type="hidden" required value="{{$listing->id_properti}}" name="id_properti">
            
            
            
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>

        
    </div>
@endsection
