<?php

namespace App\Repositories;

use App\Contracts\IEstado;
use App\Models\Estado;


class EstadoImpl extends AbstractRepos implements IEstado
{
    public $model;

    public function __construct(Estado $model)
    {
        $this->model = $model;
    }
}
