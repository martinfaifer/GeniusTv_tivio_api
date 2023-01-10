<?php

namespace Database\Seeders;

use App\Models\AppCategory;
use Illuminate\Database\Seeder;

class AppCategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (! AppCategory::where('category', 'diagnostic')->first()) {
            AppCategory::create([
                'category' => 'diagnostic',
            ]);
        }

        if (! AppCategory::where('category', 'TV')->first()) {
            AppCategory::create([
                'category' => 'TV',
            ]);
        }

        if (! AppCategory::where('category', 'androidTV')->first()) {
            AppCategory::create([
                'category' => 'androidTV',
            ]);
        }

        if (! AppCategory::where('category', 'androidMobile')->first()) {
            AppCategory::create([
                'category' => 'androidMobile',
            ]);
        }

        if (! AppCategory::where('category', 'LGTV')->first()) {
            AppCategory::create([
                'category' => 'LGTV',
            ]);
        }
    }
}
