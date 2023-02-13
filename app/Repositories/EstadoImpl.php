<?php

namespace App\Repositories;

use App\Contracts\IEstado;
use App\Models\Estado;
use App\Exceptions\ExceptionNotFound;

class EstadoImpl extends AbstractRepos implements IEstado
{
    public $model;

    public function __construct(Estado $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->orderBy('uf')->get();
    }

    public function findAll()
    {
        $search = request()->nome;

        $regs =  $this->model
            ->when($search != "", function($q) use ($search) {
                $q->where(function($query) use ($search) {
                    $query->where('nome', 'like', '%'. $search.'%');
                    $query->orWhere('uf', 'like', '%'. $search.'%');
                });
            })
            ->orderBy('id', 'desc')->paginate(config('app.paginate'));
        return $regs;
    }

    public function findByUF($uf)
    {
        $id = request()->id;

        $reg = $this->model->where('uf', $uf)
            ->when(isset($id), function($q) use ($id) {
                $q->where(function($query) use ($id) {
                    $query->where('id', '<>', $id);
                });
            })
            ->first();
         if (!isset($reg))
             throw new ExceptionNotFound();
        return $reg;
    }
}
