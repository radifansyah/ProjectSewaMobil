<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Rental Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Layout 1: History Rental -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">History Rental</h3>
                        {{-- <a href="{{ route('admin.rentals.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Pesan Mobil Baru
                        </a> --}}
                    </div>
                    <table class="w-full border-collapse text-sm text-left">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-4 py-2 text-gray-700">Mobil</th>
                                <th class="px-4 py-2 text-gray-700">Tanggal Mulai</th>
                                <th class="px-4 py-2 text-gray-700">Tanggal Selesai</th>
                                <th class="px-4 py-2 text-gray-700">Total Biaya</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($historyRentals as $rental)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 text-gray-600">{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $rental->start_date }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $rental->end_date }}</td>
                                    <td class="px-4 py-2 text-gray-600">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</td>
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
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-800 border-b pb-2">Rental Sedang Berjalan</h3>
                        <a href="{{ route('admin.rentals.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Pesan Mobil Baru
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse table-fixed text-sm text-left">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="px-4 py-2 text-gray-700">User</th>
                                    <th class="px-4 py-2 text-gray-700">Mobil</th>
                                    <th class="px-4 py-2 text-gray-700">Model</th>
                                    <th class="px-4 py-2 text-gray-700">Nomor Plat</th>
                                    <th class="px-4 py-2 text-gray-700">Tanggal Mulai</th>
                                    <th class="px-4 py-2 text-gray-700">Tanggal Selesai</th>
                                    <th class="px-4 py-2 text-gray-700">Total Biaya</th>
                                    <th class="px-4 py-2 text-gray-700">Status</th>
                                    {{-- <th class="px-4 py-2 text-gray-700">Aksi</th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($ongoingRentals as $rental)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 text-gray-600">{{ $rental->user->name }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ $rental->car->brand }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ $rental->car->model }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ $rental->car->license_plate }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ $rental->start_date }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ $rental->end_date }}</td>
                                        <td class="px-4 py-2 text-gray-600">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</td>
                                        <td class="px-4 py-2 text-gray-600">{{ ucfirst($rental->status) }}</td>
                                        {{-- <td class="px-4 py-2 text-center">
                                            @if($rental->status === 'ongoing')
                                                <button
                                                    onclick="openModal({{ $rental->car_id }})"
                                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">
                                                    Kembalikan
                                                </button>
                                            @else
                                                <span class="text-gray-500">Sudah Dikembalikan</span>
                                            @endif
                                        </td> --}}
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-4 py-2 text-center text-gray-500">Belum ada rental berjalan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
