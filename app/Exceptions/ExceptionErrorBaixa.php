<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class ExceptionErrorBaixa extends Exception
{
    protected $message = 'Titulo já foi pago.';
    protected $code = Response::HTTP_BAD_REQUEST;

    public function render($request)
    {

        return response()->json([
            'error' =>  class_basename($this),
            'message' => $this->getMessage(),
        ], $this->code);
    }
}
