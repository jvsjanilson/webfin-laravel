<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class ContaPagarTest extends TestCase
{

    public function test_get_contapagars()
    {
        $response = $this->get('/api/contapagars');

        $response->assertOk();
    }

    public function test_post_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento'     => '2023-1000',
            'emissao'       => Carbon::now()->format('Y-m-d'),
            'vencimento'    => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'conta_id'      => 1,
            'fornecedor_id' => 1,
            'valor'         => 100.50,
            'user_id'       => 1
        ]);

        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => Carbon::now()->format('Y-m-d'),
            'vencimento' => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 150.50,
            'user_id' => 1
        ]);

        $response->assertCreated();
    }

    public function test_post_documento_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'emissao' => Carbon::now()->format('Y-m-d'),
            'vencimento' => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_emissao_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'vencimento' => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_vencimento_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => Carbon::now()->format('Y-m-d'),
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_conta_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => Carbon::now()->format('Y-m-d'),
            'vencimento' => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_fornecedor_required_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-2000',
            'emissao' => Carbon::now()->format('Y-m-d'),
            'vencimento' => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'conta_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertUnprocessable();
    }

    public function test_get_contapagar()
    {
        $response = $this->get('/api/contapagars/1');

        $response->assertOk();
    }

    public function test_put_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'valor'  => 12.25
        ]);

        $response->assertNoContent();
    }

    public function test_put_vencimento_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'vencimento'  => Carbon::now()->addMonth(1)->format('Y-m-d')
        ]);

        $response->assertNoContent();
    }

    public function test_put_desconto_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'desconto'  => 1.25
        ]);

        $response->assertNoContent();
    }

    public function test_put_juros_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'juros'  => 3.25
        ]);

        $response->assertNoContent();
    }

    public function test_put_multa_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'multa'  => 0.25
        ]);

        $response->assertNoContent();
    }

    public function test_put_datapagamento_contapagar()
    {
        $response = $this->put('/api/contapagars/1',[
            'data_pagamento'  => Carbon::now()->format('Y-m-d')
        ]);

        $response->assertNoContent();
    }

    public function test_post_unique_documento_contapagar()
    {
        $response = $this->post('/api/contapagars',[
            'documento' => '2023-1000',
            'emissao' => Carbon::now()->format('Y-m-d'),
            'vencimento' => Carbon::now()->addMonth(1)->format('Y-m-d'),
            'conta_id' => 1,
            'fornecedor_id' => 1,
            'valor' => 100.50,
            'user_id' => 1
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_unique_documento_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'documento' => '2023-1000',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_documento_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'documento' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_emissao_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'emissao' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_vencimento_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'vencimento' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_conta_id_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'conta_id' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_fornecedor_id_vazio_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'fornecedor_id' => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_conta_id_not_exist_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'conta_id' => 100,
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_fornecedor_id_not_exist_contapagar()
    {
        $response = $this->put('/api/contapagars/2',[
            'fornecedor_id' => 100,
        ]);

        $response->assertUnprocessable();
    }

    public function test_delete_contapagar()
    {
        $response = $this->delete('/api/contapagars/2');

        $response->assertNoContent();
    }

    public function test_baixar_contapagar()
    {
        $response = $this->put('/api/contapagars/baixar/1', [
            "data_pagamento" => Carbon::now()->format('Y-m-d')
        ]);
        $response->assertOk();
    }

    public function test_baixar_error_contapagar()
    {
        $response = $this->put('/api/contapagars/baixar/1', [
            "data_pagamento" => Carbon::now()->format('Y-m-d')
        ]);

        $response->assertStatus(400);

    }

    public function test_estornar_contapagar()
    {
        $response = $this->put('/api/contapagars/estornar/1');
        $response->assertOk();
    }

    public function test_estornar_error_contapagar()
    {
        $response = $this->put('/api/contapagars/estornar/1');
        $response->assertStatus(400);
    }
}
