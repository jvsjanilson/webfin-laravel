<?php

namespace App\Repositories;

use App\Contracts\IFornecedor;
use App\Models\Fornecedor;

class FornecedorImpl extends AbstractRepos implements IFornecedor
{
    public $model;

    public function __construct(Fornecedor $model)
    {
        $this->model = $model;
    }
}
