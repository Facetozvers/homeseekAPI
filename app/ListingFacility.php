<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingFacility extends Model
{
    protected $table = 'listing_facilities';

    public function listings(){
        return $this->belongsTo('App\Listing');
    }
}
