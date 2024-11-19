<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    // A user belongs to a role
    public function role() {
        return $this->belongsTo(Role::class);
    }

    // A user has many articles
    public function articles() {
        return $this->hasMany(Article::class);
    }
}

