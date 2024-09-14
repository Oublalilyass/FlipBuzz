<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class ListingsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('listings')->insert([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'type' => $faker->randomElement(['Shopify', 'WooCommerce', 'Amazon FBA']),
                'images' => json_encode([$faker->imageUrl(), $faker->imageUrl()]),
                'site_age' => $faker->numberBetween(1, 10),
                'monthly_profit' => $faker->randomFloat(2, 1000, 10000),
                'profit_margin' => $faker->randomFloat(2, 10, 50),
                'page_views' => $faker->numberBetween(1000, 50000),
                'profit_multiple' => $faker->randomFloat(2, 1, 5),
                'revenue_multiple' => $faker->randomFloat(2, 1, 5),
                'price' => $faker->randomFloat(2, 5000, 50000),  // Adding the price
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}