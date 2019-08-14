<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    protected $url = '/users';

    public function setUp() : void
    {
        parent::setUp();
        Artisan::call('migrate');
    }

    protected function generateUser(int $count = 1, array $data = [])
    {
       return factory(User::class, $count)->create($data);
    }
}
