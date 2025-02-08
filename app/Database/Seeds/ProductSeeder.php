<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        //create product with faker
        $faker = \Faker\Factory::create();

        //create 50000 produts
        $total_products = 50000;
        $products = [];
        //insert products to database in batch
        for ($i = 0; $i < $total_products; $i++) {
            $data = [
                'product_name'          => $faker->sentence(4),
                'category'              => $faker->randomElement(['Vegetais','Frutas','Carnes','Doceis','Salgados','Laticíneos']),
                'price_per_unit'        => $faker->randomFloat(2, 1, 17),
                'stock'                 => $faker->numberBetween(1, 20000),
                'created_at'            => $faker->dateTimeBetween('-5 year','now')->format('Y-m-d H:i:s'),
            ];

            $products[] = $data;
        }

        $this->db->table('products')->insertBatch($products);

        echo PHP_EOL . ($total_products).' registos inseridos com sucesso '.PHP_EOL;

    }
}
