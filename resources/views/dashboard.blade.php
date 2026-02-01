<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Caixa Diário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- botões para ir adicionar client -->
            <div class="mb-4">
                <a href="{{ route('clients.create') }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Adicionar Cliente</a>
                <a href="{{ route('service.create') }}"
                    class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Novo Serviço</a>
                <a href="{{ route('appointments.create') }}"
                    class="px-4 py-2 bg-purple-500 text-white rounded hover:bg-purple-600">Atender</a>
            </div>

            <div class="bg-gray-200 dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Total Hoje -->
                    <div class="bg-white p-6 rounded shadow">
                        <p class="text-gray-500">Total de Hoje</p>
                        <h2 class="text-3xl font-bold text-green-600">
                            {{ number_format($totalToday, 2, ',', '.') }} Kz
                        </h2>
                    </div>

                    <!-- Total do Mês -->
                    <div class="bg-white p-6 rounded shadow">
                        <p class="text-gray-500">Total do Mês</p>
                        <h2 class="text-3xl font-bold text-blue-600">
                            {{ number_format($totalMonth, 2, ',', '.') }} Kz
                        </h2>
                    </div>

                    <!-- Atendimentos -->
                    <div class="bg-white p-6 rounded shadow">
                        <p class="text-gray-500">Atendimentos Hoje</p>
                        <h2 class="text-3xl font-bold">
                            {{ $appointmentsToday }}
                        </h2>
                    </div>

                    <!-- Clientes Atendidos Hoje -->
                    <div class="bg-white p-6 rounded shadow">
                        <p class="text-gray-500">Clientes Atendidos Hoje</p>
                        <h2 class="text-3xl font-bold">
                            {{ $totalclientToday }}
                        </h2>
                    </div>

                    <!-- Clientes Atendidos -->
                    <div class="bg-white p-6 rounded shadow">
                        <p class="text-gray-500">Clientes Atendidos</p>
                        <h2 class="text-3xl font-bold">
                            {{ $totalclientsAppoint }}
                        </h2>
                    </div>

                    <!-- Total de Clientes -->
                    <div class="bg-white p-6 rounded shadow">
                        <p class="text-gray-500">Total de Clientes</p>
                        <h2 class="text-3xl font-bold">
                            {{ $totalclient }}
                        </h2>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded shadow mt-8">
                <h2 class="text-xl font-bold mb-4">Faturamento últimos 7 dias</h2>

                <canvas id="revenueChart"></canvas>
            </div>

        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('revenueChart');
            if (!ctx) return; // evita erro se não encontrar o canvas

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($days),
                    datasets: [{
                        label: 'Faturamento',
                        data: @json($totals),
                        borderWidth: 2,
                        tension: 0.3,
                        borderColor: '#4F46E5', // cor azul
                        backgroundColor: 'rgba(79,70,229,0.1)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    }
                }
            });
        });
    </script>

</x-app-layout>
