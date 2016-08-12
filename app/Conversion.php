<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conversion
 * @package App
 *
 * This model logs all conversions.
 * It simply stores the integer converted as a foreign key linking to the numerals table.
 * The standard timestamps store the time of the conversion.
 *
 */
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
