<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Rental Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('admin.rentals.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Pesan Mobil Baru
                </a>

                @if(session('success'))
                    <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mt-6">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mobil</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Mulai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Biaya</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($rentals as $rental)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $rental->car->brand }} {{ $rental->car->model }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $rental->start_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $rental->end_date }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($rental->status) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($rental->status === 'ongoing')
                                            <form action="{{ route('admin.rentals.return') }}" method="POST" class="inline">
                                                @csrf
                                                <input type="hidden" name="car_id" value="{{ $rental->car_id }}">
                                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                                    Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500">Selesai</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada rental mobil.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
