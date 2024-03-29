<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
    ];

    public function tasks()
    {
        return $this->hasMany(TodoTask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
