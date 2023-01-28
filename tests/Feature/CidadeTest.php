<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CidadeTest extends TestCase
{

    public function test_get_cidades()
    {
        $response = $this->get('/api/cidades');
        $response->assertOk();
    }

    public function test_post_cidade()
    {
        $response = $this->post('/api/cidades',[
            'nome'  => 'Nat',
            'estado_id' => 1,
            'ativo' => true
        ]);

        $response->assertCreated();
    }

    public function test_get_cidade()
    {
        $response = $this->get('/api/cidades/1');
        $response->assertOk();
    }

    public function test_put_cidade()
    {
        $response = $this->put('/api/cidades/1',[
            'nome'  => 'Natal',
        ]);

        $response->assertNoContent();
    }

    public function test_put_nome_vazio_cidade()
    {
        $response = $this->put('/api/cidades/1',[
            'nome'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_estado_vazio_cidade()
    {
        $response = $this->put('/api/cidades/1',[
            'estado_id'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_estado_required_cidade()
    {
        $response = $this->post('/api/cidades',[
            'nome'  => 'Nat',
            'ativo' => true
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_nome_required_cidade()
    {
        $response = $this->post('/api/cidades',[
            'estado_id' => 1,
            'ativo' => true
        ]);

        $response->assertUnprocessable();
    }

}
