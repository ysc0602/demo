<?php

namespace App\Models;

use App\Services\ConvertService;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = ['id'];

    const DEL_STATUS = [
        'no' => 1,
        'yes' => 2
    ];

    public function getIdAttribute($value)
    {
        $obj = new ConvertService();
        return $obj->idToString($value);
    }

}
