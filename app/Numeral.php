<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Numeral
 * @package App
 * 
 * This model stores the integer conversions 
 * id is the primary_key - it is the integer converted and so is not auto incrementing
 * records are added (by passing the id) as and when integers are first converted;
 * the Roman Numeral representation is stored in $this->roman (as model is constructed);
 * and the Conversion count in $this->count;
 * The usual timestamps record when the a numeral was first and last converted. 
 * 
 * All conversions are logged in the Conversion model and can be accessed via 
 * the $this->conversions oneToMany Relations. 
 * 
 */
class Numeral extends Model
{
    public $incrementing=false;
    protected $fillable=['id'];


    /**
     * Numeral constructor.
     * @param array $attributes
     * 
     * The Roman Numeral representation of the id is found and set upon construction. 
     */
    public function __construct(array $attributes=array() ){

        parent::__construct($attributes);
        $converter=new IntegerConversion();
        $this->roman = $converter->toRomanNumerals($this->id);
    }

    /**
     * Get the conversions of this integer/Numeral
     */
    public function conversions()
    {
        return $this->hasMany('App\Conversion');
    }
    
}
