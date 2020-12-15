<?php

namespace Tepuilabs\LaravelInstapago;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Tepuilabs\LaravelInstapago\LaravelInstapago
 */
class LaravelInstapagoFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-instapago';
    }
}
