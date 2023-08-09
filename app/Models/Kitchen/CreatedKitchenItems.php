<?php

namespace App\Models\Kitchen;

use Illuminate\Database\Eloquent\Model;

class CreatedKitchenItems extends Model
{
    protected $table = "created_food_items";
    protected $primaryKey = "food_item_id";
    protected $guarded = [];
}
