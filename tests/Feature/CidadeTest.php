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

        $response->assertStatus(200);
    }

    public function test_post_cidade()
    {
        $response = $this->post('/api/cidades',[
            'nome'  => 'Nat',
            'estado_id' => 1,
            'ativo' => true
        ]);

        $response->assertStatus(201);
    }

    public function test_get_cidade()
    {
        $response = $this->get('/api/cidades/1');

        $response->assertStatus(200);
    }

    public function test_put_cidade()
    {
        $response = $this->put('/api/cidades/1',[
            'nome'  => 'Natal',
        ]);

        $response->assertStatus(204);
    }

    public function test_put_nome_vazio_cidade()
    {
        $response = $this->put('/api/cidades/1',[
            'nome'  => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_estado_vazio_cidade()
    {
        $response = $this->put('/api/cidades/1',[
            'estado_id'  => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_post_estado_required_cidade()
    {
        $response = $this->post('/api/cidades',[
            'nome'  => 'Nat',
            'ativo' => true
        ]);

        $response->assertStatus(422);
    }

    public function test_post_nome_required_cidade()
    {
        $response = $this->post('/api/cidades',[
            'estado_id' => 1,
            'ativo' => true
        ]);

        $response->assertStatus(422);
    }

}
