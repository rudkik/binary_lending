<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\PrivateUserController;
use App\Http\Services\TelegramServices;
use App\Models\PrivateCategoryCourse;
use App\Models\PrivateCourse;
use App\Models\PrivateUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Buttons extends Controller
{
    public function buttons($message = null){

        if ($message == '/start') {
                $buttons = [
                    'resize_keyboard' => true,
                    'keyboard' => [
                        [
                            ['text' => 'Отправить токен'],
                        ],
                    ]
                ];
        }else{
            $buttons = [
                'resize_keyboard' => true,
                'keyboard' => [
                    [
                        ['text' => 'Отправить токен'],
                    ],
                ]
            ];
        }


        return $buttons;
    }
}
