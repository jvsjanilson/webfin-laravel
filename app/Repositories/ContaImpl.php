<?php

namespace App\Repositories;

use App\Contracts\IConta;
use App\Models\Conta;

class ContaImpl extends AbstractRepos implements IConta
{
    public $model;

    public function __construct(Conta $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        $search = request()->nome;

        $regs =  $this->model
            ->when($search != "", function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('descricao', 'like', '%'. $search.'%');
                    $query->orWhere('numero_banco', 'like', '%'. $search.'%');
                    $query->orWhere('numero_agencia', 'like', '%'. $search.'%');
                    $query->orWhere('numero_conta', 'like', '%'. $search.'%');
                });
            })
            ->orderBy('id', 'desc')->paginate(config('app.paginate'));
        return $regs;
    }

     public function all()
    {
        return $this->model
            ->orderBy('numero_banco')
            ->orderBy('numero_agencia')
            ->orderBy('numero_conta')->get();
    }
}
