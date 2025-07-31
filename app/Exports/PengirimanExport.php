<?php

namespace App\Exports;

use App\Models\Pengiriman;
use Maatwebsite\Excel\Concerns\FromCollection;

class PengirimanExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select("id", "nokeluar", 
            "nopermintaan", "tglpermintaan","tglkeluar","pengirim","nostok" 
            
            )->get();

    }

    public function headings(): array

    {

        return ["id", "nokeluar", 
            "nopermintaan", "tglpermintaan","tglkeluar","pengirim","nostok" ];

    }
}
