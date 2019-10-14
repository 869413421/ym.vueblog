<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $fillable = [
        'name', 'description'
    ];

    public function Topic()
    {
        return $this->hasMany(Topic::class);
    }
}
