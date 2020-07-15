<?php

use Illuminate\Database\Seeder;
use App\Item;
use App\Area;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ItemSeeder::class,
            AreaSeeder::class,
        ]);
    }
}
