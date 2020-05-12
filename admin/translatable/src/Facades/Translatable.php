<?php

namespace Savannabits\Translatable\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Savannabits\Translatable\Translatable
 */
class Translatable extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'translatable';
    }
}
