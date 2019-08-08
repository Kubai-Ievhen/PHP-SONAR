<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * @return array
     */
    public function testingData()
    {
        return [1,2,3];
    }

    /**
     * @return array
     */
    public function testingData2()
    {
        return [1,2,3];
    }
}
