@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">Buat Listing Baru</div>

        <div class="card-body">
            <form action="" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_listing" class="form-label">Nama Listing</label>
                    <input type="text" class="form-control" id="nama_listing" name="nama_listing" value="" required>
                </div>
                <div class="mb-3">
                    <label for="jenis_listing" class="form-label">Jenis Listing</label>
                    <select class="form-select" name="jenis_listing">
                        <option value="rumah">Rumah</option>
                        <option value="apartemen">Apartemen</option>
                        <option value="tanah">Tanah</option>
                        <option value="ruko">Ruko</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="TipePenjualan" class="form-label">Tipe Penjualan</label>
                            <select class="form-select" id="TipePenjualan" name="TipePenjualan">
                                <option value="jual">Jual</option>
                                <option value="sewa">Sewa</option>
                            </select>
                        </div>    
                    </div>
                    <div class="col-6">
                    <div class="mb-3">
                            <label for="statusTanah" class="form-label">Status Tanah</label>
                            <select class="form-select" id="statusTanah" name="statusTanah">
                                <option value="SHM - Surat Hak Milik">SHM - Surat Hak Milik</option>
                                <option value="HGB - Hak Guna Bangunan">HGB - Hak Guna Bangunan</option>
                                <option value="Hak Pakai">Hak Pakai</option>
                            </select>
                        </div>     
                    </div>
                </div>
                <div class="mb-3">
                    <label for="kota" class="form-label">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" value="" required>
                </div>
                <div class="mb-3">
                    <label for="wilayah" class="form-label">Wilayah</label>
                    <input type="text" class="form-control" id="wilayah" name="wilayah" value="" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="harga" name="harga" value="" required>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="kamar" class="form-label">Kamar</label>
                            <input type="number" class="form-control" id="kamar" name="kamar" value="" required>
                        </div>    
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="kamar_mandi" class="form-label">Kamar Mandi</label>
                            <input type="number" class="form-control" id="kamar_mandi" name="kamar_mandi" value="" required>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="luas" class="form-label">Luas</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="luas" name="luas" value="" required>
                                <span class="input-group-text" id="basic-addon1">m<sup>2</sup></span>
                            </div>
                        </div>    
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label for="garasi" class="form-label">Garasi</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="garasi" name="garasi" value="" required>
                                <span class="input-group-text" id="basic-addon1">Mobil</span>
                            </div>
                        </div>   
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label>Deskripsi Tambahan</label>
                        <textarea style="border: solid 1px grey" class="form-control" name="desc" id="" cols="30" rows="20" required></textarea>
                    </div>
                </div>
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

        
    </div>
@endsection
