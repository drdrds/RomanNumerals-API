<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{

    protected $fillable = [ 'numeral_id'];
    
    
    /**
     * Define the relationship to the Numeral that is being converted.
     */
    public function numeral()
    {
        return $this->belongsTo('App\Numeral');
    }
}
