<?php namespace Satudata\Hargaberlaku\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * The Hargaberlaku facade.
 *
 * @package Satudata\Hargaberlaku
 * @author  MKI <info@mkitech.net>
 */
class Hargaberlaku extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'hargaberlaku';
    }
}
