<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;
    protected $table = "seller";
    protected $fillable = [
        "SELL_ID",
        "user_id",
        "phone",
        "business_name",
        "business_address",
        "faecbook_page",
        "insta_page",
        "web_url",
        "isFeatured",
        "logo",
        "reference",
        "salesman_id",
        "status",

    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function shop()
    {
        return $this->hasMany(Shop::class,'seller_id','id');
    }
}
