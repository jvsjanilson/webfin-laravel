<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class EstadoTest extends TestCase
{

    public function test_get_estados()
    {
        Artisan::call('migrate:fresh');

        $response = $this->get('/api/estados');

        $response->assertStatus(200);
    }

    public function test_post_estado()
    {
        $response = $this->post('/api/estados',[
            'uf'    => 'RN',
            'nome'  => 'Rio Grande do N',
            'ativo' => true
        ]);

        $response->assertStatus(201);
    }

    public function test_get_estado()
    {
        $response = $this->get('/api/estados/1');

        $response->assertStatus(200);
    }

    public function test_put_estado()
    {
        $response = $this->put('/api/estados/1',[
            'nome'  => 'Rio Grande do Norte',
        ]);

        $response->assertStatus(204);
    }
}