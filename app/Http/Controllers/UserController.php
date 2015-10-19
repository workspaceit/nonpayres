<?php namespace App\Http\Controllers;

use App\Http\Controllers\DataSet\AppCredential;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller {

    private $response;

    public function __construct() {
        $this->response = new Response();
    }

    public function register(Request $request) {

        /*$input     = $request->input();
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
        $user->login()->create($input);*/

        $user = User::with('login')->first();

        $appCredential = new AppCredential($user);

        return (Array)$appCredential;
    }

}
