<?php

namespace App\DataAccess;

use App\Exceptions\ArgumentException;
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

    public function update(string $userId, Contact $newContact, string $id) : Contact 
    {
        $oldContact = Contact::where("id", $id)->where("user_id", $userId)->first();
        if($oldContact == null)
        {
            throw new ArgumentException("Given id does not correspond to a contact of the logged user.");
        }

        if($newContact->name != null) 
        {
            $oldContact->name = $newContact->name;
        }
        if($newContact->address != null)
        {
            $oldContact->address = $newContact->address;
        }
        if($newContact->email != null)
        {
            $oldContact->email = $newContact->email;
        }
        if($newContact->cellphoneNumber != null)
        {
            $oldContact->cellphoneNumber = $newContact->cellphoneNumber;
        }
        if($newContact->profilePictureUrl != null)
        {
            $oldContact->profilePictureUrl = $newContact->profilePictureUrl;
        }
        if($newContact->title != null) 
        {
            $oldContact->title = $newContact->title;
        }

        $oldContact->save();
        return $oldContact;
    }
}