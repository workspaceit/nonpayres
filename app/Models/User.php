<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

    protected $table    = 'users';
    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
    ];

    public function login() {
        return $this->hasOne('App\Models\Login', 'user_id', 'id');
    }

    public function client() {
        return $this->hasMany('App\Model\Client', 'user_id', 'id');
    }
}
