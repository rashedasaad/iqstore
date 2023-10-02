<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\product;
class section extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(product::class,"section");
    }

    protected $fillable = [
        'ar',
        'en',
    ];

}
