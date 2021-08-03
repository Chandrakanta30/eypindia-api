<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = ['product_id','photo'];
    public $timestamps = false;
    public function getPhotoAttribute($value)
    {
        if ($value) {
            return "http://eypindia.com/assets/images/galleries/". $value;
            // asset('assets/images/categories/' . $value);
        } else {
            return asset('images/profile/no-image.png');
        }
    }
}
