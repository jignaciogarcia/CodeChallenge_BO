<?php

namespace App\BusinessLogicInterfaces;

use App\Models\Contact;
use App\Models\User;

interface IContactService 
{
    public function createContact(User $user, Contact $contact) : Contact;
}