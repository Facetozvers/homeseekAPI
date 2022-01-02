<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use App\ListingFacility;

class SearchController extends Controller
{
    public function beli(Request $request){
        //mengambil semua data dari database dan gunakan filter bila ada
        $query = Listing::where('TipePenjualan','=','jual')
                ->where( function($query) use($request){
                    if(isset($request->properti)){
                        if($request->properti == 'semua'){
                            return 0;
                        }
                        else{
                            return $query->from('listings')->where('jenis_listing',$request->properti);
                        }
                    }
                    
                    })
                ->where( function($query) use($request){
                    return $request->minHarga ?
                        $query->from('listings')->where('harga', '>=', $request->minHarga) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxHarga ?
                        $query->from('listings')->where('harga', '<=', $request->maxHarga) : '';
                    })
                ->where( function($query) use($request){
                    return $request->minLuas ?
                        $query->from('listings')->where('luas', '>=', $request->minLuas) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxLuas ?
                        $query->from('listings')->where('luas', '<=', $request->maxLuas) : '';
                    })
                ->where( function($query) use($request){
                    return $request->minKamar ?
                        $query->from('listings')->where('kamar', '>=', $request->minKamar) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxKamar ?
                        $query->from('listings')->where('kamar', '<=', $request->maxKamar) : '';
                    })
                ->where( function($query) use($request){
                    return $request->minKamarMandi ?
                        $query->from('listings')->where('kamar_mandi', '>=', $request->minKamarMandi) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxKamarMandi ?
                        $query->from('listings')->where('kamar_mandi', '<=', $request->maxKamarMandi) : '';
                    })
                ->with('listing_facilities')->get();


        //fungsi filter fasilitas
        if($request->fasilitas != NULL){
            $query = $query->filter(function($listing) use($request){
                for($i = 0; $i < count($request->fasilitas); $i++){
                    if($request->fasilitas[$i] == 'swimming_pool'){
                        if($listing->listing_facilities->swimming_pool != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'carport'){
                        if($listing->listing_facilities->carport != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'gym'){
                        if($listing->listing_facilities->gym != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'security'){
                        if($listing->listing_facilities->security != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'garden'){
                        if($listing->listing_facilities->garden != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'restaurant'){
                        if($listing->listing_facilities->restaurant != 1){
                            break;
                        }
                    }
                    else{
                        break;
                    }

                    if($i == count($request->fasilitas) - 1){
                        //jika item bertahan sampai terakhir berarti filter memenuhi
                        return $listing;
                    }
                }
            });
        }        


        //jalankan fuzzy string matching jika terdapat query
        if(strlen($request->q) > 0){
            $listings = $query->filter(function($listing) use ($request) {
                $searchNama = fuzzy_string_matching($request->q, $listing->nama_listing);
                $searchKota = fuzzy_string_matching($request->q, $listing->kota);
                $searchWilayah = fuzzy_string_matching($request->q, $listing->wilayah);
                $searchID = fuzzy_string_matching($request->q, $listing->id_properti);
                $searchDesc = fuzzy_string_matching($request->q, $listing->desc);
                
                
                $ratio = max($searchNama, $searchKota, $searchWilayah, $searchID, $searchDesc);
                
                if($ratio >= 0.7){
                    $listing->ratio = $ratio;
                    return $listing;
                }
            })->sortByDesc('ratio')->values();
            return json_encode($listings, 200);
        }

        else{
            return json_encode($query, 200);
        }
            
        
        
    }

    public function sewa(Request $request){
        //mengambil semua data dari database dan gunakan filter bila ada
        $query = Listing::where('TipePenjualan','=','sewa')
                ->where( function($query) use($request){
                    if(isset($request->properti)){
                        if($request->properti == 'semua'){
                            return 0;
                        }
                        else{
                            return $query->from('listings')->where('jenis_listing',$request->properti);
                        }
                    }
                    
                    })
                ->where( function($query) use($request){
                    return $request->minHarga ?
                        $query->from('listings')->where('harga', '>=', $request->minHarga) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxHarga ?
                        $query->from('listings')->where('harga', '<=', $request->maxHarga) : '';
                    })
                ->where( function($query) use($request){
                    return $request->minLuas ?
                        $query->from('listings')->where('luas', '>=', $request->minLuas) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxLuas ?
                        $query->from('listings')->where('luas', '<=', $request->maxLuas) : '';
                    })
                ->where( function($query) use($request){
                    return $request->minKamar ?
                        $query->from('listings')->where('kamar', '>=', $request->minKamar) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxKamar ?
                        $query->from('listings')->where('kamar', '<=', $request->maxKamar) : '';
                    })
                ->where( function($query) use($request){
                    return $request->minKamarMandi ?
                        $query->from('listings')->where('kamar_mandi', '>=', $request->minKamarMandi) : '';
                    })
                ->where( function($query) use($request){
                    return $request->maxKamarMandi ?
                        $query->from('listings')->where('kamar_mandi', '<=', $request->maxKamarMandi) : '';
                    })
                ->with('listing_facilities')->get();


        //fungsi filter fasilitas
        if($request->fasilitas != NULL){
            $query = $query->filter(function($listing) use($request){
                for($i = 0; $i < count($request->fasilitas); $i++){
                    if($request->fasilitas[$i] == 'swimming_pool'){
                        if($listing->listing_facilities->swimming_pool != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'carport'){
                        if($listing->listing_facilities->carport != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'gym'){
                        if($listing->listing_facilities->gym != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'security'){
                        if($listing->listing_facilities->security != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'garden'){
                        if($listing->listing_facilities->garden != 1){
                            break;
                        }
                    }
                    else if($request->fasilitas[$i] == 'restaurant'){
                        if($listing->listing_facilities->restaurant != 1){
                            break;
                        }
                    }
                    else{
                        break;
                    }

                    if($i == count($request->fasilitas) - 1){
                        //jika item bertahan sampai terakhir berarti filter memenuhi
                        return $listing;
                    }
                }
            });
        }        


        //jalankan fuzzy string matching jika terdapat query
        if(strlen($request->q) > 0){
            $listings = $query->filter(function($listing) use ($request) {
                $searchNama = fuzzy_string_matching($request->q, $listing->nama_listing);
                $searchKota = fuzzy_string_matching($request->q, $listing->kota);
                $searchWilayah = fuzzy_string_matching($request->q, $listing->wilayah);
                $searchID = fuzzy_string_matching($request->q, $listing->id_properti);
                $searchDesc = fuzzy_string_matching($request->q, $listing->desc);
                
                
                $ratio = max($searchNama, $searchKota, $searchWilayah, $searchID, $searchDesc);
                
                if($ratio >= 0.7){
                    $listing->ratio = $ratio;
                    return $listing;
                }
            })->sortByDesc('ratio')->values();
            return json_encode($listings, 200);
        }

        else{
            return json_encode($query, 200);
        }
            
        
        
    }


    public function misah(){
        $listings = Listing::all();
        foreach($listings as $li){
            $tok1 = strtok($li->wilayah, ",");
            $parts1 = [];

                $parts1[] = $tok1;
                $tok1 = strtok("");
                $parts1[] = $tok1;
            

            $li->wilayah = $parts1[0];
            $li->kota  = $parts1[1];
            $li->save();
        }

        echo 'ok';
    }

    public function inputData(){
        $listings = Listing::all();
        foreach($listings as $listing){
            $facilities = new ListingFacility;
            $facilities->listing_id = $listing->id;
            $facilities->carport = rand(0,1);
            $facilities->garden = rand(0,1);
            $facilities->gym = rand(0,1);
            $facilities->swimming_pool = rand(0,1);
            $facilities->security = rand(0,1);
            $facilities->restaurant = rand(0,1);

            $facilities->save();
        }

        echo ('OK');
    }
}
