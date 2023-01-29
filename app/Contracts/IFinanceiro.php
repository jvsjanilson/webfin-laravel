<?php

namespace App\Contracts;

interface IFinanceiro extends IRepository
{
    public function baixar($data, $id);
    public function estornar($id);
}
