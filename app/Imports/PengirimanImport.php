<?php

namespace App\Imports;

use App\Models\Pengiriman;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengirimanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pengiriman([
            // 
                
                'idpermintaan' => $row['1'] ,
                'nokeluar' => $row['2'] ,
                'nopermintaan' => $row['3'],
                'tglpermintaan' => $row['4'],
                'tglkeluar' => $row['5'],
                'pengirim' => $row['6'],
                // 'nostok' => $row['6'],

        ]);
    }
    public function rules(): array
    {
        return [
            'nokeluar' => 'required',
            'nopermintaan' => 'required',
            'tglpermintaan' => 'required',
            'tglkeluar' => 'required',
            'pengirim' => 'required',
            'nostok' => 'required',

        ];
    }
}
