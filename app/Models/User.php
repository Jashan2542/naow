<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;                      
use Illuminate\Notifications\Notifiable;              
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    //  Use Laravel traits for extra features
    use HasApiTokens, HasFactory, Notifiable;

    // Fields that can be mass-assigned (used in create() or fill())
     
    protected $fillable = [
        'name',       
        'email',      
        'password',   
    ];

    // Fields that should be hidden from JSON or array outputs
     
    protected $hidden = [
        'password',        // Hide password
        'remember_token',  // Hide token used for web login "remember me"
    ];
}
