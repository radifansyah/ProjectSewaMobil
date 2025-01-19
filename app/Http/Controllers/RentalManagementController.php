<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalManagementController extends Controller
{
    /**
     * Display a listing of all rentals.
     */
    public function index(Request $request)
    {
        $query = Rental::with(['user', 'car']); // Include relationships

        // Filter by search query
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('car', function ($q) use ($search) {
                $q->where('brand', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Retrieve results
        $rentals = $query->get();

        return view('admin.rentalsAll.index', compact('rentals'));
    }

    /**
     * Show the form for creating a new rental.
     */
    public function create()
    {
        $cars = Car::where('status', 'available')->get();
        $users = User::all();
        return view('admin.rentalsAll.create', compact('cars', 'users'));
    }

    /**
     * Store a newly created rental in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Hitung durasi dan biaya
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) + 1;
        $totalCost = $days * $car->rental_rate;

        // Simpan data rental
        Rental::create([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => 'ongoing',
        ]);

        $car->update(['status' => 'rented']);

        return redirect()->route('admin.rentalsAll.index')->with('success', 'Rental created successfully!');
    }

    /**
     * Show the form for editing the specified rental.
     */
    public function edit($id)
    {
        $rental = Rental::with('car', 'user')->findOrFail($id);
        $cars = Car::where('status', 'available')->orWhere('id', $rental->car_id)->get();
        $users = User::all();
        return view('admin.rentalsAll.edit', compact('rental', 'cars', 'users'));
    }

    /**
     * Update the specified rental in storage.
     */
    public function update(Request $request, $id)
    {
        $rental = Rental::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate) + 1;
        $totalCost = $days * $car->rental_rate;

        $rental->update([
            'user_id' => $request->user_id,
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
        ]);

        return redirect()->route('admin.rentalsAll.index')->with('success', 'Rental updated successfully!');
    }

    /**
     * Remove the specified rental from storage.
     */
    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->car->update(['status' => 'available']);
        $rental->delete();

        return redirect()->route('admin.rentalsAll.index')->with('success', 'Rental deleted successfully!');
    }


    public function returnCar(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
        ]);

        $rental = Rental::where('car_id', $request->car_id)
            ->where('status', 'ongoing')
            ->firstOrFail();

        // Tandai rental sebagai "returned"
        $rental->update(['status' => 'returned']);

        // Ubah status mobil menjadi "available"
        $rental->car->update(['status' => 'available']);

        return redirect()->route('admin.rentalsAll.index')->with('success', 'Car returned successfully!');
    }


}
