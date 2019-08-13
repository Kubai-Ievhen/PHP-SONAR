<?php
declare(strict_types=1);

namespace Tests\Unit;

use App\TestCase;

use App\Http\Controllers\DataController;

class ControllerTest extends TestCase
{ 
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue((new DataController)->testingData() == [1,2,3]);
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testTestingData2()
    {
        $this->assertTrue((new DataController)->testingData2() == [1,2,3]);
    }
}
