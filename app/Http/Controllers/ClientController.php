<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    

    public function create()
    {
        return view('clients.create');
    }

    public function store(StoreClientRequest $request)
    {
        $client = new Client();
        $client->name = $request->name;
        $client->cpf = $request->cpf;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->date_of_birth = $request->date_of_birth;

        if ($request->hasFile('photo')) {
            $client->photo = $request->file('photo')->store('photos', 'public');
        }

        $client->save();

        return response()->json(['message' => 'Client created successfully'], 201);
    }
}
