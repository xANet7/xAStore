<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'thumbnail',
        'name',
        'price',
        'category',
        'status',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'. $search . '%')
            ->orWhere('price', 'like', '%'. $search . '%')
            ->orWhere('category', 'like', '%'. $search . '%');
    }
}
