<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Requests;
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
     * @param $integer - the integer to be converted resolved from the route. 
     * @return \Illuminate\Http\JsonResponse
     */
    public function convert($integer) {

        if ($integer <0 || $integer>3999 ) {
            return $this->respondWithError("ERROR: Arabic Numeral to be converted must be between 1 and 3999");
        }

        // Retrieve Numeral that has already been converted, or instatiate new Numeral (converting in constructor);
        $numeral = Numeral::firstOrNew( ['id' => $integer] );
        $numeral->count++;
        $numeral->save();

        // save integer value to the conversion log;
        $conversion = Conversion::create(['numeral_id' => $integer]);

        $resource = new Item($numeral, new NumeralTransformer);
        
        return response()->json($this->fractal->createData($resource)->toArray());

    }


    /**
     * @param Request $request - optionally includes minutes input
     * @return \Illuminate\Http\JsonResponse
     * This returns a list of all conversions made in the last $minutes (default is 60 minutes);
     */
    public function recent(Request $request){

        $minutes = $request->input('minutes',60);
        $recentTime = Carbon::now()->subMinutes($minutes);

        $conversions = Conversion::where('created_at','>',$recentTime )->with('numeral')->get();

        $resource = new Collection($conversions, new ConversionTransformer);

        return response()->json($this->fractal->createData($resource)->toArray());

    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * Return the top 10 most converted integers of all time.
     */
    public function top10(){

        $numerals =Numeral::orderBy('count','desc')->take(10)->get();

        $resource = new Collection($numerals, new NumeralTransformer);

        return response()->json($this->fractal->createData($resource)->toArray());

    }

    /**
     * @param $message
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithError($message) {

        return \Response::json([
            'message' => $message
        ], 404);
    }

}
