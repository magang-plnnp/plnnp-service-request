<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DurasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('durasi')->insert([
            [
                'id' => 1,
                'nama' => '1-2 Jam',
                'keterangan' => '1-2 Jam mendapat 1x Snack',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'nama' => '3-5 Jam',
                'keterangan' => '3-5 Jam mendapat 1x Snack & 1x Makan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'nama' => '6-8 Jam',
                'keterangan' => '6-8 Jam mendapat 2x Snack & 1x Makan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'nama' => 'Pekerjaan Pemeliharaan',
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'nama' => 'Pekerjaan Operasi',
                'keterangan' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
