<?php
namespace App\Http\Controllers\Secure;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DataSet\AdviceDetails;
use App\Http\Controllers\DataSet\AuthCredential;
use App\Http\Controllers\Response;
use App\Http\Requests;
use App\Models\Advice;
use App\Models\Login;
use App\Models\User;
use Illuminate\Http\Request;

class ExchangeTokenController extends Controller  {
    private static $key="6HCKU4L71BHP1UKFHAMPHBOAC6JJAP9FCGWZEXL70JZG5MGMSKRRNCOC9F6GBUXS5ONIT6";
    public function getAccessToken(Request $request) {

        $userName = $request->input("user_name");
        $key = $request->input("key");

        $response = new Response();
        if($userName==null || $userName==""){
            $response->status       = false;
            $response->massage      = "User name missing";
            return $response->getResponse();
        }
        if($key!=self::$key){
            $response->status       = false;
            $response->massage      = "";
            return $response->getResponse();
        }
        $userLogin = Login::where('user_name', '=', $userName)->first();
        if($userLogin==null){
            $response->status       = false;
            $response->massage      = "No login credential found";
            return $response->getResponse();
        }
        $user  = User::with('login')->where('id', '=', $userLogin->user_id)->first();

        if($user==null){
            $response->status       = false;
            $response->massage      = "No credential found";
            return $response->getResponse();
        }

        $response->status       = TRUE;
        $response->massage      = "Advice List";
        $response->ResponseData = (Array)$appCredential = new AuthCredential($user);

        return $response->getResponse();
    }

}
