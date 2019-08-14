<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowUserControllerTest extends TestCase
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
        $response = (new UserController())->show(User::find($user_id));
        $this->assertTrue($response->email == array_first($user)->email);
    }
}
