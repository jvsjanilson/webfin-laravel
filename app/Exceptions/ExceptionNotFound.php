<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ExceptionNotFound extends Exception
{
    protected $message = 'Registro não encontrado.';
    protected $code = Response::HTTP_NOT_FOUND;

    public function render($request)
    {

        return response()->json([
            'error' =>  class_basename($this),
            'message' => $this->getMessage(),
        ], $this->code);
    }
}

