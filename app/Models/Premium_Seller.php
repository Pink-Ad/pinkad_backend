<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Premium_Seller extends Model
{
    use HasFactory;
    protected $table = "premium_seller_features";

    
    protected $fillable = [
        'seller_id', // Add seller_id here
        'extra_feature', // Add other attributes as needed
    ];
  
}
