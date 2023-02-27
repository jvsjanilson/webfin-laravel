<?php

namespace App\Http\Controllers\Auth;

use App\Exceptions\ExceptionErrorCreate;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class RegisterController extends Controller
{

    public function register(UserFormRequest $request)
    {
        $data = $request->only('name','email', 'password');
        $data['password'] = Hash::make($data['password']);
        try {
            User::create($data);
        } catch (\Throwable $th) {
            throw new ExceptionErrorCreate();
        }
        return response('', Response::HTTP_CREATED);
    }

}
