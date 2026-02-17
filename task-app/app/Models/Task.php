<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'due_date',
        'is_done'
    ];

    public function priorityColor()
    {
        return match ($this->priority)
        {
            'high' => '#ff9999',
            'medium' => '#fff59d',
            'low'    => '#c8e6c9',
            default    =>'white',
        };
    }
}
