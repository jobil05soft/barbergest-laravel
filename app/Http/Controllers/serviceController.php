<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::where('deleted_at', null)->orderBy('created_at', 'desc')->get();
        return view('service.index', compact('services'));
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {

        $request->validate(
            // rules
            [
                'name' => 'required|string|max:250',
                'price' => 'required|decimal:0,2|min:0|max:999999.99'
            ],

            // messages
            [
                'name.required' => "Preenchimento Obrigatorio!",
                'name.string' => "Preenchimento Incorreto!",
                'name.max' => "No máximo 250 caracteres!",

                'price.requered' => "Preenchimento Obrigatorio!",
                'price.decimal' => "No máximo duas casas decimais!",
                'price.max' => "No máximo 999999.99",
                'price.min' => "Preenchimento Incorreto!",
            ]
        );

        $service = new Service();
        $service->name = $request->name;
        $service->price = $request->price;
        $service->save();

        return redirect()->route('service.index')
            ->with('success', 'Serviço Adicionado com sucesso.');
    }

    public function show(string $id) {}

    public function edit(int $id)
    {
        $service = Service::find($id);
        return view('service.edit', ['service' => $service]);
    }

    public function update(Request $request)
    {
        $request->validate(
            // rules
            [
                'name' => 'required|string|max:250',
                'price' => 'required|decimal:0,2|min:0|max:999999.99'
            ],

            // messages
            [
                'name.required' => "Preenchimento Obrigatorio!",
                'name.string' => "Preenchimento Incorreto!",
                'name.max' => "No máximo 250 caracteres!",

                'price.requered' => "Preenchimento Obrigatorio!",
                'price.decimal' => "No máximo duas casas decimais!",
                'price.max' => "No máximo 999999.99",
                'price.min' => "Preenchimento Incorreto!",
            ]
        );

        $service = Service::find($request->id);
        $service->name = $request->name;
        $service->price = $request->price;
        $service->save();

        return redirect()->route('service.index')
            ->with('success', 'Serviço Actualizado com sucesso.');
    }

    public function destroy(int $id) {

        $service = Service::find($id);
        $service->delete();
        return redirect()->route('service.index')
            ->with('success', 'Serviço excluído com sucesso.');
    }
}
