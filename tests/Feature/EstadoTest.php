<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EstadoTest extends TestCase
{

    public function test_get_estados()
    {
        Artisan::call('migrate:fresh', [
            '--seeder' => 'UserSeeder',
        ]);

        $response = $this->get('/api/estados');
        $response->assertOk();
    }

    public function test_post_estado()
    {
        $response = $this->post('/api/estados',[
            'uf'    => 'RN',
            'nome'  => 'Rio Grande do N',
            'ativo' => true
        ]);

        $response->assertCreated();

    }


    public function test_put_estado()
    {
        $response = $this->put('/api/estados/1',[
            'nome'  => 'Rio Grande do Norte',
        ]);

        $response->assertNoContent();
    }

    public function test_put_uf_vazia_estado()
    {
        $response = $this->put('/api/estados/1',[
            'uf' => '',
            'nome'  => 'teste',
        ]);

        $response->assertUnprocessable();
    }

    public function test_put_nome_vazio_estado()
    {
        $response = $this->put('/api/estados/1',[
            'uf' => 'RN',
            'nome'  => '',
        ]);

        $response->assertUnprocessable();
    }

    public function test_post_unique_uf_estado()
    {
        $response = $this->post('/api/estados',[
            'uf'    => 'RN',
            'nome'  => 'Rio Grande do Norte',
            'ativo' => true
        ]);

        $response->assertUnprocessable();
    }

    public function test_get_estado()
    {
        $response = $this->get('/api/estados/1');
        $response->assertOk();
        $response->assertJson([
            "id" => 1,
            "uf" => "RN",
            "nome" => "Rio Grande do Norte",
            "ativo" => 1
        ]);
    }
}
