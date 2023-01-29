<?php

namespace App\Repositories;

use App\Contracts\IEstado;
use App\Models\Cidade;

class CidadeImpl extends AbstractRepos implements IEstado
{
    public $model;

    public function __construct(Cidade $model)
    {
        $this->model = $model;
    }
}
