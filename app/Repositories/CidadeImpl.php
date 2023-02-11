<?php

namespace App\Repositories;

use App\Contracts\ICidade;
use App\Models\Cidade;

class CidadeImpl extends AbstractRepos implements ICidade
{
    public $model;

    public function __construct(Cidade $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        $search = request()->nome;

        $reg =  $this->model
            ->when($search != "", function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('nome', 'like', '%'. $search.'%');
                });
            })
            ->orderBy('id', 'desc')->paginate(config('app.paginate'));
        return $reg;
    }
}
