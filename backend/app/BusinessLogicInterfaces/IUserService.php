<?php

namespace App\BusinessLogicInterfaces;

use App\Models\User;

interface IUserService
{
    public function verifyUser(string $email, string $password) : User;
}