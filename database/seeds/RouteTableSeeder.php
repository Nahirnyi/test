<?php

use Illuminate\Database\Seeder;

class RouteTableSeeder extends Seeder
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
            $rand = random_int(5, 10);
            factory(App\Route::class, $rand)->create(['ship_id' => $ship->id]);
        }
    }
}
