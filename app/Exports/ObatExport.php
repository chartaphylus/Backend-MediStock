<?php

namespace App\Exports;

use App\Models\Obat;
use Maatwebsite\Excel\Concerns\FromCollection;

class ObatExport implements FromCollection
{
    public function collection()
    {
        return Obat::all();
    }
}
