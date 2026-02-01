<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Atendimentos</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-200 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('appointments.create') }}" class="mb-4 inline-block px-4 py-2 bg-blue-600 text-white rounded">
            Novo Atendimento
        </a>

        <form method="GET" class="bg-white p-4 rounded shadow mb-4 flex flex-wrap gap-4">

            <div>
                <label class="block text-sm">Data inicial</label>
                <input type="date" name="start_date" value="{{ request('start_date') }}"
                    class="border rounded px-3 py-2">
            </div>

            <div>
                <label class="block text-sm">Data final</label>
                <input type="date" name="end_date" value="{{ request('end_date') }}"
                    class="border rounded px-3 py-2">
            </div>

            <div class="flex items-end gap-2">
                <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                    Filtrar
                </button>

                <a href="{{ route('atendimento.index') }}" class="bg-gray-300 px-4 py-2 rounded">
                    Limpar
                </a>
            </div>

        </form>

        <button onclick="window.print()" class="bg-green-600 text-white px-4 py-2 rounded mb-4">
            Imprimir
        </button>

        <?php $total = 0; ?>
        <div class="bg-white shadow rounded print-area">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Data</th>
                        <th class="p-3 text-left">Cliente</th>
                        <th class="p-3 text-left">Serviço</th>
                        <th class="p-3 text-left">Valor</th>
                        <th class="p-3 text-left">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr class="border-t">
                            <td class="p-3">{{ $appointment->date }}</td>
                            <td class="p-3">{{ $appointment->client->name }}</td>
                            <td class="p-3">{{ $appointment->service->name }}</td>
                            <td class="p-3">
                                {{ number_format($appointment->price, 2, ',', '.') }} Kz
                            </td>
                            <td class="p-3 acao">
                                <form method="POST" action="{{ route('appointments.destroy', $appointment->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600" onclick="return confirm('Excluir atendimento?')">
                                        Excluir
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <?php $total += $appointment->price; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <p class="text-cyan-900 font-bold text-end p-3 text-md">Total: {{  number_format($total, 2, ',', '.') }}</p>

    </div>


    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .print-area,
            .print-area * {
                visibility: visible;
            }

            .print-area,
            .acao * {
                visibility: hidden;
            }

            .print-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
        }
    </style>



</x-app-layout>
