<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RotasTest extends TestCase
{

    use RefreshDatabase;

    public function testVerificarRotaRegistrarGet()
    {
        $response = $this->get('/registrar');

        $response->assertStatus(s);
    }

    public function testVerificarRotaErrada()
    {
        $response = $this->get('/teste');

        $response->assertStatus(404);
    }

    public function testVerificarRota()
    {
        $response = $this->get('/');

        if(\Illuminate\Support\Facades\Auth::check()){
            $response->assertRedirect('/series');
        }else{
            $response->assertRedirect('/entrar');
        }
    }

    public function testVerificarRotaSeries()
    {
        $response = $this->get('/series');

        if(\Illuminate\Support\Facades\Auth::check()){
            $response->assertRedirect('/series');
        }else{
            $response->assertRedirect('/entrar');
        }
    }

    public function testVerificarRotaEntrarGet()
    {
        $response = $this->get('/entrar');

        $response->assertStatus(200);
    }

    public function testVerificarRotaSair()
    {
        $response = $this->get('/sair');

        $response->assertRedirect('/entrar');

    }

}
