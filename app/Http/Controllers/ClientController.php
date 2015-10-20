<?php namespace App\Http\Controllers;

use App\Http\Controllers\DataSet\AdviceDetails;
use App\Http\Controllers\DataSet\ClientInfo;
use App\Http\Requests;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller {

    public function newClient(Request $request) {
        $user     = @Auth::user();
        $response = new Response();

        if (!$user) {
            $response->massage = "Login Timeout !";

            return $response->getResponse();
        }

        $rule      = [
            'phone_number'     => 'required|unique:clients',
            //'name'             => 'required',
            'post_code'        => 'required',
            'pickup_location'  => 'required',
            'non_payer'        => 'required',
            //'stars'            => 'required',
            'time_of_incident' => 'required',
            'incident_note'    => 'required',
            //'advice_id'        => 'required',
        ];
        $validator = Validator::make($request->input(), $rule);

        if ($validator->fails()) {
            $response->massage = $validator->errors()->first();

            return $response->getResponse();
        }

        $input            = $request->input();
        $input['user_id'] = $user->user_id;

        $client   = Client::create($input);
        $response = new Response();

        if (!$client) {
            $response->massage = "Client to store the Client";

            return $response->getResponse();
        }

        $clientDataSet                 = new ClientInfo();
        $advice                        = new AdviceDetails($client->advice);
        $clientDataSet->name           = $client->name;
        $clientDataSet->phoneNumber    = $client->phone_number;
        $clientDataSet->pickupLocation = $client->pickup_location;
        $clientDataSet->postCode       = $client->post_code;
        $clientDataSet->nonPayer       = $client->non_payer;
        $clientDataSet->timeOfIncident = $client->time_of_incident;
        $clientDataSet->stars          = $client->stars;
        $clientDataSet->incidentNote   = $client->incident_note;
        $clientDataSet->advice         = $advice;

        $response->massage      = "Client Added Successfully";
        $response->status       = TRUE;
        $response->ResponseData = $client;

        return $response->getResponse();
    }

    public function search(Request $request) {
        $input       = $request->input();
        $phoneNumber = @$input['phone_number'];
        $postCode    = @$input['post_code'];
        $limit       = @$input['limit'];
        $offset      = @$input['offset'];

        if (!$limit) {
            $limit = 5;
        }

        if (!$offset) {
            $offset = 0;
        }

        $clients = Client::with('advice')
                         ->where(function ($q) use ($phoneNumber, $postCode) {
                             if ($phoneNumber) {
                                 $phoneNumber .= '%';
                                 $q->where('phone_number', 'like', $phoneNumber);
                             }

                             if ($postCode) {
                                 $postCode .= '%';
                                 $q->where('post_code', 'like', $postCode);
                             }
                         })
                         ->orderBy('name', 'ASC')
                         ->take($limit)
                         ->offset($offset)
                         ->get();

        $searchResult = new \ArrayObject();

        foreach ($clients as $client) {
            $clientDataSet                 = new ClientInfo();
            $advice                        = new AdviceDetails($client->advice);
            $clientDataSet->name           = $client->name;
            $clientDataSet->phoneNumber    = $client->phone_number;
            $clientDataSet->pickupLocation = $client->pickup_location;
            $clientDataSet->postCode       = $client->post_code;
            $clientDataSet->nonPayer       = $client->non_payer;
            $clientDataSet->timeOfIncident = $client->time_of_incident;
            $clientDataSet->incidentNote   = $client->incident_note;
            $clientDataSet->stars          = $client->stars;
            $clientDataSet->advice         = $advice;
            $searchResult->append($clientDataSet);
        }

        $response               = new Response();
        $response->status       = TRUE;
        $response->massage      = NULL;
        $response->ResponseData = (Array)$searchResult;

        return $response->getResponse();
    }
}
