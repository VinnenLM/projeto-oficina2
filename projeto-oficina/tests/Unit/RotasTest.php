<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RotasTest extends TestCase
{
    public function testVerificarRotaRegistrarGet()
    {
        $response = $this->get('/registrar');

        $response->assertStatus(200);
    }

    public function testVerificarRotaErrada()
    {
        $response = $this->get('/teste');

        $response->assertStatus(404);
    }
}
