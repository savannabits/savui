<?php

namespace Savannabits\AdminAuth\Tests;

abstract class BracketsTestCase extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->adminAuthGuard = config('admin-auth.defaults.guard');
    }
}
