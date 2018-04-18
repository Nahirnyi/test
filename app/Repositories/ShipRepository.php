<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 18.04.2018
 * Time: 20:53
 */

namespace App\Repositories;

use App\Ship;


class ShipRepository
{
    /**
     * @param $company
     * @param $data
     * @return Ship
     */
    public function add($company, $data): Ship
    {
        $ship = new Ship();
        $ship->name = $data['name'];
        $ship->company_id = $company->id;
        $ship->save();

        return $ship;
    }

    /**
     * @param $company
     * @return Ship
     */
    public function all($company): Ship
    {
        $ships = $company->ships()->get();

        return $ships;
    }

    /**
     * @param $company
     * @param $ship
     * @param $data
     * @return Ship
     */
    public function update($company, $ship, $data): Ship
    {
        $ship->name = $data['name'];
        $ship->company_id = $company->id;
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