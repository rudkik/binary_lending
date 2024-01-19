<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
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
        $this->url = 'https://api.apilayer.com/currency_data/live';
    }

    public function getCurrencyAmount(){
        $request = Http::withHeaders([
            'apikey' => $this->key,
        ])->get($this->url);

        return json_decode($request->body(), true);
    }


}
