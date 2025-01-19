<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pesan Mobil') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 gap-4">
                <!-- Layout 1: Mobil yang tersedia -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Mobil Tersedia</h3>
                    @if($cars->isEmpty())
                        <p class="text-gray-500">Tidak ada mobil yang tersedia saat ini.</p>
                    @else
                        <table class="table-auto w-full text-sm text-left">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2">Brand</th>
                                    <th class="px-4 py-2">Model</th>
                                    <th class="px-4 py-2">Tarif/Hari</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cars as $car)
                                    <tr>
                                        <td class="px-4 py-2">{{ $car->brand }}</td>
                                        <td class="px-4 py-2">{{ $car->model }}</td>
                                        <td class="px-4 py-2">Rp {{ number_format($car->rental_rate, 0, ',', '.') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>

                <!-- Layout 2: Tambah Pesanan -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h3 class="text-lg font-semibold mb-4">Pesan Mobil</h3>
                    <form action="{{ route('admin.rentals.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label for="car_id" class="block text-sm font-medium text-gray-700">Pilih Mobil</label>
                            @if($cars->isEmpty())
                                <div class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-gray-100 text-gray-500 rounded-md shadow-sm">
                                    Tidak ada mobil yang tersedia saat ini.
                                </div>
                            @else
                                <select name="car_id" id="car_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                                    <option value="" selected disabled>-- Pilih Mobil --</option>
                                    @foreach($cars as $car)
                                        <option value="{{ $car->id }}">
                                            {{ $car->brand }} {{ $car->model }} - Rp {{ number_format($car->rental_rate, 0, ',', '.') }}/hari
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        </div>

                        <div class="mb-4">
                            <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                            <input type="date" name="end_date" id="end_date" class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
