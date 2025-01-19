<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Rental Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                <!-- Layout 1: History Rental -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">History Rental</h3>
                    <table class="table-auto w-full text-sm text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Mobil</th>
                                <th class="px-4 py-2">Tanggal Mulai</th>
                                <th class="px-4 py-2">Tanggal Selesai</th>
                                <th class="px-4 py-2">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($historyRentals as $rental)
                                <tr>
                                    <td class="px-4 py-2">{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                                    <td class="px-4 py-2">{{ $rental->start_date }}</td>
                                    <td class="px-4 py-2">{{ $rental->end_date }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-4 py-2 text-center text-gray-500">Belum ada history rental.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Layout 2: Rental Sedang Berjalan -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Rental Sedang Berjalan</h3>
                    <table class="table-auto w-full text-sm text-left">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">Mobil</th>
                                <th class="px-4 py-2">Tanggal Mulai</th>
                                <th class="px-4 py-2">Tanggal Selesai</th>
                                <th class="px-4 py-2">Total Biaya</th>
                                <th class="px-4 py-2">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ongoingRentals as $rental)
                                <tr>
                                    <td class="px-4 py-2">{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                                    <td class="px-4 py-2">{{ $rental->start_date }}</td>
                                    <td class="px-4 py-2">{{ $rental->end_date }}</td>
                                    <td class="px-4 py-2">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</td>
                                    <td class="px-4 py-2">{{ ucfirst($rental->status) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-2 text-center text-gray-500">Belum ada rental berjalan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
