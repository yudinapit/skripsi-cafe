<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'thumbnail',
        'description',
        'price',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $filter)
    {
        return $query->when($filter->category ?? false, function ($query) use ($filter) {
            return $query->where('category_id', $filter->category);
        })->when($filter->search ?? false, function ($query) use ($filter) {
            return $query->where('title', 'like', '%' . $filter->search . '%');
        });
    }
}
