<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataController extends Controller
{
    /**
     * @return array
     */
    public function getData()
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
