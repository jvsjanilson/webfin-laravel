<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class ContaTest extends TestCase
{
    public function test_get_contas()
    {
        $response = $this->get('/api/contas');
        $response->assertOk();
    }

    public function test_post_conta()
    {
        $response = $this->post('/api/contas',[
            'numero_banco' => '001',
            'numero_agencia' => '1406',
            'numero_conta' => '32565-1',
            'descricao' => 'BB Cidade Alta',
            'tipo_conta' => 1,
            'data_abertura' => Carbon::now()->format('Y-m-d'),
            'saldo' => 100,
            'user_id' => 1
        ]);

        $response->assertCreated();
    }

    public function test_get_conta()
    {
        $response = $this->get('/api/contas/1');
        $response->assertOk();
    }

    public function test_put_conta()
    {
        $response = $this->put('/api/contas/1',[
            'descricao' => 'BB 2 Cidade Alta',
        ]);

        $response->assertNoContent();
    }

    public function test_put_numero_banco_vazio_conta()
    {
        $response = $this->put('/api/contas/1',[
            'numero_banco' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_numero_agencia_vazio_conta()
    {
        $response = $this->put('/api/contas/1',[
            'numero_agencia' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_numero_conta_vazio_conta()
    {
        $response = $this->put('/api/contas/1',[
            'numero_conta' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_descricao_vazio_conta()
    {
        $response = $this->put('/api/contas/1',[
            'descricao' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_tipo_conta_vazio_conta()
    {
        $response = $this->put('/api/contas/1',[
            'tipo_conta' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_data_abertura_vazio_conta()
    {
        $response = $this->put('/api/contas/1',[
            'data_abertura' => '',
        ]);

        $response->assertUnprocessable();
    }
}
