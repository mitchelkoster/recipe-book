<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Measurement;

class MeasurementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($system)
    {
        return Measurement::all('id', 'system', 'type')->where('system', '=', $system);
    }
}
