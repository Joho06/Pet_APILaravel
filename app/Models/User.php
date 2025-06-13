<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'fecha_nacimiento'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    //Métodos requeridos por JWTSubject

    public function getJWTIdentifier()
    {
        return $this->getKey(); // normalmente el ID del usuario
    }

    public function getJWTCustomClaims()
    {
        return []; // puedes incluir más info aquí si quieres
    }

    public function mascotas() {
        return $this->hasMany(\App\Models\Mascota::class);
    }
}
