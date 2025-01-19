<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    /**
     * Display a listing of the rentals.
     */
    public function index()
{
    $userId = auth()->id();

    // Fetch rentals that are completed (history)
    $historyRentals = Rental::where('user_id', $userId)
        ->where('status', 'completed')
        ->with('car')
        ->get();

    // Fetch rentals that are ongoing
    $ongoingRentals = Rental::where('user_id', $userId)
        ->where('status', 'ongoing')
        ->with('car')
        ->get();

    return view('admin.rentals.index', compact('historyRentals', 'ongoingRentals'));
}


    /**
     * Show the form for creating a new rental.
     */
    public function create()
    {
        $cars = Car::where('status', 'available')->get();

        return view('admin.rentals.create', compact('cars'));
    }

    /**
     * Store a newly created rental in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($request->car_id);

        // Hitung durasi dan biaya
        $startDate = Carbon::parse($request->start_date);
        $endDate = Carbon::parse($request->end_date);
        $days = $startDate->diffInDays($endDate);
        $totalCost = $days * $car->rental_rate;

        // Simpan data peminjaman
        $rental = Rental::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_cost' => $totalCost,
            'status' => 'ongoing',
        ]);

        // Ubah status mobil menjadi "rented"
        $car->update(['status' => 'rented']);

        return redirect()->route('admin.rentals.index')->with('success', 'Rental created successfully!');
    }

    /**
     * Show the form for editing the specified rental.
     */
    public function edit($id)
    {
        $rental = Rental::findOrFail($id);

        return view('rentals.edit', compact('rental'));
    }

    /**
     * Update the specified rental in storage.
     */
    public function update(Request $request, $id)
    {
        // Optional: Handle rental updates (not usually needed for rentals)
    }

    /**
     * Remove the specified rental (for admin use).
     */
    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $car = $rental->car;

        // Kembalikan mobil ke status "available"
        $car->update(['status' => 'available']);

        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully!');
    }

    /**
     * Handle car return.
     */

}
