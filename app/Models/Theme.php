<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'cost', 'color'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_themes');
    }
}

