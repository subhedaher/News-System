<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class Writer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Writer::class, 'writer_id', 'id');
    }
}
