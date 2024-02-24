<?php


namespace App\Http\Controllers;

use App\Models\PocketToken;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class PocketController
{
    public function checkRegisterWindow(Request $request){
        $uid = $request->uid;

        return $this->checkRegistr($uid);
    }

    static public function checkRegistr($uid) {

        $token = PocketToken::query()->first();
        $client = new Client([
            'cookies' => true,
        ]);
        $response = $client->get('https://affiliate.pocketoption.com/ru/statistics/detailed', [
            'headers' => [
                'Cookie' => "$token->token"
            ],
            'query' => [
                'uid' => $uid,
            ],
        ]);

        $data = $response->getBody()->getContents();


        preg_match_all('/<td data-label="DPST">(.+)<\/td>/U', $data, $result_dpst);
        preg_match_all('/<td data-label="Баланс">(.+)<\/td>/U', $data, $result_balance);

        dd($result_balance, $result_dpst);

        if(!empty($result_dpst[1][1])){
            $register = true;
            $deposit = stristr($result_dpst[1][1], '$');
            $balance = stristr($result_balance[1][0], '$');
            $deposit = str_replace('$', '', $deposit);
            $balance = str_replace('$', '', $balance);
            $deposit = intval($deposit);
            $balance = intval($balance);
            return [
                'register' => $register,
                'dpst' => $deposit,
                'balance' => $balance,
            ];
        }
        return [
            'register' => false,
            'dpst' => false,
            'balance' => false,
        ];
    }
    public static function extractLaravelSession($cookieString) {
        preg_match('/laravel_session=([^;]+)/', $cookieString, $matches);
        return isset($matches[1]) ? urldecode($matches[1]) : null;
    }



}
