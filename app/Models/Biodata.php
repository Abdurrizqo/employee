<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    use HasFactory, HasUuids;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'biodatas';

    /**
     * The primary key for the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_user',
        'nama_lengkap',
        'nomer_induk_warga',
        'nomer_induk_keluarga',
        'tempat_lahir',
        'kartu_warga',
        'ktp',
        'tanggal_lahir',
        'jenis_kelamin',
        'status_pernikahan',
        'alamat',
        'jenis_pekerjaan',
        'lembaga_instansi',
        'alamat_lembaga_instansi',
    ];
}
