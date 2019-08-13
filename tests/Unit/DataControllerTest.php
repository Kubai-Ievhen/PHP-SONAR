<?php

namespace Tests\Unit;

use App\Http\Controllers\DataController;
use Tests\TestCase;

class DataControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetData()
    {
        $this->assertTrue(((new DataController())->getData() == [1,2,3]));
    }
}
