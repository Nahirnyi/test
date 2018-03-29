<?php

use Illuminate\Database\Seeder;

class ShipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $companies = \App\Company::all();
        foreach ($companies as $company)
        {
            $rand = random_int(2, 10);
            factory(App\Ship::class, $rand)->create(['company_id' => $company->id]);
        }


    }
}
