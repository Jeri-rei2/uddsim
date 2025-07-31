<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         DB::table('users')->insert([
            ['name' => 'admin',
            'department_id' => '1',
            'bagian'=> 'IT',
            'user_id'=> '1',
            'email'=> 'admin@gmail.com',
            'email_verified_at'=> '',
            'password'=> '$2y$10$MQzPOWTrMZ3NAK3ac2Vl5eFvIdPI.Ua9v0QZUqUQfFN4PkAJywsPe',
            'phone_number'=> '0815151221',
            'nik'=> '351512142222',
            'alamat'=> 'jl.kapuas',
            'type'=> '1',
            'picture'=> 'default.png',
            'token'=> '',
            'remember_token'=> '',
        
            ],
            ['name' => 'manager', 
             'department_id' => '99',
             'user_id'=> '99',
                'bagian'=> 'manager',
                'email'=> 'manager@gmail.com',
                'email_verified_at'=> '',
                'password'=> '$2y$10$MQzPOWTrMZ3NAK3ac2Vl5eFvIdPI.Ua9v0QZUqUQfFN4PkAJywsPe',
                'phone_number'=> '0815151221',
                'nik'=> '351512142222',
                'alamat'=> 'jl.kencana',
                'type'=> '1',
                'picture'=> 'default.png',
                'token'=> '',
                'remember_token'=> '',
            ],
            ['name' => 'coba usr',
             'department_id' => '2',
             'user_id'=> '3',
            'bagian'=> 'manager',
            'email'=> 'user@gmail.com',
            'email_verified_at'=> '',
            'password'=> '$2y$10$MQzPOWTrMZ3NAK3ac2Vl5eFvIdPI.Ua9v0QZUqUQfFN4PkAJywsPe',
            'phone_number'=> '0815151221',
            'nik'=> '351512142222',
            'alamat'=> 'jl.faasds',
            'type'=> '0',
            'picture'=> 'default.png',
            'token'=> '',
            'remember_token'=> '',
            
            ],

        ]);
    }
}
