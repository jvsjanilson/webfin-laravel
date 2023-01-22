<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    public function test_get_fornecedores()
    {

        $response = $this->get('/api/fornecedores');

        $response->assertStatus(200);
    }

    public function test_post_fornecedor()
    {
        $response = $this->post('/api/fornecedores',[
            'nome' => 'Fornecedor Padrao',
            'cpfcnpj' => '29140433846',
            'estado_id' => 1,
            'cidade_id' => 1,
            'user_id' => 1
        ]);

        $response->assertStatus(201);
    }

    public function test_get_fornecedor()
    {
        $response = $this->get('/api/fornecedores/1');

        $response->assertStatus(200);
    }

    public function test_put_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'nome'  => 'Fornecedor',
        ]);

        $response->assertStatus(204);
    }

    public function test_put_cpfcnpj_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'cpfcnpj' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_nome_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'nome'  => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_estado_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'estado_id'  => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_cidade_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'cidade_id'  => '',
        ]);

        $response->assertStatus(422);
    }


    public function test_put_cpfcnpj_invalido_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'cpfcnpj' => '29140433844',
        ]);

        $response->assertStatus(422);
    }
}
