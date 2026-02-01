<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;

class clientController extends Controller
{
    public function index()
    {
        $clients = Client::where('deleted_at', null)->orderBy('created_at', 'desc')->get();
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {

        // validação
        $request->validate(

            // Rules
            [
                'name' =>  ['required', 'string', 'max:250'],
                'phone' =>  ['required', 'regex:/^9[1-9]\d{7}$/'],
            ],

            // messages
            [
                'name.required' => "Tem que estar preenchido",
                'name.string' => "Preenchimento Invalido",
                'name.max' => "No máximo 250 caracteres",

                'phone.required' => "Numero: Tem que estar preenchido",
                'phone.regex' => "Numero: Preenchimento Invalido",
            ]
        );


        $client = new Client();
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->save();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente Adicionado com sucesso.');
    }

    public function show(string $id) {}

    public function edit(int $id)
    {

        $client = Client::find($id);
        return view('clients.edit', ['client' => $client]);
    }

    public function update(Request $request)
    {
        // validação
        $request->validate(

            // Rules
            [
                'name' =>  ['required', 'string', 'max:250'],
                'phone' =>  ['required', 'regex:/^9[1-9]\d{7}$/'],
            ],

            // messages
            [
                'name.required' => "Tem que estar preenchido",
                'name.string' => "Preenchimento Invalido",
                'name.max' => "No máximo 250 caracteres",

                'phone.required' => "Numero: Tem que estar preenchido",
                'phone.regex' => "Numero: Preenchimento Invalido",
            ]
        );


        $client = Client::find($request->id);
        $client->name = $request->name;
        $client->phone = $request->phone;
        $client->save();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente atualizado com sucesso.');
    }

    public function destroy(int $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('clients.index')
            ->with('success', 'Cliente excluído com sucesso.');
    }
}
