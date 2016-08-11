<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
use App\IntegerConversion;
use App\Conversion;
use App\Numeral;
use Carbon\Carbon;
use App\Transformers\NumeralTransformer;
use App\Transformers\ConversionTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;




class ApiController extends BaseController
{
    protected $fractal;

    public function __construct(){
        $this->fractal = new Manager;
    }

    /**
     * @param $integer
     * @return mixed
     */
    public function convert($integer) {

        if ($integer <0 || $integer>3999 ) {
            return $this->respondWithError("ERROR: Arabic Integer to be converted must be between 1 and 3999");
        }

        $numeral = Numeral::firstOrCreate( ['id' => $integer] );
        if (!$numeral->roman) {
            $converter=new IntegerConversion();
            $numeral->roman = $converter->toRomanNumerals($integer);
        }
        $numeral->count++;
        $numeral->save();

        // save integer value to the conversion log.
        $conversion = Conversion::create(['numeral_id' => $integer]);

        $resource = new Item($numeral, new NumeralTransformer);
        
        return $this->fractal->createData($resource)->toJson();

    }

    
    
    public function recent(Request $request){

        // How recent should the converions be in minutes?
        $minutes = $request->input('minutes',60);
        $recentTime = Carbon::now()->subMinutes($minutes);

        $conversions = Conversion::where('created_at','>',$recentTime )->with('numeral')->get();

        $resource = new Collection($conversions, new ConversionTransformer);

        return $this->fractal->createData($resource)->toJson();

    }


    public function top10(){

        $numerals =Numeral::orderBy('count','desc')->take(10)->get();

        $resource = new Collection($numerals, new NumeralTransformer);

        return $this->fractal->createData($resource)->toJson();

    }

    private function respondWithError($message) {

        return \Response::json([
            'message' => $message
        ], 404);
    }

}
