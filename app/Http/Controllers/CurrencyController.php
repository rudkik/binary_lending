<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $key;
    private $url;

    public function __construct()
    {
        $this->key = 'j0jijegXI06kb4mXMgCV0DxRvugC2hNH';
        $this->url = 'https://api.apilayer.com/currency_data/';
    }

    public function getCurrencyAmount(){
        $request = Http::withHeaders([
            'apikey' => $this->key,
        ])->get($this->url . 'live');

        return json_decode($request->body(), true);
    }

    public function getTimeFrameData(Request $request){
        $timeout = 60;
        $currency = $request->input('currencies', 'USD'); // Значение по умолчанию USD
        $source = $request->input('source', 'JPY'); // Значение по умолчанию JPY

        $request = Http::withHeaders([
            'apikey' => $this->key,
        ])->timeout($timeout)->get($this->url . "timeframe?start_date=2024-01-10&end_date=2024-01-18&currencies={$currency}&source={$source}");

        return json_decode($request->body(), true);
    }
}
