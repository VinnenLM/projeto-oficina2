<?php

namespace App\Services;

use App\Models\Episodio;
use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId): string|bool
    {
        if($serieId <= 0){
            return false;
        }

        DB::transaction(function () use ($serieId, &$serieNome){
            $serie = Serie::find($serieId);
            $serieNome = $serie->nome;
            $this->removerTemporadas($serie);
            $serie->delete();
        });

        return $serieNome;
    }

    private function removerTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function (Temporada $temporada){
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });

    }

    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios->each(function (Episodio $episodio){
            $episodio->delete();
        });
    }
}
