<?php

namespace App\DataAccess;

use App\Models\User;
use App\Models\Contact;
use App\DataAccessInterfaces\IContactRepository;

class ContactRepository implements IContactRepository 
{
    public function create(User $user, Contact $contact) : Contact 
    {
        $user->contacts()->save($contact);
        return $contact;
    }
}