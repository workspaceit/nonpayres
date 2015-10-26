<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailActivationCode extends Model {

    protected $table    = "email_activation_codes";
    protected $fillable = ['email', 'token', 'expire_at'];

}
