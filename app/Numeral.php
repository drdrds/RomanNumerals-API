<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Numeral extends Model
{
    // The primary_key is id - is the integer converted and is not going to be auto incrementing
    // records will be added as and when integers are first converted.
    public $incrementing=false;
    protected $fillable=['id'];

    /**
     * Get the conversions for this integer/Numeral
     */
    public function conversions()
    {
        return $this->hasMany('App\Conversion');
    }
    
    
    // The functions below offer and alternative to storing the count in the Numerals table. 
    
//    public function conversionCountRelation()
//    {
//        return $this->hasOne('Conversion')->selectRaw('numeral_id, count(*) as count')
//            ->groupBy('numeral_id');
//    }
//
//    public function getConversionCountAttribute()
//    {
//        return $this->conversionCountRelation ?
//            $this->commentsCountRelation->count : 0;
//    }
    
}
