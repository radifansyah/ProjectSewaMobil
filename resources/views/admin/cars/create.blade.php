<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Mobil Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">


                <form action="{{ route('admin.cars.store') }}" method="POST">
                    @csrf

                    {{-- Merek --}}
                    <div class="mb-4">
                        <label for="brand" class="block text-sm font-medium text-gray-700">Merek</label>
                        <input
                            type="text"
                            name="brand"
                            id="brand"
                            value="{{ old('brand') }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('brand')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Model --}}
                    <div class="mb-4">
                        <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                        <input
                            type="text"
                            name="model"
                            id="model"
                            value="{{ old('model') }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('model')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Nomor Plat --}}
                    <div class="mb-4">
                        <label for="license_plate" class="block text-sm font-medium text-gray-700">Nomor Plat</label>
                        <input
                            type="text"
                            name="license_plate"
                            id="license_plate"
                            value="{{ old('license_plate') }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            required>
                        @error('license_plate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="rental_rate" class="block text-sm font-medium text-gray-700">Tarif Sewa per Hari (Rp)</label>
                        <input
                            type="text"
                            name="rental_rate"
                            id="rental_rate"
                            value="{{ old('rental_rate') }}"
                            class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                            oninput="formatCurrency(this)"
                            required>
                        @error('rental_rate')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>


                    {{-- Tombol Submit --}}
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

{{-- Script ini Untuk Format Uang Agar bisa Otomatis Gaes --}}
    <script>
        function formatCurrency(input) {
            // Hapus karakter non-numerik kecuali angka
            let value = input.value.replace(/[^0-9]/g, '');

            // Tambahkan format "Rp" dan pisahkan ribuan
            input.value = value ? 'Rp ' + new Intl.NumberFormat('id-ID').format(value) : '';
        }
    </script>

</x-app-layout>
