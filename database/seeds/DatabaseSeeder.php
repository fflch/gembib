<?php

use Illuminate\Database\Seeder;
use App\Item;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ItemSeeder::class);
        factory(Item::class, 100)->create();
    }
}
