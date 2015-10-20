<?php
/**
 * Project  : nonpayres
 * File     : AuthCredential.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/20/15 - 11:59 AM
 */

namespace App\Http\Controllers\DataSet;


class AuthCredential extends AppCredential {
    public $accessToken;

    public function __construct($user) {
        parent::__construct($user);
        $this->accessToken = $user->login->access_token;
    }
}