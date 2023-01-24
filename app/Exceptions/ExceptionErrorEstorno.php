<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ExceptionErrorEstorno extends Exception
{
    protected $message = 'Erro no estorno.';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render($request)
    {

        return response()->json([
            'error' =>  class_basename($this),
            'message' => $this->getMessage(),
        ], $this->code);
    }
}
