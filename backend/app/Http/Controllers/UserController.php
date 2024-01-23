<?php

namespace App\Http\Controllers;

use App\Exceptions\ArgumentException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BusinessLogicInterfaces\IUserService;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class UserController extends Controller
{
    private IUserService $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $message = '';
        $code = 0;
        try
        {
            $email = $request->input('email');
            $password = $request->input('password');

            $this->userService->verifyUser($email, $password);
            $message = 'Login Successful';
            $code = 200;
        }
        catch(ArgumentException $e)
        {
            $message = $e->getMessage();
            $code = 400;
        }
        catch(NotFoundResourceException $e)
        {
            $message = $e->getMessage();
            $code = 404;
        }

        return response()->json(['message' => $message], $code);
    }
}