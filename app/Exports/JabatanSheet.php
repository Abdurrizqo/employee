<?php

namespace App\Exports;

use App\Models\Jabatan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class JabatanSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
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
        $query = Jabatan::select(
            'jabatans.id_user',
            'jabatans.lokasi_jabatan',
            'jabatans.jabatan',
            'users.id_ranting',
            'rantings.nama_ranting'
        )
            ->leftJoin('users', 'jabatans.id_user', '=', 'users.id') // Hubungkan Jabatan dengan User
            ->leftJoin('rantings', 'users.id_ranting', '=', 'rantings.id'); // Hubungkan User dengan Ranting

        // Tambahkan filter jika $this->ranting tidak null
        if ($this->ranting) {
            $query->where('users.id_ranting', $this->ranting);
        }

        // Ambil data dan map hasilnya
        return $query->get()->map(function ($item) {
            return [
                'User ID' => $item->id_user,
                'Lokasi Jabatan' => $item->lokasi_jabatan,
                'Jabatan' => $item->jabatan,
                'Ranting' => $item->nama_ranting,
            ];
        });
    }

    public function title(): string
    {
        return 'Data Jabatan Anggota';
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Lokasi Jabatan',
            'Jabatan',
        ];
    }
}