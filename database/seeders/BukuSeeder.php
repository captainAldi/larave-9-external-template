<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('buku')->insert([
            [
                'judul'         => 'Buku 1',
                'edisi_ke'      => 1,
                'penerbit_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 2',
                'edisi_ke'      => 2,
                'penerbit_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 3',
                'edisi_ke'      => 2,
                'penerbit_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 4',
                'edisi_ke'      => 1,
                'penerbit_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 5',
                'edisi_ke'      => 1,
                'penerbit_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 6',
                'edisi_ke'      => 1,
                'penerbit_id'   => 1,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 7',
                'edisi_ke'      => 1,
                'penerbit_id'   => 2,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 8',
                'edisi_ke'      => 1,
                'penerbit_id'   => 2,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 9',
                'edisi_ke'      => 1,
                'penerbit_id'   => 2,
                'created_at'    => date("Y-m-d H:i:s")
            ],
            [
                'judul'         => 'Buku 10',
                'edisi_ke'      => 1,
                'penerbit_id'   => 2,
                'created_at'    => date("Y-m-d H:i:s")
            ],

        ]);
    }
}
