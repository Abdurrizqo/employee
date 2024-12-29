<?php

namespace App\Exports;

use App\Models\Prestasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PrestasiSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
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
        $query = Prestasi::select(
            'prestasis.id_user',
            'prestasis.prestasi',
            'prestasis.tahun',
            'prestasis.tingkat',
            'users.id_ranting',
            'rantings.nama_ranting'
        )
            ->leftJoin('users', 'prestasis.id_user', '=', 'users.id') // Hubungkan Prestasi dengan User
            ->leftJoin('rantings', 'users.id_ranting', '=', 'rantings.id'); // Hubungkan User dengan Ranting

        // Tambahkan filter jika $this->ranting tidak null
        if ($this->ranting) {
            $query->where('users.id_ranting', $this->ranting);
        }

        // Ambil data dan map hasilnya
        return $query->get()->map(function ($item) {
            return [
                'User ID' => $item->id_user,
                'Prestasi' => $item->prestasi,
                'Tahun' => $item->tahun,
                'Tingkat' => $item->tingkat,
                'Ranting' => $item->nama_ranting, // Menampilkan Ranting dari tabel rantings
            ];
        });
    }

    public function title(): string
    {
        return 'Data Prestasi Anggota';
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Prestasi',
            'Tahun',
            'Tingkat',
        ];
    }
}
