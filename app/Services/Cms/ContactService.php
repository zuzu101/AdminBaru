<?php

namespace App\Services\Cms;

use App\Helpers\ErrorHandling;
use App\Models\Cms\Contact;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ContactService
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required | email',
            'phone' => 'required',
            'message' => 'required',
        ]);

        try {
            Contact::create($validated);
        } catch (\Error $e) {
            ErrorHandling::environmentErrorHandling($e->getMessage());
        }
    }

    public function data(object $contact)
    {
        $array = $contact->get(['id', 'name', 'phone', 'email', 'message']);

        $data = [];
        $no = 0;

        foreach ($array as $item) {
            $no++;
            $nestedData['no'] = $no;
            $nestedData['name'] = $item->name;
            $nestedData['phone'] = $item->phone;
            $nestedData['email'] = $item->email;
            $nestedData['message'] = '
            <button class="btn btn-primary btnTriggerMessage" data-message=' .$item->message. '"">
                <i class="fa fa-info-circle"></i>
            </button>
            ';

            $data[] = $nestedData;
        }

        return DataTables::of($data)->rawColumns(["message"])->toJson();
    }
}
