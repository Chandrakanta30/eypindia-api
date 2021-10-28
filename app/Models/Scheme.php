<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheme extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne('App\Models\User','id','customer_id');

    }
    public function payments(){
        return $this->hasMany('App\Models\SchemePayment','scheme_id','id')->where('status','=', 'paid');
    }
}
