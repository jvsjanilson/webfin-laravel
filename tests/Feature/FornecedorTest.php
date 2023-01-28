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

        $response->assertOk();
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

        $response->assertCreated();
    }

    public function test_get_fornecedor()
    {
        $response = $this->get('/api/fornecedores/1');

        $response->assertOk();
    }

    public function test_put_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'nome'  => 'Fornecedor',
        ]);

        $response->assertNoContent();
    }

    public function test_put_cpfcnpj_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'cpfcnpj' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_nome_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'nome'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_estado_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'estado_id'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_cidade_vazio_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'cidade_id'  => '',
        ]);

        $response->assertUnprocessable();
    }


    public function test_put_cpfcnpj_invalido_fornecedor()
    {
        $response = $this->put('/api/fornecedores/1',[
            'cpfcnpj' => '29140433844',
        ]);

        $response->assertUnprocessable();
    }
}
