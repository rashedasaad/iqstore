<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{

    use HasFactory;

    protected $fillable = [
        "email",
        "number",
        "paid_price",
        "refund" ,
        "products"
    ];
}
