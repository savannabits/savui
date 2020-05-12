<?php

namespace Savannabits\Translatable\Test\Feature;

use Savannabits\Translatable\Test\TestCase;
use Savannabits\Translatable\Translatable;

class TranslatableTest extends TestCase
{
    /** @test */
    public function package_can_define_used_locales()
    {
        $translatable = app(Translatable::class);
        $this->assertEquals(collect(['en', 'de', 'fr']), $translatable->getLocales());
    }
}
