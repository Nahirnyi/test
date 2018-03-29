<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(ShipTableSeeder::class);
        $this->call(ContainerTableSeeder::class);
        $this->call(RouteTableSeeder::class);
        $this->call(TrackTableSeeder::class);
    }
}
