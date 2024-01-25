<?php

namespace App\BusinessLogic;

use App\Exceptions\ArgumentException;
use App\Models\User;
use App\Models\Contact;
use App\BusinessLogicInterfaces\IContactService;
use App\DataAccessInterfaces\IContactRepository;

class ContactService implements IContactService 
{
    private IContactRepository $contactRepository;

    public function __construct(IContactRepository $contactRepository) 
    {
        $this->contactRepository = $contactRepository;
    }

    public function createContact(User $user, Contact $contact) : Contact 
    {
        return $this->contactRepository->create($user, $contact);
    }
}