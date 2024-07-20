<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    public function writers()
    {
        return $this->hasMany(Writer::class, 'admin_id', 'id');
    }


    public function status_articles()
    {
        return $this->hasMany(Status_Articles::class, 'admin_id', 'id');
    }
}
