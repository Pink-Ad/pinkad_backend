<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = "customers";
    protected $fillable = [
        "user_id",
        "area_id",
        "phone",
        "business_name",
        "business_address",
        "fb_page",
        "insta_page",
        "web_url",
        "status",
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id','id');
    }
}
