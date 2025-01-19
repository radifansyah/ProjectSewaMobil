<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Rentals') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <a href="{{ route('admin.rentalsAll.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded mb-4 inline-block">Add Rental</a>

                <!-- Search and Filter -->
                <form method="GET" action="{{ route('admin.rentalsAll.index') }}" class="mb-4">
                    <div class="flex items-center gap-4">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search by User or Car"
                            value="{{ request('search') }}"
                            class="px-4 py-2 border rounded w-1/3">

                        <select name="status" class="px-4 py-2 border rounded">
                            <option value="" {{ request('status') === null ? 'selected' : '' }}>All Status</option>
                            <option value="ongoing" {{ request('status') === 'ongoing' ? 'selected' : '' }}>Belum Dikembalikan</option>
                            <option value="returned" {{ request('status') === 'returned' ? 'selected' : '' }}>Sudah Dikembalikan</option>
                        </select>

                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded">Filter</button>
                    </div>
                </form>

                <table class="table-auto w-full text-sm text-left">
                    <thead>
                        <tr>
                            <th class="px-4 py-2">User</th>
                            <th class="px-4 py-2">Car</th>
                            <th class="px-4 py-2">Model</th>
                            <th class="px-4 py-2">Nomor Plat</th>
                            <th class="px-4 py-2">Start Date</th>
                            <th class="px-4 py-2">End Date</th>
                            <th class="px-4 py-2">Total Cost</th>
                            <th class="px-4 py-2">Actions</th>
                            <th class="px-4 py-2">Konfirmasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rentals as $rental)
                            <tr>
                                <td class="px-4 py-2">{{ $rental->user->name }}</td>
                                <td class="px-4 py-2">{{ $rental->car->brand }}  </td>
                                <td class="px-4 py-2">{{ $rental->car->model }}</td>
                                <td class="px-4 py-2">{{ $rental->car->license_plate }}</td>
                                <td class="px-4 py-2">{{ $rental->start_date }}</td>
                                <td class="px-4 py-2">{{ $rental->end_date }}</td>
                                <td class="px-4 py-2">Rp {{ number_format($rental->total_cost, 0, ',', '.') }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('admin.rentalsAll.edit', $rental->id) }}" class="px-2 py-1 bg-yellow-500 text-white rounded">Edit</a>
                                    <form action="{{ route('admin.rentalsAll.destroy', $rental->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">Delete</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($rental->status === 'ongoing')
                                        <button
                                            onclick="openModal({{ $rental->car_id }})"
                                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-green-600">
                                            Kembalikan
                                        </button>
                                    @else
                                        <span class="text-gray-500">Sudah Dikembalikan</span>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
<div id="returnModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-lg font-medium mb-4">Konfirmasi Pengembalian</h2>
        <form id="returnForm" action="{{ route('admin.rentalsAll.returnCar') }}" method="POST">
            @csrf
            <input type="hidden" name="car_id" id="modalCarId">

            <div class="mb-4">
                <label for="license_plate" class="block text-sm font-medium text-gray-700">Nomor Plat</label>
                <input
                    type="text"
                    name="license_plate"
                    id="license_plate"
                    class="mt-1 block w-full py-2 px-3 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm"
                    placeholder="Masukkan nomor plat"
                    required>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600" onclick="closeModal()">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Kembalikan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openModal(carId) {
        document.getElementById('modalCarId').value = carId;
        document.getElementById('returnModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('returnModal').classList.add('hidden');
    }
</script>

</x-app-layout>
