<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'created_at', 'updated_at'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'place_id');
    }
}
