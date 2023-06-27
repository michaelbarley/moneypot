<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Pot::factory()->count(10)->create();
    }
}
