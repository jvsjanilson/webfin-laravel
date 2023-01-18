<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    public function test_get_clientes()
    {

        $response = $this->get('/api/clientes');

        $response->assertStatus(200);
    }

    public function test_post_cliente()
    {
        $response = $this->post('/api/clientes',[
            'nome' => 'Janilson',
            'cpfcnpj' => '29140433846',
            'estado_id' => 1,
            'cidade_id' => 1
        ]);

        $response->assertStatus(201);
    }

    public function test_get_cliente()
    {
        $response = $this->get('/api/clientes/1');

        $response->assertStatus(200);
    }

    public function test_put_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'nome'  => 'Janilson Varela de Souza',
        ]);

        $response->assertStatus(204);
    }

    public function test_put_cpfcnpj_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'cpfcnpj' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_nome_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'nome'  => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_estado_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'estado_id'  => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_cidade_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'cidade_id'  => '',
        ]);

        $response->assertStatus(422);
    }


    public function test_put_cpfcnpj_invalido_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'cpfcnpj' => '29140433844',
        ]);

        $response->assertStatus(422);
    }
}
