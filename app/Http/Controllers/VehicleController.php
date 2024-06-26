<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $vehicles = Vehicle::with('user')->get();
        } elseif ($user->role === 'mechanic') {
            $vehicles = Vehicle::whereHas('repairs', function ($query) use ($user) {
                $query->where('mechanic_id', $user->id);
            })->with('user', 'repairs', 'repairs.mechanic')->get();

            $mechanicVehicles = Vehicle::where('user_id', $user->id)->get();

            $vehicles = $vehicles->merge($mechanicVehicles);
        } else {
            $vehicles = Vehicle::where('user_id', $user->id)->with('user')->get();
        }

        return view('admin.management.vehicles-data', ['vehicles' => $vehicles, 'vehicle' => $vehicles->first()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'fuelType' => ['required', 'string', 'max:255'],
            'registration' => ['required', 'string', 'max:255', 'unique:vehicles'],
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $vehicleData = [
            'make' => $request->make,
            'model' => $request->model,
            'fuelType' => $request->fuelType,
            'registration' => $request->registration,
            'user_id' => $request->user_id ?? auth()->user()->id,
        ];

        if ($request->has('user_id')) {
            $user = User::find($request->user_id);
            if (!$user) {
                return back()->withErrors(['user_id' => 'Invalid user ID.']);
            }
        }

        if ($request->hasFile('photos')) {
            $imagePaths = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('public/vehicle_photos');
                $imagePaths[] = Storage::url($path);
            }
            $vehicleData['photos'] = json_encode($imagePaths);
        }

        Vehicle::create($vehicleData);

        return redirect()->back()->with('success', 'Vehicle added successfully!');
    }

    public function showVehiclePics(Request $request)
    {
        $vehicle = Vehicle::findOrFail($request->id);
        if (!$vehicle) {
            return response()->json([], 404);
        }

        $imageUrls = [];
        if (isset($vehicle->photos)) {
            $imageUrls = explode(',', $vehicle->photos);
        } else if (isset($vehicle->photo_paths)) {
            $imageUrls = json_decode($vehicle->photo_paths, true);
        }

        if (empty($imageUrls)) {
            return response()->json([], 204);
        }

        return response()->json(['pictures' => $imageUrls]);
    }

    public function destroy(Request $request)
    {
        $vehicle = Vehicle::find($request->vdeleteId);
        if ($vehicle) {
            $vehicle->delete();
            return "ok";
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
    
    public function update(Request $request, $vehicleId)
    {
        $vehicle = Vehicle::findOrFail($vehicleId);

        if (!$vehicle) {
            return "The vehicle does not exist.";
        }

        $request->validate([
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'fuelType' => ['required', 'string', 'max:255'],
            'registration' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'integer', 'exists:users,id'],
        ]);

        $vehicleData = [
            'make' => $request->make,
            'model' => $request->model,
            'fuelType' => $request->fuelType,
            'registration' => $request->registration,
            'user_id' => $request->user_id ?? Auth::user()->id,
        ];
        $vehicle->update($vehicleData);

        return redirect()->back();
    }


}
