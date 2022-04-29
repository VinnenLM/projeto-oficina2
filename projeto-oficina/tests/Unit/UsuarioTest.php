<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsuarioTest extends TestCase
{

    use RefreshDatabase;

    public function testVerificarRegistroUsuario()
    {
        $response = $this->post('/registrar', [
            'name' => 'Usuario Teste',
            'email' => 'teste@teste.com',
            'password' => '123',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/registrar');
    }
}
