<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('departments')->insert([
          ['bagian' => 'DOKUMEN DATA & IT',
                'user_id' => '1','department_id' => '1'
            ],
            ['bagian' => 'Gudang',
                 'user_id' => '1','department_id' => '2'
            ],
             ['bagian' => 'Manager',
                'user_id' => '99','department_id' => '99'],
            ['bagian' => 'HRD',
                'user_id' => '1','department_id' => '3'],
            ['bagian' => 'ADMIN DONOR (PDK)',
                'user_id' => '1','department_id' => '4'],
            ['bagian' => 'IMLTD',
                'user_id' => '1','department_id' => '5'],
            ['bagian' => 'AFTAP (PDK)',
                'user_id' => '1','department_id' => '6'],
            ['bagian' => 'PELULUSAN PRODUK DISTRIBUSI',
                'user_id' => '1','department_id' => '7'],
            ['bagian' => 'PENGOLAHAN DARAH KOMPONEN',
                'user_id' => '1','department_id' => '8'],
            ['bagian' => 'DRIVER',
                'user_id' => '1','department_id' => '9'],
            ['bagian' => 'DISTRIBUSI (PPD)',
                'user_id' => '1','department_id' => '10'],
            ['bagian' => 'UJI SILANG DARAH',
                'user_id' => '1','department_id' => '11'],
            ['bagian' => 'LOGISTIK',
                'user_id' => '1','department_id' => '12'],
            ['bagian' => 'PENGUJIAN DARAH',
                'user_id' => '1','department_id' => '13'],
            ['bagian' => 'KEUANGAN',
                'user_id' => '1','department_id' => '14'],
            ['bagian' => 'RUJUKAN DAN LITBANG',
                'user_id' => '1','department_id' => '15'],
            ['bagian' => 'PEMASTIAN MUTU',
                'user_id' => '1','department_id' => '16'],
            ['bagian' => 'PANTRY (PDK)',
                'user_id' => '1','department_id' => '17'],
            ['bagian' => 'BARCODE',
                'user_id' => '1','department_id' => '18'],
            ['bagian' => 'SECURITY',
                'user_id' => '1','department_id' => '19'],
            ['bagian' => 'POLY',
                'user_id' => '1','department_id' => '20'],
        ]);
    }
}
