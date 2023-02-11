<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('estados')->insert(
            [
                 ['id'=>1,  'uf'=>'EX', 'nome'=> 'Exterior',                'ativo' => 1]
                ,['id'=>2,  'uf'=>'RO', 'nome'=> 'Rondônia',                'ativo' => 1]
                ,['id'=>3,  'uf'=>'AC', 'nome'=> 'Acre',                    'ativo' => 1]
                ,['id'=>4,  'uf'=>'AM', 'nome'=> 'Amazônia',                'ativo' => 1]
                ,['id'=>5,  'uf'=>'RR', 'nome'=> 'Raraima',                 'ativo' => 1]
                ,['id'=>6,  'uf'=>'PA', 'nome'=> 'Pará',                    'ativo' => 1]
                ,['id'=>7,  'uf'=>'AP', 'nome'=> 'Amapá',                   'ativo' => 1]
                ,['id'=>8,  'uf'=>'TO', 'nome'=> 'Tocantins',               'ativo' => 1]
                ,['id'=>9,  'uf'=>'MA', 'nome'=> 'Maranhão',                'ativo' => 1]
                ,['id'=>10, 'uf'=>'PI', 'nome'=> 'Piauí',                   'ativo' => 1]
                ,['id'=>11, 'uf'=>'CE', 'nome'=> 'Ceará',                   'ativo' => 1]
                ,['id'=>12, 'uf'=>'RN', 'nome'=> 'Rio Grande do Norte',     'ativo' => 1]
                ,['id'=>13, 'uf'=>'PB', 'nome'=> 'Paraíba',                 'ativo' => 1]
                ,['id'=>14, 'uf'=>'PE', 'nome'=> 'Pernambuco',              'ativo' => 1]
                ,['id'=>15, 'uf'=>'AL', 'nome'=> 'Alagoas',                 'ativo' => 1]
                ,['id'=>16, 'uf'=>'SE', 'nome'=> 'Sergipe',                 'ativo' => 1]
                ,['id'=>17, 'uf'=>'BA', 'nome'=> 'Bahia',                   'ativo' => 1]
                ,['id'=>18, 'uf'=>'MG', 'nome'=> 'Minas Gerais',            'ativo' => 1]
                ,['id'=>19, 'uf'=>'ES', 'nome'=> 'Espírito Santo',          'ativo' => 1]
                ,['id'=>20, 'uf'=>'RJ', 'nome'=> 'Rio de Janeiro',          'ativo' => 1]
                ,['id'=>21, 'uf'=>'SP', 'nome'=> 'São Paulo',               'ativo' => 1]
                ,['id'=>22, 'uf'=>'PR', 'nome'=> 'Paraná',                  'ativo' => 1]
                ,['id'=>23, 'uf'=>'SC', 'nome'=> 'Santa Catarina',          'ativo' => 1]
                ,['id'=>24, 'uf'=>'RS', 'nome'=> 'Rio Grande do Sul',       'ativo' => 1]
                ,['id'=>25, 'uf'=>'MS', 'nome'=> 'Mato Grosso do Sul',      'ativo' => 1]
                ,['id'=>26, 'uf'=>'MT', 'nome'=> 'Mato Grosso',             'ativo' => 1]
                ,['id'=>27, 'uf'=>'GO', 'nome'=> 'Goiás',                   'ativo' => 1]
                ,['id'=>28, 'uf'=>'DF', 'nome'=> 'Distrito Federal',        'ativo' => 1],

            ]
        );
    }
}
