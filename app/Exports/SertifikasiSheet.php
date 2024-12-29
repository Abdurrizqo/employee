<?php

namespace App\Exports;

use App\Models\Sertifikasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class SertifikasiSheet implements FromCollection, WithHeadings, WithTitle, ShouldAutoSize
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
        $query = Sertifikasi::select(
            'sertifikasis.id_user',
            'sertifikasis.sertifikasi',
            'sertifikasis.tahun',
            'sertifikasis.penyelenggara',
            'sertifikasis.tingkat',
            'users.id_ranting',
            'rantings.nama_ranting'
        )
            ->leftJoin('users', 'sertifikasis.id_user', '=', 'users.id') // Hubungkan Sertifikasi dengan User
            ->leftJoin('rantings', 'users.id_ranting', '=', 'rantings.id'); // Hubungkan User dengan Ranting

        // Tambahkan filter jika $this->ranting tidak null
        if ($this->ranting) {
            $query->where('users.id_ranting', $this->ranting);
        }

        // Ambil data dan map hasilnya
        return $query->get()->map(function ($item) {
            return [
                'User ID' => $item->id_user,
                'Sertifikasi' => $item->sertifikasi,
                'Tahun' => $item->tahun,
                'Penyelenggara' => $item->penyelenggara,
                'Tingkat' => $item->tingkat,
                'Ranting' => $item->nama_ranting, // Menampilkan Ranting dari tabel rantings
            ];
        });
    }

    public function title(): string
    {
        return 'Data Sertifikasi Anggota';
    }

    public function headings(): array
    {
        return [
            'User ID',
            'Sertifikasi',
            'Tahun',
            'Penyelenggara',
            'Tingkat',
        ];
    }
}
