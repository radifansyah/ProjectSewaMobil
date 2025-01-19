<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <a href="{{ route('admin.cars.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Tambah Mobil Baru
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merek</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Model</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nomor Plat</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif Sewa (Rp)</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($cars as $car)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $car->brand }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $car->model }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $car->license_plate }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($car->rental_rate, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($car->status === 'rented')
                                        <span class="text-red-500">Sedang Disewa</span>
                                    @else
                                        <span class="text-green-500">Tersedia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.cars.edit', $car->id) }}" style="margin-right: 10px" class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada mobil terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
