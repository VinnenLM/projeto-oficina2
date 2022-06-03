<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesRequest;
use App\Models\Serie;
use App\Services\BuscadorDeSerie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeriesController extends Controller
{
    public function listarSeries(Request $request)
    {

        $series = Serie::all()->where('user_id', Auth::id())->sortDesc();
        $mensagem = $request->session()->get('mensagem');
        return view('series/listarSeries', compact('series', 'mensagem'));
    }

    public function criarSeries()
    {
        return view('series/criarSerie');
    }

    public function salvarSeries(SeriesRequest $request, CriadorDeSerie $criadorDeSerie)
    {
        $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->qtd_episodios, Auth::id());
        $request->session()->flash('mensagem', "Série {$serie->nome} criada com sucesso!");
        return redirect('/series');
    }

    public function excluirSeries(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $serieNome = $removedorDeSerie->removerSerie($request->id);
        $request->session()->flash('mensagem', "Série $serieNome removida com sucesso!");
        return redirect('/series');
    }

    public function buscarSeries(Request $request, BuscadorDeSerie $buscadorDeSerie)
    {
        $series = $buscadorDeSerie->buscarSerie($request, Auth::id());

        if ($series == false || count($series) == 0) {
            $request->session()->flash('mensagem', "Nenhuma série encontrada!");
            $mensagem = $request->session()->get('mensagem');
            return view ('series/buscarSeries', compact('mensagem'));
        } else {
            return view('series/buscarSeries', compact('series'));
        }
    }

    public function editarSerie($id, Request $request)
    {
        $novoNome = $request->nome;
        $serie = Serie::find($id);
        $serie->nome = $novoNome;
        $request->session()->flash('mensagem', "Série $novoNome modificada com sucesso!");
        $serie->save();
    }

}
