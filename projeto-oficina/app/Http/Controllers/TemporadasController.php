<?php

namespace App\Http\Controllers;

use App\Models\Serie;

class TemporadasController extends Controller
{
    public function listarTemporadas(int $serieId)
    {
        $serie = Serie::find($serieId);
        $temporadas = $serie->temporadas;
        return view('temporadas/listarTemporadas', compact('serie', 'temporadas'));
    }
}
