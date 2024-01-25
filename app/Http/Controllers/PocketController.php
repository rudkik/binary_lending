<?php


namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PocketController
{
    public function checkRegisterWindow(Request $request){
        $uid = $request->uid;

        return $this->checkRegistr($uid);
    }

    static public function checkRegistr($uid) {

        $client = new Client([
            'cookies' => true,
        ]);
        $response = $client->get('https://affiliate.pocketoption.com/ru/statistics/detailed', [
            'headers' => [
                'Cookie' => 'laravel_session=eyJpdiI6IldMY05pWFJzQTc5UjBDQW1UclQwUGc9PSIsInZhbHVlIjoid3laOW5LaEIvRFJVV1diVjR6d3lpUXdVT094N29HbDRENHc1cW1kWjVnUm5qOVR3SG9lQWZESCszeHZHTGdEbkt2Ymh0VU1xd0Q3WTBnVmRBTE95RUVkYlExdzVSeUFTL0U4ejd4SnRYVnFjWjZCR3Z3b3cxZzROM2YzNE9GV1YiLCJtYWMiOiI0ZmUxNGI3YjI0NGQ3ZTg4NjYyYTlkNjdmNzQ4YTUwM2Q0YjdkZWI3ODNhZGUzMzM3NDdhM2ZjZjY3YzNjMjNmIiwidGFnIjoiIn0%3D; Path=/; HttpOnly; Expires=Fri, 26 Jan 2024 11:01:19 GMT;'
            ],
            'query' => [
                'uid' => $uid,
            ],
        ]);

        $data = $response->getBody()->getContents();


        preg_match_all('/<td data-label="DPST">(.+)<\/td>/U', $data, $result_dpst);
        preg_match_all('/<td data-label="Баланс">(.+)<\/td>/U', $data, $result_balance);

        if(!empty($result_dpst[1][1])){
            $register = true;
            $deposit = stristr($result_dpst[1][1], '$');
            $deposit = str_replace('$', '', $deposit); // Удаляем знак доллара
            $deposit = intval($deposit); // Преобразуем строку в целое число
            return [
                'register' => $register,
                'dpst' => $deposit,
            ];
        }
        return [
            'register' => false,
            'dpst' => false,
        ];
    }



}
