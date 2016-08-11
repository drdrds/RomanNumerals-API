<?php
namespace App\Transformers;

use App\Conversion;
use League\Fractal;

class ConversionTransformer extends Fractal\TransformerAbstract
{
    public function transform(Conversion $conversion)
    {
        return [
            'integer'      => (int) $conversion->id,
            'roman'   => $conversion->numeral->roman,
            'converted_at' => $conversion->updated_at->toDateTimeString()
        ];
    }
}