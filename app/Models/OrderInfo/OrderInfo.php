<?php

namespace App\Models\OrderInfo;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model
{
    protected $table = "order_info";
    protected $primaryKey = "order_id";
    protected $guarded = [];
}
