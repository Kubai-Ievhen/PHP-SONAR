<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use Dingo\Api\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserControllerTest extends TestCase
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
        $request = new Request();
        $request->merge(['name' => 'test']);
        $response = (new UserController())->update($request, User::find($user_id));
        $this->assertTrue($response->name == 'test');
    }
}
