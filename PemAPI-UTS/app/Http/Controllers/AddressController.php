<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(AddressRequest $request, $idContact)
    {
        $data = $request->validated();
        $address = new Address($data);
        $address->contact_id = $idContact;
        $address->save();

        return (new AddressResource($address))->response()->setStatusCode(201);
    }

    public function index($idContact)
    {
        $addresses = Address::where('contact_id', $idContact)->get();
        return AddressResource::collection($addresses);
    }

    public function show($idContact, $idAddress)
    {
        $address = Address::where('contact_id', $idContact)->findOrFail($idAddress);
        return new AddressResource($address);
    }

    public function update(AddressRequest $request, $idContact, $idAddress)
    {
        $data = $request->validated();
        $address = Address::where('contact_id', $idContact)->findOrFail($idAddress);
        $address->update($data);

        return new AddressResource($address);
    }

    public function destroy($idContact, $idAddress)
    {
        $address = Address::where('contact_id', $idContact)->findOrFail($idAddress);
        $address->delete();

        return response()->json([
            "data" => true
        ])->setStatusCode(200);
    }
}
