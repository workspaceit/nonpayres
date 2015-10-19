<?php
/**
 * Project  : nonpayres
 * File     : Response.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/19/15 - 4:13 PM
 */

namespace app\Http\Controllers;


class Response {
    public $status       = FALSE;
    public $massage      = NULL;
    public $ResponseData = [];

    public function getResponse() {
        return [
            'responseStat' => [
                'status'  => $this->status,
                'massage' => $this->massage,
            ],
            'ResponseData' => $this->ResponseData,
        ];
    }
}