<?php

namespace Tests\Unit;

use App\Models\Episodio;
use App\Models\Temporada;
use Tests\TestCase;

class SeriesTest extends TestCase
{

    public function testVerificarTodosEpisodiosAssistidosTrue()
    {
        //instanciação das classes a serem utilizadas
        $temporada = new Temporada();
        $this->assertInstanceOf(Temporada::class, $temporada);
        $episodio1 = new Episodio();
        $episodio2 = new Episodio();
        $episodio3 = new Episodio();

        //Adicionados valores para as variaveis
        $episodio1->assistido = true;
        $this->assertTrue($episodio1->assistido);
        $episodio2->assistido = true;
        $this->assertTrue($episodio2->assistido);
        $episodio3->assistido = true;
        $this->assertTrue($episodio3->assistido);

        //Adicionados os episodios dentro da temporada
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        //Verificando os asserções
        $episodiosAssistidos = $temporada->episodiosAssistidos();
        $this->assertCount(3, $episodiosAssistidos);
        foreach ($episodiosAssistidos as $episodio) {
            $this->assertTrue($episodio->assistido);
        }
    }

    public function testVerificarTodosEpisodiosAssistidosFalse()
    {
        //instanciação das classes a serem utilizadas
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio2 = new Episodio();
        $episodio3 = new Episodio();

        //Adicionados valores para as variaveis
        $episodio1->assistido = false;
        $this->assertFalse($episodio1->assistido);
        $episodio2->assistido = false;
        $this->assertFalse($episodio2->assistido);
        $episodio3->assistido = false;
        $this->assertFalse($episodio3->assistido);

        //Adicionados os episodios dentro da temporada
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        //Verificando os asserções
        $episodiosAssistidos = $temporada->episodiosAssistidos();
        $this->assertCount(0, $episodiosAssistidos);
        foreach ($episodiosAssistidos as $episodio) {
            $this->assertFalse($episodio->assistido);
        }
    }

    public function testeVerificarEpisodiosAssistidosTrueFalse()
    {
        //instanciação das classes a serem utilizadas
        $temporada = new Temporada();
        $episodio1 = new Episodio();
        $episodio2 = new Episodio();
        $episodio3 = new Episodio();

        //Adicionados valores para as variaveis
        $episodio1->assistido = false;
        $this->assertFalse($episodio1->assistido);
        $episodio2->assistido = true;
        $this->assertTrue($episodio2->assistido);
        $episodio3->assistido = false;
        $this->assertFalse($episodio3->assistido);

        //Adicionados os episodios dentro da temporada
        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        //Verificando os asserções
        $episodiosAssistidos = $temporada->episodiosAssistidos();
        $this->assertCount(1, $episodiosAssistidos);
        foreach ($episodiosAssistidos as $episodio) {
            if($episodio->assistido === true){
                $this->assertTrue($episodio->assistido);
            }else{
                $this->assertFalse($episodio->assistido);
            }
        }
    }

}
