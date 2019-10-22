<?php

namespace App\Models;

class Good extends BaseModel
{
    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
