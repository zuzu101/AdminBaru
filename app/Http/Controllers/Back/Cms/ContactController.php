<?php

namespace App\Http\Controllers\Back\Cms;

use App\Http\Controllers\Controller;
use App\Models\Cms\Contact;
use App\Services\Cms\ContactService;

class ContactController extends Controller
{

    public function index()
    {
        return view('back.cms.contact.index');
    }

    public function data(ContactService $contactService, Contact $contact)
    {
        return $contactService->data($contact);
    }
}
