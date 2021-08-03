<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
class VendorDetails  extends Authenticatable
{
    protected $table = 'vendor_details';

    protected $fillable = ['name', 'photo', 'zip', 'residency', 'city', 'country', 'address', 'phone', 'fax', 'email','password','affilate_code','verification_link'];


    protected $hidden = [
        'password', 'remember_token'
    ];
}
