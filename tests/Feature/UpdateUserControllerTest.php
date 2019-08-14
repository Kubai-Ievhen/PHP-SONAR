<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserControllerTest extends TestCase
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
        $this->put($this->url."/$user_id", ['name' => 'test'])->assertStatus(200);
        $this->assertDatabaseHas('users', ['name' => 'test', 'id' => $user_id]);
    }
}
