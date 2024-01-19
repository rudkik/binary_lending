<?php


namespace App\Http\Services;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class TelegramServices
{
    protected $http;

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

    public function sendMessage($url, $chat_id, $message, $buttons = null)
    {
        return  $this->http::post($url . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $buttons,
        ]);
    }

    public function sendDocument($url, $chat_id, $path_file = null)
    {
        $file = Storage::path('public/' . $path_file);

        return $this->http::attach(
            'document',
            file_get_contents($file),
            basename($file)
        )->post($url . '/sendDocument', [
            'chat_id' => $chat_id
        ]);
    }

    public function editMessage($url, $chat_id, $message, $buttons, $message_id)
    {
        return  $this->http::post($url . '/editMessageText', [
            'chat_id' => $chat_id,
            'text' => $message,
            'parse_mode' => 'html',
            'reply_markup' => $buttons,
            'message_id' => $message_id,
        ]);
    }
}
