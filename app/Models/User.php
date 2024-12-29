<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasUuids, Notifiable, HasApiTokens;

    protected $table = 'users';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'password',
        'nama_user',
        'is_active',
        'is_open',
        'id_ranting',
    ];

    public function ranting()
    {
        return $this->belongsTo(Ranting::class, 'id_ranting', 'id');
    }

    protected $hidden = [
        'password',
    ];
}
