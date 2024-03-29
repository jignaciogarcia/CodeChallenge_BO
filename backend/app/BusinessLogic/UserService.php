<?php

namespace App\BusinessLogic;

use App\BusinessLogicInterfaces\IUserService;
use App\DataAccessInterfaces\IUserRepository;
use App\Exceptions\ArgumentException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService 
{
    private IUserRepository $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function verifyUser(string $email, string $password) : User
    {
        $user = $this->userRepository->findByEmail($email);
        if(!Hash::check($password, $user->password))
        {
            throw new ArgumentException("Incorrect password");
        }
        
        return $user;
    }
}