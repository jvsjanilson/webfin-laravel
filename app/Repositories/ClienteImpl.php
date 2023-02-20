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
                    $query->orWhere('nome_fantasia', 'like', '%'. $search.'%');
                    $query->orWhere('cpfcnpj', 'like', '%'. $search.'%');
                    $query->orWhere('celular', 'like', '%'. $search.'%');
                });
            })
            ->orderBy('id', 'desc')->paginate(config('app.paginate'));
        return $regs;
    }

    public function findByCpfcnpj($cpfcnpj)
    {
        $id = request()->id;

        $reg = $this->model->select('cpfcnpj')
            ->when(isset($id), function($q) use ($id) {
                $q->where(function($query) use ($id) {
                    $query->where('id', '<>', $id);
                });
            })
            ->where('cpfcnpj', $cpfcnpj)
            ->first();
        return $reg;
    }

    public function all()
    {
        return $this->model->orderBy('nome')->get();
    }
}
