<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Http\Request;

class EpisodiosController extends Controller
{
    public function listarEpisodios(Temporada $temporada, Request $request)
    {
        $serie = Serie::find($temporada->serie_id);
        $userId = $serie->user_id;
        $episodios = $temporada->episodios->sortBy('id');
        $mensagem = $request->session()->get('mensagem');
        return view('episodios/listarEpisodios', compact(  'userId', 'temporada','episodios', 'mensagem'));
    }

    public function assistidos(Temporada $temporada, Request $request)
    {
        $episodiosAssistidos = $request->episodios;
        $temporada->episodios->each(function (Episodio $episodio)
        use ($episodiosAssistidos)
        {
            $episodio->assistido = in_array(
                $episodio->id,
                $episodiosAssistidos
            );
        });

        $temporada->push();
        $request->session()->flash('mensagem', 'Episódios marcados com sucesso!');

        return redirect()->back();

    }
}
