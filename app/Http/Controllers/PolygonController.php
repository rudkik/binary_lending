<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;
use PolygonIO\Rest\Rest;

class PolygonController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    private $apiKey;
    private $baseUrl;

    public function __construct()
    {
        $this->apiKey = 'SSzh7XrJekYWPK3oTVX6emx77QQiQ_LB'; // Ваш API ключ для Polygon.io
        $this->baseUrl = 'https://api.polygon.io/';
    }

    public function getSimpleMovingAverage(Request $request)
    {

        $ticker = 'C:' . $request->input('currencies', 'USD') . $source = $request->input('source', 'EUR');;
        $timespan = 'day';
        $window = '10';
        $seriesType = 'close';
        $order = 'desc';
        $url = $this->baseUrl . "v1/indicators/sma/{$ticker}?timespan={$timespan}&adjusted=true&window={$window}&series_type={$seriesType}&order={$order}&apiKey={$this->apiKey}";

        $response = Http::get($url);

        return json_decode($response->body(), true);
    }

}
