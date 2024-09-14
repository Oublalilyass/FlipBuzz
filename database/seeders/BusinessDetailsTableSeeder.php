<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class BusinessDetailsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Get all listings IDs
        $listingIds = DB::table('listings')->pluck('id');

        foreach ($listingIds as $listingId) {
            DB::table('business_details')->insert([
                'listing_id' => $listingId,
                'about_the_business' => $faker->paragraph,
                'comparisons_benchmarking' => $faker->sentence,
                'revenue_expenses' => json_encode([
                    'monthly_revenue' => $faker->randomFloat(2, 10000, 50000),
                    'expenses' => $faker->randomFloat(2, 500, 5000)
                ]),
                'performance_data' => json_encode([
                    'PayPal' => $faker->randomFloat(2, 1000, 10000),
                    'Shopify' => $faker->randomFloat(2, 1000, 10000)
                ]),
                'google_analytics_data' => json_encode([
                    'sessions' => $faker->numberBetween(1000, 50000),
                    'bounce_rate' => $faker->randomFloat(2, 10, 70)
                ]),
                'monetization_methods' => $faker->randomElement(['eCommerce', 'Affiliate Marketing', 'Advertising']),
                'products_services_used' => $faker->words(3, true),
                'sale_includes' => $faker->sentence,
                'social_media' => $faker->randomElement(['Facebook', 'Instagram', 'Twitter']),
                'attachments' => json_encode([$faker->fileExtension(), $faker->fileExtension()]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

