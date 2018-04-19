<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 18.04.2018
 * Time: 21:08
 */

namespace App\Repositories;

use App\Container;
use App\Ship;
use Illuminate\Support\Collection;

class ContainerRepository
{
    /**
     * @param array $data
     * @param Ship $ship
     * @return Container
     */
    public function add(array $data, Ship $ship) : Container
    {
        $container = new Container($data);
        $container->ship()->associate($ship);
        $container->save();

        return $container;
    }

    /**
     * @param $ship
     * @return Collection
     */
    public function all($ship): Collection
    {
        if ($ship)
        {
            $containers = $ship->containers()->get();
        } else {
            $containers = Container::all();
        }

        return $containers;
    }

    /**
     * @param Container $container
     * @param array $data
     * @param Ship $ship
     * @return Container
     */
    public function update(Container $container, array $data, Ship $ship) : Container
    {
        $container->fill($data);
        $container->ship()->associate($ship);
        $container->save();

        return $container;
    }

    /**
     * @param $container
     */
    public function delete($container)
    {
        $container->delete();
    }
}