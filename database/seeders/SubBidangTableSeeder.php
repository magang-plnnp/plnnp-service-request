<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubBidangTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sub_bidang')->insert([
            ['nama' => 'Sub Bagian Umum', 'created_at' => now(), 'updated_at' => now()],
            ['nama' => 'Sub Bagian Teknik', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
