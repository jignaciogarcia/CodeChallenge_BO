<?php

namespace App\Http\Controllers;

use App\BusinessLogicInterfaces\IContactService;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    private IContactService $contactService;

    public function __construct(IContactService $contactService) 
    {
        $this->contactService = $contactService;
    }

    public function getUserContacts()
    {
        $userContacts = auth()->user()->contacts;
        return response()->json(['contacts' => $userContacts], 200);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'string',
            'email' => 'string|email',
            'cellphoneNumber' => 'string',
            'profilePictureUrl' => 'string'
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->cellphoneNumber = $request->cellphoneNumber;
        $contact->profilePictureUrl = $request->profilePictureUrl;

        $user = auth()->user();
        $savedContact = $this->contactService->createContact($user, $contact);

        return response()->json(['contact'=> $savedContact], 201);
    }
}
