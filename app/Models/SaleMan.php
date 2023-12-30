<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleMan extends Model
{
    use HasFactory;
    protected $table = "salemans";
    protected $fillable = [
        "SM_ID",
        "phone",
        "qualification",
        "cnic",
        "cnic_image",
        "marital_status",
        "religion",
        "work_history",
        "picture",
        "bank_account",
        "age",
        "address",
        "status",
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
