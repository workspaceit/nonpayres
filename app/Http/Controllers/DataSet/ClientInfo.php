<?php
/**
 * Project  : nonpayres
 * File     : ClientInfo.php
 * Author   : Abu Bakar Siddique
 * Email    : absiddique.live@gmail.com
 * Date     : 10/20/15 - 2:22 PM
 */

namespace App\Http\Controllers\DataSet;


class ClientInfo {
    /**
     * @var String
     */
    public $phoneNumber;
    /**
     * @var String
     */
    public $name;
    /**
     * @var String
     */
    public $postCode;
    /**
     * @var int
     */
    public $pickupLocation;
    /**
     * @var int
     */
    public $nonPayer;
    /**
     * @var String
     */
    public $timeOfIncident;
    /**
     * @var String
     */
    public $incidentNote;
    /**
     * @var int
     */
    public $stars;
    /**
     * @var int
     */
    public $excellentCustomer;
    /**
     * @var int
     */
    public $excellentStars;
    /**
     * @var AdviceDetails
     */
    public $advice;

    public function __construct() {
        $this->phoneNumber       = NULL;
        $this->name              = NULL;
        $this->postCode          = NULL;
        $this->pickupLocation    = NULL;
        $this->nonPayer          = NULL;
        $this->stars             = NULL;
        $this->excellentCustomer = NULL;
        $this->excellentStars    = NULL;
        $this->timeOfIncident    = NULL;
        $this->incidentNote      = NULL;
        $this->advice            = new \stdClass();
    }
}