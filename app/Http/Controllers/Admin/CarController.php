<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $cars = Car::where('status', 'available')->get();
        return view('admin.cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Ambil data mobil yang tersedia
        $cars = Car::all();

        // Kirim data ke view
        return view('admin.cars.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     //
    // }



    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars',
            'rental_rate' => 'required|numeric|min:1000', // Sesuaikan dengan tarif minimum
        ]);

        // Simpan data mobil baru
        Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'rental_rate' => $request->rental_rate,
            'status' => 'available', // Status mobil baru
        ]);

        // Redirect ke daftar mobil atau halaman lain
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil ditambahkan.');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      // Cari mobil berdasarkan ID
    $car = Car::findOrFail($id);

    // Kirim data mobil ke view edit
    return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'rental_rate' => 'required|numeric',
        ]);

        // Cari mobil berdasarkan id
        $car = Car::findOrFail($id);

        // Update data mobil
        $car->update([
            'brand' => $request->brand,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'rental_rate' => $request->rental_rate,
        ]);

        // Redirect ke daftar mobil dengan pesan sukses
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Cari mobil berdasarkan id
        $car = Car::findOrFail($id);

        // Hapus mobil
        $car->delete();

        // Redirect ke daftar mobil dengan pesan sukses
        return redirect()->route('admin.cars.index')->with('success', 'Mobil berhasil dihapus.');
    }


    public function returnCar(Request $request) {
        $rental = Rental::where('car_id', $request->car_id)->where('user_id', auth()->id())->first();
        $rental->update(['status' => 'returned']);

        Car::find($request->car_id)->update(['status' => 'available']);
        return redirect()->route('rentals.index');
    }

}
