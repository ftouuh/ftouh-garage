<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Appointment;
use App\Models\Repair;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function getInfos()
    {
        $clientCount = User::where('role', 'client')->count();
        $vehicleCount = Vehicle::count();
        $today = Carbon::today()->toDateString();
        $mechanicCount = User::where('role', 'mechanic')->count();
        $appointmentCount = Appointment::whereDate('appointment_date', $today)->count();
        $RepairsCount = Repair::count();
        $completedRepairsCount = Repair::where('status', 'completed')->count();
        $pendingRepairsCount = Repair::where('status', 'pending')->count();

        $vehiculeById = Vehicle::where('user_id',Auth::user()->id)->count();
        $repairById = Repair::where('user_id',Auth::user()->id)->count();
        $completedRepairsCountById = Repair::where('user_id',Auth::user()->id)->where('status','completed')->count();
        $pendingRepairsCountById = Repair::where('user_id',Auth::user()->id)->where('status','pending')->count();

        $completedRepairsCountByIdM = Repair::where('mechanic_id',Auth::user()->id)->where('status','completed')->count();
        $pendingRepairsCountByIdM = Repair::where('mechanic_id',Auth::user()->id)->where('status','pending')->count();


        return view('admin.dashboard', [
            'clientCount' => $clientCount,
            'mechanicCount' => $mechanicCount,
            'vehicleCount' => $vehicleCount,
            'appointmentCount' => $appointmentCount,
            'RepairsCount' => $RepairsCount,
            'completedRepairsCount' => $completedRepairsCount,
            'pendingRepairsCount' => $pendingRepairsCount,
            'vehiculeById' => $vehiculeById,
            'repairById' => $repairById,
            'completedRepairsCountById' => $completedRepairsCountById,
            'pendingRepairsCountById' => $pendingRepairsCountById,
            'completedRepairsCountByIdM' => $completedRepairsCountByIdM,
            'pendingRepairsCountByIdM' => $pendingRepairsCountByIdM,
        ]);
    }
}