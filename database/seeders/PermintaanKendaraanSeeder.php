<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PermintaanKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('permintaan_kendaraan')->insert([
                'nama' => $faker->name(),
                'nid' => $faker->numerify('######'),
                'sub_bidang_id' => $faker->numberBetween(1, 2),
                'no_hp' => $faker->phoneNumber(),
                'lokasi_penjemputan' => $faker->address(),
                'tanggal_waktu' => $faker->dateTimeBetween('+1 days', '+1 week'),
                'tujuan' => $faker->sentence(),
                'file' => null,
                'status' => 'pending',
                'approved_by' => null,
                'approved_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
