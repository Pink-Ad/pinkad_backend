<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $table = "post";
    protected $fillable = [
        "shop_id",
        "category_id",
        "banner",
        "gender",
        "area",
        "title",
        "description",
        "hash_tag",
        "IsFeature",
        "status",
    ];
    public function insights()
    {
        return $this->belongsTo(OfferInsight::class,'id','offer_id');
    }
    public function shop()
    {
        return $this->belongsTo(Shop::class, 'shop_id','id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id','id');
    }
    public function subcategory()
    {
        return $this->belongsTo(OfferSubcatPivot::class,'id','offer_id');
    }
    public function getarea()
    {
        return $this->belongsTo(Area::class, 'area','id');
    }
}
