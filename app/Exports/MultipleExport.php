<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleExport implements WithMultipleSheets
{

    protected $ranting;

    public function __construct($ranting = null)
    {
        $this->ranting = $ranting;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function sheets(): array
    {
        return [
            new BiodataSheet($this->ranting),
            new JabatanSheet($this->ranting),
            new SertifikasiSheet($this->ranting),
            new PengesahanSheet($this->ranting),
            new PrestasiSheet($this->ranting),
            new RiwayatLatihanSheet($this->ranting),
        ];
    }
}
