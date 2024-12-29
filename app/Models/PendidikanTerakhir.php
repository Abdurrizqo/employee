<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PendidikanTerakhir extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pendidikan_terakhirs';

    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_user',
        'pendidikan_terakhir',
        'jurusan',
        'tahun_lulus',
        'ijazah'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
