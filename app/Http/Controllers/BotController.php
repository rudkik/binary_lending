<?php

namespace App\Http\Controllers;

use App\Http\Services\TelegramServices;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class BotController extends Controller
{
    protected $token;
    const url = 'https://api.telegram.org/bot';
    public function __construct()
    {
        $this->token = "6877119959:AAFUfVPcffMQVygvNXz3PdwsnhgEVckQWx0";
    }

    public function setWebhook(){
        $http = Http::get(self::url . $this->token .'/setWebhook?url=https://sopranoteam.ru/laura/webhook');
        dd(json_decode($http->body()));
    }


    public function getWebhookInfo(){
        $http = Http::get(self::url . $this->token .'/getWebhookInfo');
        dd(json_decode($http->body()));
    }

    public function webhook(Request $request, TelegramServices $telegramServices){

    }


}
