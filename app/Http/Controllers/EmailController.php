<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\EmailActivationCode;
use App\Models\User;
use Carbon\Carbon;

class EmailController extends Controller {
    public function verifyEmail($email, $token) {
        $getToken = EmailActivationCode::where('email', '=', $email)
                                       ->where('token', '=', $token)
                                       ->where('expire_at', '>', Carbon::now())
                                       ->count();
        EmailActivationCode::where('expire_at', '<', Carbon::now())->delete();

        if ($getToken > 0) {
            $user = User::where('email', '=', $email)->first();
            $user->login()->update(['active' => 1]);

            return redirect('app/login/authenticate');
        }

        return redirect('app/login/authenticate?massage=failed');
    }
}