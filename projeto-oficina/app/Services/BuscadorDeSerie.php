<?php

namespace App\Services;

use App\Models\Serie;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BuscadorDeSerie
{

    /*public function buscarSerie(Request $request, int $userId): Serie
    {
        $series = Serie::where(DB::raw('lower(nome)'),'LIKE','%'.$request->buscar.'%')->where('user_id', $userId)->get();
        if(count($series) > 0){
            return view('series/buscarSeries', compact('series'));
        } else {
            $request->session()->flash('mensagem', "Nenhuma série encontrada!");
            $mensagem = $request->session()->get('mensagem');
            return view ('series/buscarSeries', compact('mensagem'));
        }
    }*/

    public function buscarSerie(Request $request, int $userId): Collection|bool
    {
        if($request->buscar == '' || is_null($userId)){
            return false;
        }
        $series = Serie::where(DB::raw('lower(nome)'),'LIKE','%'.$request->buscar.'%')->where('user_id', $userId)->get();
        return $series;
    }
}
