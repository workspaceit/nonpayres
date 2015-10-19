<?php
/**
 * Project  : nonpayres
 * File     : UserInfo.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/19/15 - 5:59 PM
 */

namespace App\Http\Controllers\DataSet;


class UserInfo {
    public $id;
    public $name;
    public $address;
    public $email;
    public $phoneNumber;
    public $createdDate;

    public function __construct($user = []) {
        $this->id          = $user['id'];
        $this->name        = $user['name'];
        $this->address     = $user['address'];
        $this->email       = $user['email'];
        $this->phoneNumber = $user['phone_number'];
        $this->createdDate = (Array)$user['created_at'];
        $this->createdDate = $this->createdDate['date'];
    }
}