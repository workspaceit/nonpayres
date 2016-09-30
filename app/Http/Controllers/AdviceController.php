<?php
namespace App\Http\Controllers;

use App\Http\Controllers\DataSet\AdviceDetails;
use App\Http\Requests;
use App\Models\Advice;

class AdviceController extends Controller {

    public function getAdvices() {
        $advices        = Advice::all();
        $advicesDetails = new \ArrayObject();
        $response       = new Response();

        foreach ($advices as $advice) {
            $adD = new AdviceDetails($advice);
            $advicesDetails->append($adD);
        }

        $response->status       = TRUE;
        $response->massage      = "Advice List";
        $response->ResponseData = (Array)$advicesDetails;

        return $response->getResponse();
    }

}
