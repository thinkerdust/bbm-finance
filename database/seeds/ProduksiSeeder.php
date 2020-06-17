<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProduksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');
 
    	for($i = 1; $i <= 50; $i++){
 
    	      // insert data ke table pegawai menggunakan Faker
    		DB::table('produksi')->insert([
    			'customer' => strtoupper($faker->name),
                'lokasi_proyek' => strtoupper($faker->address),
                'tgl_pengecoran' => $faker->dateTime($max = 'now'),
                'mutu_beton' => '12',
                'volume' => $faker->randomDigitNot(0),
                'harga_m3' => $faker->numberBetween($min = 1000, $max = 9000),
                'sum_harga' => $faker->numberBetween($min = 1000, $max = 9000),
                'keterangan' => '01',
                'created_at' => $faker->dateTime($max = 'now'),
    		]);
 
    	}
    }
}
