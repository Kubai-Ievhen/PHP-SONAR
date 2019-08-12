<?php

namespace Tests\Unit;

use App\TestCase;

use App\Http\Controllers\TestController;

class ControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue((new TestController)->testingData() == [1,2,3]);
    }
}
