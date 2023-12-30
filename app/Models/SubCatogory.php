<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCatogory extends Model
{
    use HasFactory;
    protected $table = "sub_category";
    protected $fillable = [
        "category_id",
        "name",
        "code",
        "status",

    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
