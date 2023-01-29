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
}
