<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Chatify\Traits\UUID;

class ChMessage extends Model
{
    use UUID;
    public function user()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
