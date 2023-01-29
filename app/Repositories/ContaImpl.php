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
}
