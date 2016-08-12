<?php
namespace App\Transformers;

use App\Conversion;
use League\Fractal;

class ConversionTransformer extends Fractal\TransformerAbstract
{
    public function transform(Conversion $conversion)
    {
        return [
            'integer'      => (int) $conversion->numeral_id,
            'roman_numeral'   => $conversion->numeral->roman,
            'converted_at' => $conversion->updated_at->toDateTimeString()
        ];
    }
}