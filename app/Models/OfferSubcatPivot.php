<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferSubcatPivot extends Model
{
    use HasFactory;
    protected $table = "offer_subcat_pivot";
    protected $fillable = [
        "offer_id",
        "subcat_id",
        "status"
    ];
    public function subcat()
    {
        return $this->belongsTo(SubCatogory::class, 'subcat_id');
    }
    public function offer()
    {
        return $this->belongsTo(Post::class, 'offer_id');
    }
}
