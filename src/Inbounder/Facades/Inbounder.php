<?php

namespace Inbounder\Facades;

use Illuminate\Support\Facades\Facade;

class Inbounder extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'inbounder'; }
}