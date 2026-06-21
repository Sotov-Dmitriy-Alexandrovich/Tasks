<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['user_id', 'title', 'description', 'is_completed', 'priority', 'due_date'])]

class Task extends Model
{
    protected $casts = [
        'is_completed' => 'boolean',
        'priority' => 'integer',
        'due_date' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
