<?php

namespace Tests\Unit;

use App\Models\Serie;
use App\Models\User;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    public function testRemoverUmaSerie()
    {
        $user = User::factory()->create();
        $criadorDeSerie = new CriadorDeSerie();
        $serie = $criadorDeSerie->criarSerie('Uma Série Ae', 1, 1, $user->id);
        $this->assertInstanceOf(Serie::class, $serie);
        $this->assertDatabaseHas('series', ['id' => $serie->id]);
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeSerie = $removedorDeSerie->removerSerie($serie->id);
        $this->assertIsString($nomeSerie);
        $this->assertEquals('Uma Série Ae',  $serie->nome);
        $this->assertDatabaseMissing('series', ['id' => $serie->id]);
    }

    public function testRemoverUmaSerieErro()
    {
        $removedorDeSerie = new RemovedorDeSerie();
        $serie = $removedorDeSerie->removerSerie(0);
        $this->assertFalse($serie);
    }
}
