<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContaReceberTest extends TestCase
{
    public function test_get_contarecebers()
    {
        $response = $this->get('/api/contarecebers');

        $response->assertStatus(200);
    }

    public function test_post_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-1000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'cliente_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-2000',
            'emissao' => '2023-02-19',
            'vencimento' => '2023-03-19',
            'conta_id' => 1,
            'cliente_id' => 1,
            'valor' => 150.50,
            'user_id' => 1
        ]);

        $response->assertStatus(201);
    }

    public function test_post_documento_required_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'cliente_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_emissao_required_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-2000',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'cliente_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_vencimento_required_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-2000',
            'emissao' => '2023-01-19',
            'conta_id' => 1,
            'cliente_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_conta_required_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-2000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'cliente_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }

    public function test_post_cliente_required_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-2000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }


    public function test_get_contareceber()
    {
        $response = $this->get('/api/contarecebers/1');

        $response->assertStatus(200);
    }

    public function test_put_contareceber()
    {
        $response = $this->put('/api/contarecebers/1',[
            'valor'  => 12.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_vencimento_contareceber()
    {
        $response = $this->put('/api/contarecebers/1',[
            'vencimento'  => '2023-02-28'
        ]);

        $response->assertStatus(204);
    }

    public function test_put_desconto_contareceber()
    {
        $response = $this->put('/api/contarecebers/1',[
            'desconto'  => 1.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_juros_contareceber()
    {
        $response = $this->put('/api/contarecebers/1',[
            'juros'  => 3.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_multa_contareceber()
    {
        $response = $this->put('/api/contarecebers/1',[
            'multa'  => 0.25
        ]);

        $response->assertStatus(204);
    }

    public function test_put_datapagamento_contareceber()
    {
        $response = $this->put('/api/contarecebers/1',[
            'data_pagamento'  => '2023-01-01'
        ]);

        $response->assertStatus(204);
    }

    public function test_post_unique_documento_contareceber()
    {
        $response = $this->post('/api/contarecebers',[
            'documento' => '2023-1000',
            'emissao' => '2023-01-19',
            'vencimento' => '2023-02-19',
            'conta_id' => 1,
            'cliente_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertStatus(422);
    }


    public function test_put_unique_documento_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'documento' => '2023-1000',
        ]);

        $response->assertStatus(422);
    }


    public function test_put_documento_vazio_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'documento' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_emissao_vazio_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'emissao' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_vencimento_vazio_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'vencimento' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_conta_id_vazio_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'conta_id' => '',
        ]);

        $response->assertStatus(422);
    }

    public function test_put_cliente_id_vazio_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'cliente_id' => '',
        ]);

        $response->assertStatus(422);
    }


    public function test_put_conta_id_not_exist_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'conta_id' => 100,
        ]);

        $response->assertStatus(422);
    }

    public function test_put_cliente_id_not_exist_contareceber()
    {
        $response = $this->put('/api/contarecebers/2',[
            'cliente_id' => 100,
        ]);

        $response->assertStatus(422);
    }

    public function test_delete_contareceber()
    {
        $response = $this->delete('/api/contarecebers/2');

        $response->assertStatus(204);
    }


}
