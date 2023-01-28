<?php

namespace App\Contracts;

interface IRepository
{
    public function findAll();

    public function findOne($id);

    public function store($data);

    public function update($data, $id);

    public function destroy($id);
}
