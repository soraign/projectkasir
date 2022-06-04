<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');
        $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));
        for ($i = 0; $i < 80; $i++) {
            $data = [
                'nama' => $faker->foodName(),
                'harga' => $faker->numberBetween(20000, 90000),
                'user_id' => $faker->numberBetween(1, 15),
                'gambar' => $faker->imageUrl(),
                'kategori' => $faker->randomElement(['makanan', 'minuman']),
            ];

            $this->db->table('menu')->insert($data);
        }
    }
}