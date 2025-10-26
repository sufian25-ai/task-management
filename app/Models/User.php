<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Role add করলাম
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationship: User এর অনেক Projects
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // Helper Method: Check করবে user admin কিনা
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Helper Method: Check করবে user simple user কিনা
    public function isUser()
    {
        return $this->role === 'user';
    }
}