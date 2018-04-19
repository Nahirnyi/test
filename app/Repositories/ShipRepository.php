<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 18.04.2018
 * Time: 20:53
 */

namespace App\Repositories;

use App\Company;
use App\Ship;
use Illuminate\Support\Collection;


class ShipRepository
{
    /**
     * @param Company $company
     * @param array $data
     * @return Ship
     */
    public function add(Company $company, array $data) : Ship
    {
        $ship = new Ship($data);
        $ship->company()->associate($company);
        $ship->save();

        return $ship;
    }

    /**
     * @param $company
     * @return Collection
     */
    public function all($company) : Collection
    {
        $ships = $company->ships()->get();

        return $ships;
    }

    /**
     * @param Company $company
     * @param Ship $ship
     * @param array $data
     * @return Ship
     */
    public function update(Company $company, Ship $ship, array $data) : Ship
    {
        $ship->fill($data);
        $ship->company()->associate($company);
        $ship->save();

        return $ship;
    }

    /**
     * @param $ship
     */
    public function delete($ship)
    {
        $ship->delete();
    }

}