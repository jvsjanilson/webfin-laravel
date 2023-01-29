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
}
