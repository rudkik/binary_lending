<?php

namespace App\Http\Controllers;

use App\Http\Services\TelegramServices;
use App\Models\User;
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
        $this->token = "6469723160:AAF5RvibzAHviaaGiUwpU2g9dnkvGM0P3sQ";
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
        $query = false ;
        if($request->input('callback_query') !== NULL){
            $data = $request->input('callback_query');
            $message = mb_strtolower($data['data'], 'utf-8');
            $chat_id = $data['message']['chat']['id'];
            $message_id = $data['message']['message_id'];
            $query = true;
        }else{
            $data = $request->input('message');
            $message = mb_strtolower(($data['text']), 'utf-8');
            $chat_id = $data['chat']['id'];
            $message_id = $data['chat']['id'];
        }


        $user = User::where([
            'chat_id' => $chat_id,
        ])->first();
        if (empty($user)) {
            $user = new User();
            $user->createUser($data);
        }

    }


}
