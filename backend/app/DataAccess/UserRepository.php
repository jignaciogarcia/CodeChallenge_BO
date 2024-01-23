<?php

namespace App\DataAccess;

use Symfony\Component\Translation\Exception\NotFoundResourceException;
use App\DataAccessInterfaces\IUserRepository;
use App\Models\User;

class UserRepository implements IUserRepository
{
    public function findByEmail($email) : User 
    {
        $user = User::where("email", $email)->first();
        if($user == null) 
        {
            throw new NotFoundResourceException("User not found");
        }

        return $user;
    }
}