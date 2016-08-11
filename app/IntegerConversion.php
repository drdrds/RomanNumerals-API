<?php

namespace App;

class IntegerConversion implements IntegerConversionInterface {

    private $symbols = [
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1
    ];


    public function toRomanNumerals($integer)
    {
        if ( $integer<1 || $integer >3999) return "Integer out of range";

        $result='';
        foreach( $this->symbols as $symbol => $value) {
            while ($integer>=$value) {
                $result.=$symbol;
                $integer-=$value;
            }

        }

        return $result;

    }
}