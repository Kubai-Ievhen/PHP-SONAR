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
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testTestingData2()
    {
        $this->assertTrue((new TestController)->testingData2() == [1,2,3]);
    }
}
