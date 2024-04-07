<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VirtualCurrency extends Model
{
    use HasFactory;
    protected $fillable = ['balance','expiry_date'];
    protected $casts = [
        'expiry_date' => 'datetime',
    ];
    
}
