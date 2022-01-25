<?php

namespace App\Models;

use App\Services\ConvertService;
use Illuminate\Database\Eloquent\Model;

class ProductCoupon extends Model
{
    protected $guarded = ['id'];

    public function getProductIdAttribute($value)
    {
        $obj = new ConvertService();
        return $obj->idToString($value);
    }

    public function getCouponIdAttribute($value)
    {
        $obj = new ConvertService();
        return $obj->idToString($value);
    }

}
