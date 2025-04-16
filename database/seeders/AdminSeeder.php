<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        //
        DB::table('admins')->insert([
            [
                'nama' => 'Arief Dwi Cahyo Adi',
                'jenis_kelamin' => 'Laki-laki',
                'alamat' => 'Jl. Raya No. 1',
                'no_telp' => '08123456789',
                'email' => 'arief.adii94@gmail.com',
                'status' => 'Aktif',
                'foto' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Linda Mayasari',
                'jenis_kelamin' => 'Perempuan',
                'alamat' => 'Jl. Raya No. 1',
                'no_telp' => '08123456789',
                'email' => 'linda_maya01@gmail.com',
                'status' => 'Aktif',
                'foto' => NULL,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
