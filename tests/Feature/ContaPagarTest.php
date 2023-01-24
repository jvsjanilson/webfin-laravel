<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContaPagarTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_contapagars()
    {
        $response = $this->get('/api/contapagars');

        $response->assertStatus(200);
    }

    public function test_post_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-1000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => '2023-02-19',
            'vencimento' => '2023-03-19',
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 150.50,
            'user_id' => 1
        ]);

        $response->assertStatus(201);
    }

    public function test_post_documento_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_emissao_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_vencimento_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => '2023-01-19',
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_conta_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_fornecedor_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }


    public function test_get_contapagar()
    {
        $response = $this->get('/api/contapagars/1');

        $response->assertStatus(200);
    }

    public function test_put_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'valor'  => 12.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_vencimento_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'vencimento'  => '2023-02-28'
        ]);

        $response->assertStatus(204);
    }

    public function test_put_desconto_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'desconto'  => 1.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_juros_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'juros'  => 3.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_multa_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'multa'  => 0.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_datapagamento_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'data_pagamento'  => '2023-01-01'
        ]);

        $response->assertStatus(204);
    }

    public function test_post_unique_documento_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-1000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }


    public function test_put_unique_documento_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'documento' => '2023-1000',
        ]);

        $response->assertStatus(422);
    }


    public function test_put_documento_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'documento' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_emissao_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'emissao' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_vencimento_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'vencimento' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_conta_id_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'conta_id' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_fornecedor_id_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'fornecedor_id' => '',
        ]);

        $response->assertStatus(422);
    }


    public function test_put_conta_id_not_exist_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'conta_id' => 100,
        ]);

        $response->assertStatus(422);
    }

    public function test_put_fornecedor_id_not_exist_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'fornecedor_id' => 100,
        ]);

        $response->assertStatus(422);
    }

    public function test_delete_contapagar()
    {
        $response = $this->delete('/api/contapagars/2');

        $response->assertStatus(204);
    }
}