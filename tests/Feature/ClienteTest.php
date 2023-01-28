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

        $response->assertOk();
    }

    public function test_post_cliente()
    {
        $response = $this->post('/api/clientes',[
            'nome' => 'Janilson',
            'cpfcnpj' => '29140433846',
            'estado_id' => 1,
            'cidade_id' => 1,
            'user_id' => 1
        ]);

        $response->assertCreated();
    }

    public function test_get_cliente()
    {
        $response = $this->get('/api/clientes/1');

        $response->assertOk();
    }

    public function test_put_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'nome'  => 'Janilson Varela de Souza',
        ]);

        $response->assertNoContent();
    }

    public function test_put_cpfcnpj_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'cpfcnpj' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_nome_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'nome'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_estado_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'estado_id'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_cidade_vazio_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'cidade_id'  => '',
        ]);

        $response->assertUnprocessable();
    }


    public function test_put_cpfcnpj_invalido_cliente()
    {
        $response = $this->put('/api/clientes/1',[
            'cpfcnpj' => '29140433844',
        ]);

        $response->assertUnprocessable();
    }
}
