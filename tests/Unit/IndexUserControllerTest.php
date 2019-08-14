<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexUserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->generateUser(10);
        $data = (new UserController())->index();
        $this->assertTrue(count($data) == 10);
    }
}
