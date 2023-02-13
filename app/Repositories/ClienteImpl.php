<?php

namespace App\Repositories;

use App\Contracts\ICliente;
use App\Models\Cliente;

class ClienteImpl extends AbstractRepos implements ICliente
{
    public $model;

    public function __construct(Cliente $model)
    {
        $this->model = $model;
    }

    public function findAll()
    {
        $search = request()->nome;

        $regs =  $this->model
            ->when($search != "", function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('nome', 'like', '%'. $search.'%');
                    $query->orWhere('cpfcnpj', 'like', '%'. $search.'%');
                    $query->orWhere('celular', 'like', '%'. $search.'%');
                });
            })
            ->orderBy('id', 'desc')->paginate(config('app.paginate'));
        return $regs;
    }
}
