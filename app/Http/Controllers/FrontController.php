<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FrontController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function mainPage(Request $request){
        $ipAddress = $request->getClientIp();

        $user = User::query()->where('ip_address', $ipAddress)->first();

        if (!$user){
            $user = new User();
            $user->ip_address = $ipAddress;
            $user->save();
        }

        return view('main');
    }

    public function currencyPage(){

        return view('currency');
    }
    public function settingPage(){

        return view('setting');
    }

    public function checkUid(Request $request){
        $uid = $request->uid;

        $data_user = PocketController::checkRegistr($uid);

        return response()->json(['dpst' => $data_user['dpst'], 'balance' => $data_user['balance'],]);
    }
    public function checkToken(Request $request){
        $uid = $request->uid;

        dd(PocketController::extractLaravelSession($uid));

    }

}
