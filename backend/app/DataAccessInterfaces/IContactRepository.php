<?php

namespace App\DataAccessInterfaces;

use App\Models\User;
use App\Models\Contact;

interface IContactRepository 
{
    public function create(User $user, Contact $contact) : Contact;
}