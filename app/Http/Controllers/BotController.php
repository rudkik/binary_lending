<?php

namespace App\Http\Controllers;

use App\Http\Services\TelegramServices;
use App\Models\PocketToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    protected $token;
    const url = 'https://api.telegram.org/bot';
    public function __construct()
    {
        $this->token = "6469723160:AAESEUy7CRQSts0jOCWSQBWJtlUiesuXP7M";
    }

    public function setWebhook(){
        $http = Http::get(self::url . $this->token .'/setWebhook?url=https://plusoption.online/webhook');
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
            $message = ($data['text']);
            $chat_id = $data['chat']['id'];
            $message_id = $data['chat']['id'];
        }

        Log::debug($request);

        $buttonObj = new Buttons();
        $buttons = $buttonObj->buttons($message);
        if ($query == false) {
            if ($message == '/start') {
                $message = 'Отправляй токен';
            } elseif (strpos($message, 'laravel_session') !== false) {
                $token = PocketToken::first();

                if ($token) {
                    // Запись существует, обновляем токен
                    $token->token = $message; // Предполагаем, что у вас есть поле 'token' в таблице
                    $token->save();
                } else {
                    // Записи не существует, создаем новую
                    $token = new PocketToken();
                    $token->token = $message; // Предполагаем, что у вас есть поле 'token' в таблице
                    $token->save();
                }
                $message = 'Токен обнавлен';

            }

            $telegramServices->sendMessage(self::url . $this->token, $chat_id, $message, $buttons);
        }


    }


}
