<?php

namespace App\Models\v1Products;

use Illuminate\Database\Eloquent\Model;

class v1Products extends Model
{
    protected $table = "v1products";
    protected $primaryKey = "v1product_id";
    protected $guarded = [];
}
