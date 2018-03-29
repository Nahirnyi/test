<?php

use Illuminate\Database\Seeder;

class TrackTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $routes = \App\Route::all();
        foreach ($routes as $route)
        {
            $rand = random_int(10, 100);
            factory(App\Track::class, $rand)->create(['route_id' => $route->id]);
        }
    }
}
