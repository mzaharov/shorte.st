<?php

namespace Mzaharov\Shortest\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Shortest
 *
 * @package Mzaharov\Shortest\Facades
 */
class Shortest extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Mzaharov\Shortest\Shortest';
    }
}