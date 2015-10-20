<?php
/**
 * Project  : nonpayres
 * File     : Response.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/19/15 - 4:13 PM
 */

namespace App\Http\Controllers;


class Response {
    public $status       = FALSE;
    public $massage      = NULL;
    public $ResponseData = NULL;

    public function __construct() {
        $this->ResponseData = new \stdClass();
    }

    public function getResponse() {
        return [
            'responseStat' => [
                'status' => $this->status,
                'msg'    => $this->massage,
            ],
            'responseData' => $this->ResponseData,
        ];
    }
}