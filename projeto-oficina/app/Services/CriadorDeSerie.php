<?php

namespace App\Services;

use App\Models\Serie;
use App\Models\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $qtdEpisodios, int $userId): Serie|bool
    {
        if($nomeSerie == null || $qtdTemporadas <= 0 || $qtdEpisodios <= 0 || $userId <= 0){
            return false;
        }
        DB::beginTransaction();
        $serie = Serie::create(['nome' => $nomeSerie, 'user_id' => $userId]);
        $this->criarTemporada($qtdTemporadas, $qtdEpisodios, $serie);
        DB::commit();

        return $serie;
    }

    public function criarTemporada(int $qtdTemporadas, int $qtdEpisodios, Serie $serie)
    {
        for($i=1;$i<=$qtdTemporadas;$i++){
            $temporada = $serie->temporadas()->create(['nome' => 'Temporada '.$i]);
            $this->criarEpisodio($qtdEpisodios, $temporada);
        }
    }

    public function criarEpisodio(int $qtdEpisodios, Temporada $temporada)
    {
        for($j=1;$j<=$qtdEpisodios;$j++){
            $temporada->episodios()->create(['nome' => 'Episódio '.$j]);
        }
    }
}
