<?php

namespace App\Exports;

use App\Models\Biodata;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BiodataSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
{
    protected $ranting;

    public function __construct($ranting = null)
    {
        $this->ranting = $ranting;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Biodata::select(
            'biodatas.*',
            'pendidikan_terakhirs.*',
            'users.id as user_id',
            'users.id_ranting',
            'rantings.id as ranting_id',
            'rantings.nama_ranting'
        )
            ->leftJoin('users', 'biodatas.id_user', '=', 'users.id') // Hubungkan Biodata dengan User
            ->leftJoin('pendidikan_terakhirs', 'pendidikan_terakhirs.id_user', '=', 'users.id') // Hubungkan User dengan Pendidikan
            ->leftJoin('rantings', 'users.id_ranting', '=', 'rantings.id'); // Hubungkan User dengan Ranting

        // Tambahkan filter jika $this->ranting tidak null
        if ($this->ranting) {
            $query->where('users.id_ranting', $this->ranting);
        }

        // Ambil data dan map hasilnya
        return $query->get()->map(function ($item) {
            return [
                'User ID' => $item->user_id,
                'Nama Lengkap' => $item->nama_lengkap,
                'Ranting' => $item->nama_ranting,
                'Nomer Induk Warga' => $item->nomer_induk_warga,
                'Nomer Induk Keluarga' => $item->nomer_induk_keluarga,
                'Tempat Lahir' => $item->tempat_lahir,
                'Tanggal Lahir' => $item->tanggal_lahir,
                'Jenis Kelamin' => $item->jenis_kelamin,
                'Status Pernikahan' => $item->status_pernikahan,
                'Alamat' => $item->alamat,
                'Jenis Pekerjaan' => $item->jenis_pekerjaan,
                'Lembaga Instansi' => $item->lembaga_instansi,
                'Alamat Instansi' => $item->alamat_lembaga_instansi,
                'Pendidikan Terakhir' => $item->pendidikan_terakhir,
                'Jurusan' => $item->jurusan,
                'Tahun Lulus' => $item->tahun_lulus,
            ];
        });
    }

    public function title(): string
    {
        return 'Biodata Anggota';
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Nama Lengkap',
            'Ranting',
            'Nomer Induk Warga',
            'Nomer Induk Keluarga',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Status Pernikahan',
            'Alamat',
            'Jenis Pekerjaan',
            'Lembaga Instansi',
            'Alamat Instansi',
            'Pendidikan Terakhir',
            'Jurusan',
            'Tahun Lulus',
        ];
    }
}
