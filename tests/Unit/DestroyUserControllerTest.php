<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyUserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = $this->generateUser();
        $user_id = array_first($user)->id;
        $this->assertDatabaseHas('users', ['id' => $user_id]);
        (new UserController())->destroy(array_first($user));
        $this->assertDatabaseMissing('users', ['id' => $user_id]);
    }
}
