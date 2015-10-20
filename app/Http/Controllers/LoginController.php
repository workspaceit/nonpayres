<?php namespace App\Http\Controllers;

use App\Http\Controllers\DataSet\AuthCredential;
use App\Http\Requests;
use App\Models\Login;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller {

    use AuthenticatesAndRegistersUsers;

    protected $loginPath           = "app/login/authenticate";
    protected $redirectPath        = "";
    protected $redirectAfterLogout = "";

    public function __construct(Guard $auth, Registrar $registrar) {
        $this->auth      = $auth;
        $this->registrar = $registrar;

        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function postTokenLogin(Request $request) {
        $this->loginPath = "app/login/authenticate/accesstoken";
        $accessToken     = $request->only(['access_token']);
        $rule            = [
            'access_token' => 'required',
        ];
        $validator       = Validator::make($accessToken, $rule);
        $response        = new Response();

        if ($validator->fails()) {
            $response->massage = $validator->errors()->first();

            return $response->getResponse();
        }

        $userLogin = Login::where('access_token', '=', $accessToken['access_token'])->first();

        if ($userLogin->active == 0) {
            $response->massage = "Your account yet not activated";

            return $response->getResponse();
        }

        Auth::login($userLogin);

        if (Auth::user()) {
            $userLogin              = Auth::user();
            $user                   = User::with('login')
                                          ->where('id', '=', $userLogin->user_id)
                                          ->first();
            $response->massage      = "Login Successful";
            $response->status       = TRUE;
            $response->ResponseData = (Array)$appCredential = new AuthCredential($user);

            return $response->getResponse();
        }

        $response->massage = "Login failed due to system problem !";

        return $response->getResponse();
    }


    public function postLogin(Request $request) {
        $accessToken = $request->only(['user_name', 'password']);
        $rule        = [
            'user_name' => 'required',
            'password'  => 'required',
        ];
        $validator   = Validator::make($accessToken, $rule);
        $response    = new Response();

        if ($validator->fails()) {
            $response->massage = $validator->errors()->first();

            return $response->getResponse();
        }

        $userLogin = Login::where('user_name', '=', $accessToken['user_name'])
                          ->first();
        if ($userLogin) {
            $password = $accessToken['password'];

            if (Hash::check($password, $userLogin->password)) {
                if ($userLogin->active == 0) {
                    $response->massage = "Your account yet not activated";

                    return $response->getResponse();
                }

                Auth::login($userLogin);

                if (Auth::user()) {
                    $userLogin              = Auth::user();
                    $user                   = User::with('login')
                                                  ->where('id', '=', $userLogin->user_id)
                                                  ->first();
                    $response->massage      = "Login Successful";
                    $response->status       = TRUE;
                    $response->ResponseData = (Array)$appCredential = new AuthCredential($user);

                    return $response->getResponse();
                }

                $response->massage = "Login failed due to system problem !";

                return $response->getResponse();
            }
        }

        $response->massage = "Login failed wrong credential !";

        return $response->getResponse();
    }

}
