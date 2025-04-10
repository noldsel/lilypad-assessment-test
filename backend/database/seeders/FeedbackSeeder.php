<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();

        $feedbackData = [];

        for ($i = 0; $i < 520; $i++) {
            $feedbackData[] = [
                'customer_name' => $faker->name(),
                'message' => $faker->paragraph(),
                'rating' => $faker->numberBetween(1, 5),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('feedback')->insert($feedbackData);
    }
}
