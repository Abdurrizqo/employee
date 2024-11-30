<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'admins';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'password',
        'nama_admin',
        'is_active',
        'id_ranting',
    ];

    protected $hidden = [
        'password',
    ];

    public function ranting()
    {
        return $this->belongsTo(Ranting::class, 'id_ranting', 'id');
    }
}
