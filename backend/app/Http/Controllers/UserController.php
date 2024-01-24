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
        $token = '';
        $code = 0;
        try
        {
            $email = $request->input('email');
            $password = $request->input('password');

            $user = $this->userService->verifyUser($email, $password);

            $token = $user->createToken('personalToken')->plainTextToken;
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

        return response()->json(['message' => $message, 'token' => $token], $code);
    }

    public function logout() 
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'Logout Successful'], 200);
    }

    public function getLoggedUserInfo()
    {
        $user = auth()->user();

        return response()->json(['user'=> $user], 200);
    }
}
