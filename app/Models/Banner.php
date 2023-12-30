<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $table = "banner";
    protected $fillable = [
        "shop_id",
        "redirect_url",
        "area",
        "subcat_id",
        "image",
        "status",

    ];
    public function subcategory()
    {
        return $this->belongsTo(SubCatogory::class,'subcat_id');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class,'shop_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class,'area');
    }
}
