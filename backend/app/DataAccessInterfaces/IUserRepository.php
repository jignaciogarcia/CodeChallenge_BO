<?php

namespace App\DataAccessInterfaces;

use App\Models\User;

interface IUserRepository 
{
    public function findByEmail($email) : User;
}