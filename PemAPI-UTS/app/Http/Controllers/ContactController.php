<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $data = $request->validated();
        $contact = new Contact($data);
        $contact->save();

        return (new ContactResource($contact))->response()->setStatusCode(201);
    }

    public function index()
    {
        $contacts = Contact::all();
        return ContactResource::collection($contacts);
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return new ContactResource($contact);
    }

    public function update(ContactRequest $request, $id)
    {
        $data = $request->validated();
        $contact = Contact::findOrFail($id);
        $contact->update($data);

        return new ContactResource($contact);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return response()->json([
            "data" => true
        ])->setStatusCode(200);
    }
}
