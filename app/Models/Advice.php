<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advice extends Model {

    protected $table    = "advices";
    protected $fillable = ['name'];

    public function client() {
        return $this->belongsTo('App\Models\Client', 'advice_id', 'id');
    }
}
