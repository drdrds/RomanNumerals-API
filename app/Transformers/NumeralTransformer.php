<?php
namespace App\Transformers;

use App\Numeral;
use League\Fractal;

class NumeralTransformer extends Fractal\TransformerAbstract
{
	public function transform(Numeral $numeral)
	{
	    return [
	        'integer'      => (int) $numeral->id,
	        'roman_numeral'   => $numeral->roman,
	        'conversion_count'    => (int) $numeral->count,
	        'last_converted' => $numeral->updated_at->toDateTimeString()
	    ];
	}
}