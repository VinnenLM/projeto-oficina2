<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\Serie;
use App\Models\Temporada;
use App\Models\User;
use App\Services\CriadorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CriadorDeSerieTest extends TestCase
{

    use RefreshDatabase;

    public function testCriarSerie()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        $criadorDeSerie = new CriadorDeSerie();
        $this->assertInstanceOf(CriadorDeSerie::class, $criadorDeSerie);

        $serieNome = 'Uma Série Ae';
        $quantidadeTemporadas = 1;
        $quantidadeEpisodios = 1;

        $serieCriada = $criadorDeSerie->criarSerie($serieNome, $quantidadeTemporadas, $quantidadeEpisodios, $user->id);
        $this->assertInstanceOf(Serie::class, $serieCriada);

        $this->assertDatabaseHas('series', ['nome' => $serieNome, 'user_id' => $user->id]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id]);
        $this->assertDatabaseHas('episodios', ['nome' => 'Episódio 1']);
    }

    public function testoCriarSerieErro()
    {
        $user = User::factory()->create();
        $this->assertInstanceOf(User::class, $user);
        $criadorDeSerie = new CriadorDeSerie();
        $this->assertInstanceOf(CriadorDeSerie::class, $criadorDeSerie);

        $serieNome = '';
        $quantidadeTemporadas = 1;
        $quantidadeEpisodios = 1;

        $serieCriada = $criadorDeSerie->criarSerie($serieNome, $quantidadeTemporadas, $quantidadeEpisodios, $user->id);
        $this->assertFalse($serieCriada);
    }
}
