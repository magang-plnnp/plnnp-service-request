<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class PermintaanMakananSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();
        for ($i = 0; $i < 20; $i++) {
            DB::table('permintaan_makanan')->insert([
                'nama' => $faker->name(),
                'nid' => $faker->numerify('######'),
                'sub_bidang_id' => $faker->numberBetween(1, 2),
                'no_hp' => $faker->phoneNumber(),
                'judul_agenda' => $faker->sentence(3),
                'tanggal' => $faker->dateTimeBetween('+1 days', '+1 week')->format('Y-m-d'),
                'durasi' => $faker->numberBetween(1, 4),
                'jumlah' => $faker->numberBetween(10, 50),
                'lokasi' => $faker->address(),
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
