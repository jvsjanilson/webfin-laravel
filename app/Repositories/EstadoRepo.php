<?php

namespace App\Repositories;

use App\Contracts\EstadoInterface;
use App\Models\Estado;


class EstadoRepo extends AbstractRepos implements EstadoInterface
{
    public $model;

    public function __construct(Estado $model)
    {
        $this->model = $model;
    }
}
