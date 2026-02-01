<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Novo Atendimento</h2>
    </x-slot>

    <div class="py-6 max-w-xl mx-auto">
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-200 text-red-800 rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('appointments.store') }}" class="bg-white p-6 rounded shadow space-y-4">
            @csrf

            <div>
                <label class="block">Clientes</label>
                <small>Verifca se o cliente ja foi atendido uma vez</small>
                <select id="client_id" name="client_id" class="w-full border rounded px-3 py-2">
                    <option value="">Selecione ou pesquise</option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id }}">
                            {{ $client->name }} — {{ $client->phone }}
                        </option>
                    @endforeach
                </select>
            </div>

            <hr>
            <!-- Se o cliente não estiver na lista  -->
            <div>
                <label class="block">Nome do Cliente (novo)</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block">Telefone</label>
                <input type="text" name="phone" class="w-full border rounded px-3 py-2">
            </div>

            <div>
                <label class="block">Serviço</label>
                <select name="service_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Selecione</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->id }}">
                            {{ $service->name }} - {{ number_format($service->price, 2, ',', '.') }} Kz
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block">Data</label>
                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full border rounded px-3 py-2"
                    required>
            </div>

            <button class="px-4 py-2 bg-green-600 text-white rounded">
                Registrar Atendimento
            </button>
        </form>
    </div>
</x-app-layout>
