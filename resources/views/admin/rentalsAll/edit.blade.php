<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Rental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="bg-red-500 text-white font-medium p-3 rounded">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('admin.rentalsAll.update', $rental->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Nama User --}}
                    <div class="mb-4">
                        <label for="user_name" class="block text-sm font-medium text-gray-700">Nama User</label>
                        <input
                            type="text"
                            id="user_name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm"
                            value="{{ $rental->user->name }}" disabled>
                    </div>

                    {{-- Nama Mobil --}}
                    <div class="mb-4">
                        <label for="car_name" class="block text-sm font-medium text-gray-700">Nama Mobil</label>
                        <input
                            type="text"
                            id="car_name"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm"
                            value="{{ $rental->car->brand }} {{ $rental->car->model }}" disabled>
                    </div>

                    {{-- Tanggal Mulai --}}
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                        <input
                            type="date"
                            name="start_date"
                            id="start_date"
                            value="{{ $rental->start_date }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm"
                            required>
                    </div>

                    {{-- Tanggal Selesai --}}
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                        <input
                            type="date"
                            name="end_date"
                            id="end_date"
                            value="{{ $rental->end_date }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm"
                            required>
                    </div>

                    {{-- Total Biaya --}}
                    <div class="mb-4">
                        <label for="total_cost" class="block text-sm font-medium text-gray-700">Total Biaya (Rp)</label>
                        <input
                            type="number"
                            name="total_cost"
                            id="total_cost"
                            value="{{ $rental->total_cost }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm sm:text-sm"
                            required>
                    </div>

                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
