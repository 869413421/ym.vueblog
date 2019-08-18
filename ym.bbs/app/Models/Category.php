<?php

namespace App\Models;

class Category extends BaseModel
{
    protected $fillable = [
        'name', 'description'
    ];

    public $timestamps = false;
}
