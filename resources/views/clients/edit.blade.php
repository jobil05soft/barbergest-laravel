<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar Cliente</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-200 text-red-800 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('clients.update') }}" method="POST"
                class="space-y-4 bg-white p-6 rounded shadow">
                @csrf
                @method('PUT')
                <div>
                <input type="hidden" name="id" value="{{ $client->id }}">
                    <label class="block text-gray-700">Nome</label>
                    <input type="text" name="name" value="{{ $client->name }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <label class="block text-gray-700">Telefone</label>
                    <input type="text" name="phone" value="{{ $client->phone }}"
                        class="w-full border rounded px-3 py-2" required>
                </div>
                <div>
                    <button type="submit"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Atualizar</button>
                    <a href="{{ route('clients.index') }}"
                        class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
