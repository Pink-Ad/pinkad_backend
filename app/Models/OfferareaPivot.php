<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferareaPivot extends Model
{
    use HasFactory;
    protected $table = "offer_area_pivot";
    protected $fillable = [
        "offer_id",
        "area_id",
        "status"
    ];
 
    public function offer()
    {
        return $this->belongsTo(Post::class, 'offer_id');
    }
}
