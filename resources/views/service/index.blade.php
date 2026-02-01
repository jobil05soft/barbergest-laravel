<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Serviços</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-200 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-4">
                <a href="{{ route('service.create') }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Novo Serviço</a>
            </div>

            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nome</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Preço (kz)</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($services as $service)
                            <tr>
                                <td class="px-6 py-4">{{ $service->name }}</td>
                                <td class="px-6 py-4"><?= number_format($service->price, 0, ',', '.') ?></td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('service.edit', $service->id) }}"
                                        class="text-blue-600 hover:underline">Editar</a>
                                    <form action="{{ route('service.destroy', $service->id) }}" method="POST"
                                        class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline ml-2"
                                            onclick="return confirm('Tem certeza?')">Excluir</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <p class="text-cyan-900 font-bold text-end p-3 text-md">Total: {{count($services)}}</p>

        </div>
    </div>
</x-app-layout>
