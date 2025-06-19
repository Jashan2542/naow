<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model // Capitalized class name (follow Laravel convention)
{
    // Allow mass assignment for these fields
    protected $fillable = ['title', 'body'];

    // Define the relationship: each post belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
