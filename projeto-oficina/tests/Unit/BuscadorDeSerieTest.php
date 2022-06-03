<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Models\User;
use App\Services\BuscadorDeSerie;
use App\Services\CriadorDeSerie;
use http\Env\Request;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BuscadorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    public function testSerieNaoEncontrada()
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

        $serieBuscadaNome = 'Teste';

        $request = new \Illuminate\Http\Request();
        $request->merge(['buscar' => $serieBuscadaNome]);

        $buscarSerie = new BuscadorDeSerie();
        $this->assertInstanceOf(BuscadorDeSerie::class, $buscarSerie);

        $serieBuscada = $buscarSerie->buscarSerie($request, $user->id);
        $this->assertInstanceOf(Collection::class, $serieBuscada);

        $this->assertCount(0, $serieBuscada);
    }

    public function testBuscaInvalida()
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

        $serieBuscadaNome = '';

        $request = new \Illuminate\Http\Request();
        $request->merge(['buscar' => $serieBuscadaNome]);

        $buscarSerie = new BuscadorDeSerie();
        $this->assertInstanceOf(BuscadorDeSerie::class, $buscarSerie);

        $serieBuscada = $buscarSerie->buscarSerie($request, $user->id);

        $this->assertFalse($serieBuscada);
    }

    public function testSerieEncontrada()
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

        $serieBuscadaNome = 'Uma Série Ae';

        $request = new \Illuminate\Http\Request();
        $request->merge(['buscar' => $serieBuscadaNome]);

        $buscarSerie = new BuscadorDeSerie();
        $this->assertInstanceOf(BuscadorDeSerie::class, $buscarSerie);

        $serieBuscada = $buscarSerie->buscarSerie($request, $user->id);
        $this->assertInstanceOf(Collection::class, $serieBuscada);

        foreach ($serieBuscada as $serie){
            $this->assertEquals($serieNome, $serie->nome);
        }

    }
}
