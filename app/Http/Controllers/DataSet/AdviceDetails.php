<?php
/**
 * Project  : nonpayres
 * File     : AdviceDetails.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/20/15 - 2:22 PM
 */

namespace App\Http\Controllers\DataSet;


class AdviceDetails {
    /**
     * @var int
     */
    public $id;

    /**
     * @var String
     */
    public $name;

    /**
     * @var String
     */
    public $createdDate;

    public function __construct($advice) {
        $this->id          = $advice->id;
        $this->name        = $advice->name;
        $this->createdDate = (array)$advice->created_at;
        $this->createdDate = $this->createdDate['date'];
    }
}