<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RecipeFavorite;

class FavoriteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        #RecipeFavorite::factory(120)->create();

        # Seed sequentially instead, slower but prevents duplicates
        for ($i = 0; $i < 30; $i++) {
            RecipeFavorite::factory()->create();
        }
    }
}
