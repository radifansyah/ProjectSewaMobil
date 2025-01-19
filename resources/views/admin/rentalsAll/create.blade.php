<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add Rental') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.rentalsAll.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="user_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Select a User</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="car_id" class="block text-sm font-medium text-gray-700">Car</label>
                        <select name="car_id" id="car_id" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                            <option value="">Select a Car</option>
                            @foreach ($cars as $car)
                                <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
