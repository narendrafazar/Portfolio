<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id', 
        'insurance_price', 
        'shipping_price', 
        'transaction_status', 
        'total_price', 
        'code'
    ];

    protected $hidden = [

    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
