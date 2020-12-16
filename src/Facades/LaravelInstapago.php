<?php

namespace Tepuilabs\LaravelInstapago\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tepuilabs\LaravelInstapago\LaravelInstapago
 */
class LaravelInstapago extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Tepuilabs\LaravelInstapago\LaravelInstapago::class;
    }
}
