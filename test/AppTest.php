<?php

namespace Test;

use PHPUnit\Framework\TestCase;
use App\App;

class AppTest extends TestCase
{
    public function test_it_works()
    {
        $this->assertTrue(App::run());
    }
}