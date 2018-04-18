<?php
/**
 * Created by PhpStorm.
 * User: SLAVIK
 * Date: 18.04.2018
 * Time: 21:08
 */

namespace App\Repositories;

use App\Container;

class ContainerRepository
{
    /**
     * @param $ship
     * @param $data
     * @return Container
     */
    public function add($ship, $data):Container
    {
        $container = new Container();
        $container->name = $data('name');

        if ($data['ship_id'])
        {
            $container->ship_id = $data('ship_id');
        } elseif($ship)
        {
            $container->ship()->associate($ship);
        }

        $container->price = $data('price');
        $container->save();

        return $container;
    }

    /**
     * @param $ship
     * @return Container
     */
    public function all($ship): Container
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
     * @param $container
     * @param $data
     * @param $ship
     * @return Container
     */
    public function update($container, $data, $ship): Container
    {
        $container->name = request('name');
        if ($data['ship_id'])
        {
            $container->ship_id = request('ship_id');
        } elseif ($ship)
        {
            $container->ship_id = $ship->id;
        }

        $container->price = request('price');
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