<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Area;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $area = [
            'codigo' => '30101000',
            'nome' => 'CONSTRUÇÃO CIVIL',
        ];
        Area::create($area);
        Area::factory(100)->create();
    }
}
