<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    /**
     * Set default value
     *
     * @var int[]
     */
    protected $attributes = [
        'done' => 0,
    ];

    /**
     * Set fillable content
     *
     * @var string[]
     */
    protected $fillable = [
        'todo',
    ];
}
