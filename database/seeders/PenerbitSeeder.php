<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class PenerbitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('penerbit')->insert([
            [
                'nama'         => 'Penerbit 1',
                'lokasi'       => "Jakarta",
                'created_at'   => date("Y-m-d H:i:s")
            ],
            [
                'nama'         => 'Penerbit 2',
                'lokasi'       => "Surabaya",
                'created_at'   => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
