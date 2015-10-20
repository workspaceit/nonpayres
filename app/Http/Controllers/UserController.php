<?php namespace App\Http\Controllers;

use App\Http\Controllers\DataSet\AuthCredential;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
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
        $user->login;

        $authCredential = new AuthCredential($user);

        $this->response->massage      = "You Registration Successful";
        $this->response->status       = TRUE;
        $this->response->ResponseData = (Array)$authCredential;

        return $this->response->getResponse();
    }

}
