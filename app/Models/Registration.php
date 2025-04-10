<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    // Mass assignable attributes
    protected $fillable = [
        'description',
        'image_path',
        'image_paths',
        'file_path',
    ];

    // Casts for specific attributes
    protected $casts = [
        'image_paths' => 'array', // Automatically decode JSON to array
    ];
}