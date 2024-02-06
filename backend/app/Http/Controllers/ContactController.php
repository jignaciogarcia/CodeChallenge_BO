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
        $this->validateCreateUpdateRequest($request);
        $contact = $this->parseRequestToContact($request);

        $user = auth()->user();
        $savedContact = $this->contactService->createContact($user, $contact);

        return response()->json(['contact'=> $savedContact], 201);
    }

    public function update(Request $request, $id) 
    {
        $this->validateCreateUpdateRequest($request);
        $newContact = $this->parseRequestToContact($request);

        $user = auth()->user();
        $updatedContact = $this->contactService->updateContact($user->id, $newContact, $id);

        return response()->json(['contact'=> $updatedContact], 200);
    }

    private function validateCreateUpdateRequest(Request $request) 
    {
        $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'email' => 'nullable|string|email',
            'cellphoneNumber' => 'nullable|string',
            'profilePictureUrl' => 'nullable|string'
        ]);
    }

    private function parseRequestToContact(Request $request) : Contact
    {
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->address = $request->address;
        $contact->email = $request->email;
        $contact->cellphoneNumber = $request->cellphoneNumber;
        $contact->profilePictureUrl = $request->profilePictureUrl;

        return $contact;
    }
}
