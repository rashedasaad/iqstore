<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Models\section;
class product extends Model
{
    use HasFactory;
    protected $fillable = [
        "section",
        "name",
        "price",
        "img",
        "subs",
    ];
    public function sections(){
        return $this->belongsTo(section::class);
    }
}
