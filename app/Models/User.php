<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;                      
use Illuminate\Notifications\Notifiable;              
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    // Use Laravel traits for API tokens, factory support, and notifications
    use HasApiTokens, HasFactory, Notifiable;

    // Fields that can be mass-assigned (used in create() or fill())
    protected $fillable = [
        'name',       // User's name
        'email',      // User's email
        'password',   // User's password (hashed)
    ];

    // Fields that should be hidden from JSON or array outputs
    protected $hidden = [
        'password',        // Hide password in responses
        'remember_token',  // Hide token used for "remember me" sessions
    ];

    
    // Define a one-to-many relationship with the post model
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
