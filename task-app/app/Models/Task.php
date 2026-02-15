<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Attributes\Tag;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_data',
        'is_done'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
        
    }
}
