<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexUserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->generateUser(10);
        $response = $this->get($this->url)->assertStatus(200);
        $this->assertTrue(count(json_decode($response->content())) == 10);
    }
}
