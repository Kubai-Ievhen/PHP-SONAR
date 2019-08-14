<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DestroyUserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $user = $this->generateUser();
        $user_id = array_first($user)->id;
        $this->assertDatabaseHas('users', ['id' => $user_id]);
        $response = $this->delete($this->url."/$user_id")->assertStatus(200);
        $this->assertDatabaseMissing('users', ['id' => $user_id]);
    }
}
