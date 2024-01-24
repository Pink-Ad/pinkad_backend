<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saleman_comision_details extends Model
{
    use HasFactory;
    protected $table = "salesman_comission_details";
    protected $fillable = [
        "date",
        "req_type",
        "seller_id",
        "salesman_id",
        "amount",
        "closing_balance",
      
    ];
  
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
    public function seller()
    {
        return $this->hasMany(Seller::class,'salesman_id','id');

    }
}
