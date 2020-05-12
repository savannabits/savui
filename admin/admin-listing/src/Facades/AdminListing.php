<?php

namespace Savannabits\AdminListing\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Savannabits\AdminListing\AdminListing
 */
class AdminListing extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'admin-listing';
    }
}
