<?php
/**
 * Project  : nonpayres
 * File     : AppCredential.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/19/15 - 5:52 PM
 */

namespace App\Http\Controllers\DataSet;

class AppCredential {
    public $id;
    public $userName;
    //public $password;
    public $user;
    public $createdDate;

    public function __construct($user) {
            $userInfo       = new UserInfo($user);
            $login          = $user->login;
            $this->id       = $login->id;
            $this->userName = $login->user_name;
            //$this->password    = $login->password;
            $this->user        = $userInfo;
            $this->createdDate = (array)$login->created_at;
            $this->createdDate = $this->createdDate['date'];
    }
}