<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'title', 'company', 'duration', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    

}
