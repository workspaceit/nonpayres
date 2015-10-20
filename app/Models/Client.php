<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model {

    protected $table    = 'clients';
    protected $fillable = [
        'phone_number',
        'name',
        'post_code',
        'pickup_location',
        'non_payer',
        'stars',
        'time_of_incident',
        'incident_note',
        'advice_id',
        'user_id',
    ];

    public function advice() {
        return $this->hasOne('App\Models\Advice', 'id', 'advice_id');
    }
}
