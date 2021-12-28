<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{


    public function listing_facilities()
    {
        return $this->hasOne(ListingFacility::class);
    }

    
    public static function boot() {
        parent::boot();

        static::deleting(function($listing) { // before delete() method call this
             $listing->listing_facilities()->delete();
        });
    }
}
