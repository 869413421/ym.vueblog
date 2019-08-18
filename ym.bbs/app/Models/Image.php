<?php

namespace App\Models;

class Image extends BaseModel
{
    protected $fillable = [
        'type', 'path',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
