<?php namespace App\Http\Controllers;

use App\Http\Controllers\DataSet\AuthCredential;
use App\Models\EmailActivationCode;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    private $response;

    public function __construct() {
        $this->response = new Response();
    }

    public function currentUser() {
        $response = new Response();

        if (Auth::user()) {
            $userLogin              = Auth::user();
            $user                   = User::with('login')
                                          ->where('id', '=', $userLogin->user_id)
                                          ->first();
            $response->massage      = "Old session";
            $response->status       = TRUE;
            $response->ResponseData = (Array)$appCredential = new AuthCredential($user);

            return $response->getResponse();
        }

        return $response->getResponse();
    }

    public function register(Request $request) {

        $input     = $request->input();
        $rule      = [
            'user_name'    => 'required|unique:logins',
            'password'     => 'required',
            'name'         => 'required',
            'address'      => 'required',
            'email'        => 'required|unique:users',
            'phone_number' => 'required|unique:users',
        ];
        $validator = Validator::make($input, $rule);

        if ($validator->fails()) {
            $this->response->massage = $validator->errors()->first();

            return $this->response->getResponse();
        }

        $input['password']     = bcrypt($input['password']);
        $input['access_token'] = md5($input['user_name'] . $input['email']);
        $user                  = User::create($input);

        $user->login()->create($input);
        $auth = $user->login;

        $authCredential = new AuthCredential($user);

        if ($auth) {
            $email = $user->email;
            $token = md5($email . time());

            $body       = "Dear user,\r\n" .
                          "To active your account follow the link : " .
                          url('verify/email/' . $email . '/' . $token) . "\r\n" .
                          "This link will expired within 24 hours.\r\n";
            $storeToken = EmailActivationCode::create([
                'email'     => $email,
                'token'     => $token,
                'expire_at' => Carbon::now()->addHours(24),
            ]);

            if ($storeToken) {
                Mail::raw($body, function ($massage) use ($email) {
                    $massage->from("no-replay@blacklist.com", "Black List Admin");
                    $massage->to($email);
                    $massage->subject("Account Activation Code");
                });
            }
        }

        $this->response->massage      = "You Registration Successful";
        $this->response->status       = TRUE;
        $this->response->ResponseData = (Array)$authCredential;

        return $this->response->getResponse();
    }

    public function sendActivationCode($email) {
        return $email;

    }
}
