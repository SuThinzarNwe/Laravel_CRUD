<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'place_id',
        'create_at',
        'updated_at'
    ];

    public function scopeSearch($query)
    {
        return $query->when(request()->has('search') ?? false, function ($query, $search) {
            $query->where('name', 'LIKE', '%' . request()->input('search') . '%');
        });
    }
    public function place()
    {
        // return $this->hasMany(Place::class, 'place_id');
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'category_student');
    }
}
