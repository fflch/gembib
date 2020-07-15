<?php

use Illuminate\Database\Seeder;
use App\Area;

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
        factory(Area::class, 20)->create();
    }
}
