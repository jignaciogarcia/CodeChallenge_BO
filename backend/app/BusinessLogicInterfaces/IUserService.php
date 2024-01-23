<?php

namespace App\BusinessLogicInterfaces;

interface IUserService
{
    public function verifyUser(string $email, string $password) : void;
}