<?php

namespace App\Exports;

use App\Models\Pengesahan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class PengesahanSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
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
        $query = Pengesahan::select(
            'pengesahans.id_user',
            'pengesahans.tingkat',
            'pengesahans.cabang',
            'pengesahans.tahun',
            'users.id_ranting',
            'rantings.nama_ranting'
        )
            ->leftJoin('users', 'pengesahans.id_user', '=', 'users.id') // Hubungkan Pengesahan dengan User
            ->leftJoin('rantings', 'users.id_ranting', '=', 'rantings.id'); // Hubungkan User dengan Ranting

        // Tambahkan filter jika $this->ranting tidak null
        if ($this->ranting) {
            $query->where('users.id_ranting', $this->ranting);
        }

        // Ambil data dan map hasilnya
        return $query->get()->map(function ($item) {
            return [
                'User ID' => $item->id_user,
                'Tingkat' => $item->tingkat,
                'Cabang' => $item->cabang,
                'Tahun' => $item->tahun,
                'Ranting' => $item->nama_ranting, // Menampilkan Ranting dari tabel rantings
            ];
        });
    }

    public function title(): string
    {
        return 'Data Pengesahan Anggota';
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Tingkat',
            'Cabang',
            'Tahun',
        ];
    }
}
