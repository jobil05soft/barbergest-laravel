<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Novo Serviço</h2>
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

            <form action="{{ route('service.store') }}" method="POST" class="space-y-4 bg-white p-6 rounded shadow">
                @csrf
                <div>
                    <label class="block text-gray-700">Nome</label>
                    <input type="text" name="name" class="w-full border px-3 py-2" >
                </div>
                <div>
                    <label class="block text-gray-700">Preço</label>
                    <input type="text" inputmode="decimal" placeholder="Ex: 1000.00 ou 1000" name="price" class="w-full border px-3 py-2" >
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-red-900 rounded hover:bg-green-600">Salvar</button>
                    <a href="{{ route('service.index') }}" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Cancelar</a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
