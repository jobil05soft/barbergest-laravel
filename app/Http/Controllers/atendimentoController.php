<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Client;
use App\Models\Service;
use Illuminate\Http\Request;

class atendimentoController extends Controller
{
    public function index(Request $request)
    {

        $query = Appointment::with(['client', 'service']);

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }

        $appointments = $query->orderBy('date', 'desc')->paginate(10);



        // $appointments = Appointment::with(['client', 'service'])
        //     ->orderBy('date', 'desc')
        //     ->get();
        return view('atendimento.index', compact('appointments'));
    }

    public function create()
    {

        $services = Service::all();
        $clients = Client::all();

        return view('atendimento.create', compact('services', 'clients'));
    }

    public function store(Request $request)
    {
        // Se não escolheu cliente, cria um novo
        if (!$request->client_id) {

            // criar o client no atendimento
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

            $client = Client::create([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        } else {
            // pega o id
            $client = Client::findOrFail($request->client_id);

            $request->validate([
                'client_id'  => 'required|exists:clients,id',
                'service_id' => 'required|exists:services,id',
                'date'       => 'required|date',
            ]);
        }

        $request->validate([
            'service_id' => 'required|exists:services,id',
            'date'       => 'required|date',
        ]);

        $service = Service::findOrFail($request->service_id);

        Appointment::create([
            'client_id'  => $client->id,
            'service_id' => $service->id,
            'date'       => $request->date,
            'price'      => $service->price,
        ]);

        return redirect()->route('atendimento.index')
            ->with('success', 'Atendimento registado com sucesso.');
    }

    public function destroy(int $id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('atendimento.index')
            ->with('success', 'Atendimento eliminado com sucesso.');
    }
}
