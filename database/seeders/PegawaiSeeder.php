<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pegawai;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pegawai::create([
            'name' => 'Iqbal',
            'nik' => '1111111111110001',
            'pob' => 'solo',
            'dob' => '1990-05-15',
            'department_id' => 1,
            'ava' => 'avatar1.jpg',
        ]);

        Pegawai::create([
            'name' => 'Iqbal 2',
            'nik' => '1111111111110002',
            'pob' => 'solo juga',
            'dob' => '1995-10-20',
            'department_id' => 2,
            'ava' => 'avatar2.jpg',
        ]);

    }
}
