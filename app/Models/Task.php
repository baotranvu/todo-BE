<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
    
}
