<?php

namespace Tests\Unit;

use App\Http\Controllers\UserController;
use App\Models\User;
use Dingo\Api\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreUserControllerTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $request = new Request();
        $request->merge(['email' => 'test@email.com', 'password' => '1324679', 'name' => 'test']);
        $response = (new UserController())->store($request, new User());
        $this->assertTrue($response->email == 'test@email.com');
    }
}
