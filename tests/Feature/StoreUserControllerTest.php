<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreUserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->post($this->url, ['email' => 'test@email.com', 'password' => '1324679', 'name' => 'test'])->assertStatus(200);
        $this->assertDatabaseHas('users', ['email' => 'test@email.com']);
    }
}
