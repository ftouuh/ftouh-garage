<?php
namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function listAppointments()
    {
        $userRole = Auth::user()->role;
        $userId = Auth::id();
        
        $appointments = ($userRole === "admin") 
            ? Appointment::orderBy('appointment_time', 'asc')->with('user')->get()
            : Appointment::where('user_id', $userId)->orderBy('appointment_time', 'asc')->with('user')->get();

        return view('admin.management.appointments-data', compact('appointments'));
    }

    public function createAppointment(Request $request)
    {
        Appointment::create([
            'user_id' => $request->user_id ?? auth()->id(),
            'description' => $request->description,
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => $request->input('appointment_time'),
            'status' => 'pending'
        ]);

        return redirect()->back();
    }

    public function deleteAppointment(Request $request)
    {
        $appointment = Appointment::find($request->deleteId);

        if ($appointment) {
            $appointment->delete();
            return "ok";
        } else {
            return response()->json(['message' => 'Appointment not found'], 404);
        }
    }

    public function changeAppointmentStatus(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'status' => 'required|in:pending,confirmed,completed,canceled'
        ]);

        if (Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $appointment = Appointment::findOrFail($request->appointment_id);
        $userId = $appointment->user_id;
        $email = Auth::user()->email;

        if ($appointment->status !== $request->status) {
            $message = "Your appointment with ID: " . $appointment->id . " has been " . $request->status . ".";
            Notification::create([
                'user_id' => $userId,
                'sender_id' => $email,
                'message' => $message
            ]);
        }

        $appointment->status = $request->status;
        $appointment->save();

        return response()->json(['message' => 'Status updated successfully']);
    }
}

