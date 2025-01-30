<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TaskPriority;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'is_completed', // Add this line
        'priority',
        'description',
        'progress',
        'start_date',
        'due_date',
    ];

    protected $casts = [
        'name' => 'string',
        'is_completed' => 'boolean',
        'priority' => TaskPriority::class,
        'description' => 'string',
        'progress' => 'integer',
        'start_date' => 'datetime',
        'due_date' => 'datetime',
    ];

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
    
}
