<?php

namespace App\Http\Controllers;

class SeriesController extends Controller
{
    public function listarSeries()
    {
        return view('series/listarSeries');
    }
}
