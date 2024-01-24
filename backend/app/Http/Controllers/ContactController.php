<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getUserContacts()
    {
        $userContacts = auth()->user()->contacts;
        return response()->json(['contacts' => $userContacts], 200);
    }
}
