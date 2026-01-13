<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table = 'discounts';

    protected $fillable = [
        'title',
        'description',
        'discount_percent',
        'min_level',
        'banner',
        'is_active',
    ];
}
