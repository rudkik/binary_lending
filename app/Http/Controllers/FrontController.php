<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class FrontController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function mainPage(Request $request){
//        dd($request);
        return view('main');
    }

    public function currencyPage(){

        return view('currency');
    }
    public function settingPage(){

        return view('setting');
    }
}
