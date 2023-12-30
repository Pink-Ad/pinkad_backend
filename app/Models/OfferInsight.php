<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferInsight extends Model
{
    use HasFactory;
    protected $table = "offer_insights";
    protected $fillable = [
        "offer_id",
        "views",
        "impression",
        "reach",
        "conversion",
    ];
    public function offer()
    {
        return $this->belongsTo(Post::class,'offer_id','id');
    }
}
