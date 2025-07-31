<?php

namespace App\Imports;

use App\Models\Permintaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
class PermintaanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Permintaan([
            //
            'nopermintaan'     => $row[1],
            'nopengiriman'  => $row[2],
            'tglminta'    => $row[3],
            'tujuan' => $row[4],
            'nostok' => $row[5],
            'nokantong' => $row[6],
            'jnsdarah' => $row[7],
            'gol' => $row[8],
            'rhesus' => $row[9],
            'tglaftap' => $row[10],
            'tglexp' => $row[11],
            // 'create_at' => $row[12],
            // 'update_at' => $row[13],
        ]);
      
    }
    public function rules(): array
    {
        return [
            'nopermintaan' => 'required',
            'nopengiriman' => 'required',
            'tglminta' => 'required',
            'tujuan' => 'required',
            'nostok' => 'required',
            'nokantong' => 'required',
            'jnsdarah' => 'required',
            'gol' => 'required',
            'rhesus' => 'required',
            'tglaftap' => 'required',
            'tglexp' => 'required',



        ];
    }
}
