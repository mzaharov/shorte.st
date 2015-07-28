<?php

namespace Appsketch\Shortest\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Shortest
 *
 * @package Appsketch\Shortest\Facades
 */
class Shortest extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Appsketch\Shortest\Shortest';
    }
}