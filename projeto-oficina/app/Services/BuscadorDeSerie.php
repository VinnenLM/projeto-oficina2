<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuscadorDeSerie
{

    public function buscarSerie(Request $request)
    {
        $buscar = strtolower($request->buscar);
        $series = Serie::where(DB::raw('lower(nome)'),'LIKE','%'.$buscar.'%')->where('user_id', Auth::id())->get();
        if(count($series) > 0){
            return view('series/buscarSeries', compact('series'));
        } else {
            $request->session()->flash('mensagem', "Nenhuma série encontrada!");
            $mensagem = $request->session()->get('mensagem');
            return view ('series/buscarSeries', compact('mensagem'));
        }
    }
}
