<?php

use Illuminate\Database\Seeder;

class ContainerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ships = \App\Ship::all();
        foreach ($ships as $ship)
        {
            $rand = random_int(20, 50);
            factory(App\Container::class, $rand)->create(['ship_id' => $ship->id]);
        }
    }
}
