<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 15; $i++) {
            $data = [
                'username' => $faker->name,
                'password' => md5('123456768')
            ];

            $this->db->table('user')->insert($data);
        }
    }
}