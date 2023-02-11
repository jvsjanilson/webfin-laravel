<?php

namespace App\Repositories;

use App\Exceptions\ExceptionErrorCreate;
use App\Exceptions\ExceptionErrorDestroy;
use App\Exceptions\ExceptionErrorUpdate;
use App\Exceptions\ExceptionNotFound;


abstract class AbstractRepos
{
    public function findAll()
    {
        return $this->model->orderBy('id', 'desc')
            ->paginate(config('app.paginate'));
    }

    public function findOne($id)
    {
        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();

        return $reg;

    }

    public function store($data)
    {
        try {
            $this->model->create($data);
        } catch (\Throwable $th) {
            throw new ExceptionErrorCreate();
        }
    }

    public function update($data, $id)
    {
        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();

        if (count($data) == 0)
            throw new ExceptionErrorUpdate("Formado de dados passado invalido(s).");

        try {
            return $reg->update($data);
        } catch (\Throwable $th) {
            throw new ExceptionErrorUpdate();
        }

    }

    public function destroy($id)
    {
        $reg = $this->model->find($id);

        if (!isset($reg))
            throw new ExceptionNotFound();

        try {
            return $reg->destroy($id);

        } catch (\Throwable $th) {
            throw new ExceptionErrorDestroy();
        }
    }
}
