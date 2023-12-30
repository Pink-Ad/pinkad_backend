<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = "city";
    protected $fillable = [
        "province_id",
        "name",
        "code",
        "status",

    ];
    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }
}
