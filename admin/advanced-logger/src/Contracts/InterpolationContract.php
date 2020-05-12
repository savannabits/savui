<?php

namespace Savannabits\AdvancedLogger\Contracts;

/**
 * Interface InterpolationContract
 */
interface InterpolationContract
{
    /**
     * @param string $text
     * @return string
     */
    public function interpolate(string $text): string;
}
